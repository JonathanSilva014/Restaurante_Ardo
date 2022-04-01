<?php 
include('include/dbcon.php');
include('include/todas_reservas.php');


if(isset($_POST["operation"]))
{
    if($_POST["operation"] == "Add")
    {
        $lugares = $_POST["reserva_n_pessoas"];
        $stmt = $connection->prepare("SELECT MESA_ID FROM MESA WHERE N_LUGARES >= $lugares  ORDER BY N_LUGARES ASC LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch();

        $statement = $connection->prepare("INSERT INTO reserva (cliente_nome, cliente_telemovel, n_pessoas, reserva_data, reserva_estado, reserva_hora, mesa_id) VALUES (:reserva_nome, :reserva_telemovel, :reserva_n_pessoas, :reserva_data, :reserva_estado, :reserva_hora, :reserva_mesa)");
        $result = $statement->execute(
            array(
                ':reserva_nome'   =>  $_POST["reserva_nome"],
                ':reserva_telemovel' =>  $_POST["reserva_telemovel"],
                ':reserva_n_pessoas'   =>  $_POST["reserva_n_pessoas"],
                ':reserva_data' =>  $_POST["reserva_data"],
                ':reserva_estado'   =>  "marcada",
                ':reserva_hora' =>  $_POST["reserva_hora"],
                ':reserva_mesa' => $row[0]
            )
        );
    }
    if($_POST["operation"] == "Edit")
    {
        $statement = $connection->prepare("UPDATE reserva SET cliente_nome = :reserva_nome, cliente_telemovel = :reserva_telemovel, n_pessoas = :reserva_n_pessoas, reserva_data = :reserva_data, reserva_estado = :reserva_estado, reserva_hora = :reserva_hora WHERE reserva_id = :id");
        $result = $statement->execute(
            array(
                ':reserva_nome'   =>  $_POST["reserva_nome"],
                ':reserva_telemovel' =>  $_POST["reserva_telemovel"],
                ':reserva_n_pessoas'   =>  $_POST["reserva_n_pessoas"],
                ':reserva_data' =>  $_POST["reserva_data"],
                ':reserva_estado'   =>  $_POST["reserva_estado"],
                ':reserva_hora' =>  $_POST["reserva_hora"],
                ':id' => $_POST["reserva_id"]
            )
            
        );
    }
}
?>
