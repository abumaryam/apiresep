<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app->get('/api/resep',function(Request $request, Response $response){

	$sql = "SELECT * FROM resep";
	
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