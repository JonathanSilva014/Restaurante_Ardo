<?php 
include('include/dbcon.php');
include('include/todas_reservas.php');

if(isset($_POST["reserva_id"]))
{
    $output = array();
    $statement = $connection->prepare("SELECT * FROM reserva WHERE reserva_id = '".$_POST["reserva_id"]."' LIMIT 1");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output["reserva_id"] = $row["reserva_id"];
        $output["cliente_nome"] = $row["cliente_nome"];
        $output["cliente_telemovel"] = $row["cliente_telemovel"];
        $output["n_pessoas"] = $row["n_pessoas"];
        $output["reserva_data"] = $row["reserva_data"];
        $output["reserva_estado"] = $row["reserva_estado"];
        $output["reserva_hora"] = $row["reserva_hora"];
        $output["mesa_id"] = $row["mesa_id"];
    }
    echo json_encode($output);
}
?>
