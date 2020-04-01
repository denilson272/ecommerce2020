<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$sql = new Hcode\DB\Sql();
	//var_dump($sql);
	//var_dump($sql);
	$results = $sql->select("SELECT * FROM tb_users");
	//var_dump($results);
	echo json_encode($results);
});

$app->run();

 ?>