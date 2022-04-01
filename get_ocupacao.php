<?php
include('include/dbcon.php');

    $output = array();
    
    $dataOcupacao = $_POST['dataOcupacao'];
    $statement = $connection->prepare("SELECT count(reserva_data) as n_reservas FROM reserva WHERE reserva_data = '$dataOcupacao' AND (reserva_estado = 'marcada' OR reserva_estado = 'efetuada')");
    $statement->execute();
    $n_reservas = $statement->fetch();

    $statement2 = $connection->prepare("SELECT count(*) as n_mesas FROM mesa");
    $statement2->execute();
    $n_mesas = $statement2->fetch();

    $output["n_reservas"] = $n_reservas[0];
    $output["n_mesas"] = $n_mesas[0];

    echo json_encode($output);
?>
