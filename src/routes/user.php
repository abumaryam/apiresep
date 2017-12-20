<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app->get('/api/user',function(Request $request, Response $response){

	$sql = "SELECT * FROM user";
	
	try {
		$db = new db();
		$db = $db->connect();
		$stmt = $db->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($result);
	} catch (PDOException $e){
		echo '{"error":{"text": '.$e->getMessage().'}}';
	}

});

//register user
$app->post('/api/user/add', function ($request) {
    $username = $request->getParam('username');
    $password = $request->getParam('password');
    $name = $request->getParam('name');
    $email = $request->getParam('email');
    $authentication = new auth();
   
    $sql = "INSERT INTO users (username,password,name,email) VALUES (:username,:password,:name,:email)";
    try {
        $db = new db();
		$db = $db->connect();
		$stmt = $db->prepare($sql);

        $stmt->bindParam("username", $username);
        $stmt->bindParam("password", $password);
        $stmt->bindParam("name", $name);
        $stmt->bindParam("email", $email);
        $stmt->execute();
        $db = null;

        // membuat nilai return

        try {
            $db = new db();
            $db = $db->connect();
            $sql = "SELECT user_id, name, email, username FROM users WHERE username=:username";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("username", $username);
            $stmt->execute();
            $usernameDetails = $stmt->fetch(PDO::FETCH_OBJ);
            $usernameDetails->token = $authentication->apiToken($usernameDetails->user_id);
            $db = null;
            $userData = json_encode($usernameDetails);
            echo '{"userData": ' .$userData . '}';
            
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});


$app->post('/api/user/login',function(Request $request, Response $response){

	    $data = json_decode($request->getBody());
	try {
        $userData ='';
        $sql = "SELECT user_id, name, email, username FROM users WHERE (username=:username or email=:username) and password=:password ";
		$db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("username", $data->username, PDO::PARAM_STR);
        $password=hash('sha256',$data->password);
        $stmt->bindParam("password", $password, PDO::PARAM_STR);
        $stmt->execute();

        $mainCount=$stmt->rowCount();
        $userData = $stmt->fetch(PDO::FETCH_OBJ);

        if(!empty($userData))
        {
            $user_id=$userData->user_id;
            $userData->token = apiToken($user_id);
        }
        
        $db = null;
         if($userData){
               $userData = json_encode($userData);
                echo '{"userData": ' .$userData . '}';
            } else {
               echo '{"error":{"text":"Bad request wrong username and password"}}';
            }


	} catch (PDOException $e){
		echo '{"error":{"text": '.$e->getMessage().'}}';
	}

});