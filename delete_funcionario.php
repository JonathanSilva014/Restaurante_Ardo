<?php

include('include/dbcon.php');
include('include/todas_funcionarios.php');

if(isset($_POST["funcionario_id"]))
{
	$statement = $connection->prepare("DELETE FROM funcionario WHERE funcionario_id = :funcionario_id");
	$result = $statement->execute(array(':funcionario_id'	=>	$_POST["funcionario_id"]));
}
