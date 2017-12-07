<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//semua kategori
$app->get('/api/kategori',function(Request $request, Response $response){

	$sql = "SELECT * FROM kategori";
	
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

//get satu kategori
$app->get('/api/kategori/{id}', function ($request) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM kategori WHERE id=".$id;
    try {
        $db = new db();
		$db = $db->connect();
		$stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($students);
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});

//tambahkan kategori
$app->post('/api/kategori/add', function ($request) {
    $nama_kategori = $request->getParam('nama_kategori');
   
    $sql = "INSERT INTO kategori (nama_kategori) VALUES (:nama_kategori)";
    try {
        $db = new db();
		$db = $db->connect();
		$stmt = $db->prepare($sql);

        $stmt->bindParam("nama_kategori", $nama_kategori);
        $stmt->execute();
      
        $db = null;
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});

//ubah kategori
$app->put('/api/kategori/update/{id}', function ($request) {
    $id = $request->getAttribute('id');
    $nama_kategori = $request->getParam('nama_kategori');
 

    $sql = "UPDATE kategori SET nama_kategori=:nama_kategori WHERE id=$id";
    try {
        $db = new db();
		$db = $db->connect();
		$stmt = $db->prepare($sql);
        $stmt->bindParam("nama_kategori", $nama_kategori);
        $stmt->execute();
        $db = null;
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});

//hapus kategori
$app->delete('/api/kategori/delete/{id}', function ($request) {
    $id = $request->getAttribute('id');
    
    $sql = "DELETE FROM kategori WHERE id=".$id;
    try {
        $db = new db();
		$db = $db->connect();
		$stmt = $db->prepare($sql);
        $stmt->execute();
        $dbh = null;
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});


