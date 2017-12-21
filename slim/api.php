<?php

require_once 'vendor/autoload.php';

$app = new \Slim\Slim();

$db = new mysqli("localhost","root","","neppo");

$app->get("/cadastro",function() use($db,$app) {
	$query = $db->query("SELECT * FROM cadastro");
	$cadastro = array();
	while($fila=$query->fetch_assoc()){
		$cadastro[]=$fila;
	}
	
	echo json_encode($cadastro);
});


/*link =  aqui se ve os dados  http://localhost/slim/api.php/cadastro */

$app->post("/cadastro",function() use($db,$app){
	
	$query="INSERT INTO cadastro VALUES(NULL,"
	. "'{$app->request->post("nome")}',"
	.		 "'{$app->request->post("data")}',"
	.		 "'{$app->request->post("cpf")}',"
	.		 "'{$app->request->post("sexo")}',"
	.	     "'{$app->request->post("endereco")}'"
	.	 ")";
	$insert = $db->query($query);
	
	if($insert){
		$result = array("STATUS" => "true", "message" => "Cadastro Realizado Corretamente!!!");
	}else{
		$result = array("STATUS" => "false", "message" => "Cadastro não realizado corretamente!!!");
	}
	
	echo json_encode($result);
	
});

$app->put("/cadastro/:id",function($id) use($db,$app){
	$query="UPDATE cadastro SET " 
			. "name = '{$app->request->post("name")}', "
			. "data = '{$app->request->post("data")}', "
			. "cpf = '{$app->request->post("cpf")}', "
			. "sexo = '{$app->request->post("sexo")}', "
			. "endereco = '{$app->request->post("endereco")}'"
			. " WHERE id={$id}";
	$update=$db->query($query);
	if($update){
		$result = array("STATUS" => "true", "message" => "Cadastro Atualizado!!!");
	}else{
		$result = array("STATUS" => "false", "message" => "Cadastro não Atualizado!!!");
	}
	
	echo json_encode($result);
});

$app->delete("/cadastro/:id",function($id) use($db,$app){
	$query="DELETE FROM cadastro WHERE id = {$id}";
	$delete=$db->query($query);
	
	if($delete){
		$result = array("STATUS" => "true", "message" => "Producto apagado correctamente!!!");
	}else{
		$result = array("STATUS" => "false", "message" => "Producto não apagado!!!");
	}
	
	echo json_encode($result);
});


$app->run();

