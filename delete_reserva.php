<?php

include('include/dbcon.php');
include('include/todas_reservas.php');

if(isset($_POST["reserva_id"]))
{
	$statement = $connection->prepare("DELETE FROM reserva WHERE reserva_id = :reserva_id");
	$result = $statement->execute(array(':reserva_id'	=>	$_POST["reserva_id"]));
}
