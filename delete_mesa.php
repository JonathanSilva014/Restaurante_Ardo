<?php

include('include/dbcon.php');
include('include/todas_mesas.php');

if(isset($_POST["mesa_id"]))
{
	$statement = $connection->prepare("DELETE FROM mesa WHERE mesa_id = :mesa_id");
	$result = $statement->execute(array(':mesa_id'	=>	$_POST["mesa_id"]));
}
