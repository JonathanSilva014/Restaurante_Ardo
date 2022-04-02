<?php

function get_total_all_records()
{
	include('include/dbcon.php');
	$statement = $connection->prepare("SELECT * FROM reserva");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>
