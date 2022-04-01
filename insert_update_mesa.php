<?php 
include('include/dbcon.php');
include('include/todas_funcionarios.php');


if(isset($_POST["operation"]))
{
    if($_POST["operation"] == "Add")
    {
        $statement = $connection->prepare("INSERT INTO funcionario (username, password) VALUES (:username, :password)");
        $result = $statement->execute(
            array(
                ':password'   =>  $_POST["password"],
                ':username'   =>  $_POST["username"],
            )
        );
    }
    if($_POST["operation"] == "Edit")
    {
        $statement = $connection->prepare("UPDATE funcionario SET password = :password, username = :username WHERE funcionario_id = :funcionario_id");
        $result = $statement->execute(
            array(
                ':password'   =>  $_POST["password"],
                ':username'   =>  $_POST["username"],
                ':funcionario_id' => $_POST["funcionario_id"]
            )
            
        );
    }
}
?>
