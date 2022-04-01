<?php 
include('include/dbcon.php');
include('include/todas_funcionarios.php');

if(isset($_POST["funcionario_id"]))
{
    $output = array();
    $statement = $connection->prepare("SELECT * FROM funcionario WHERE funcionario_id = '".$_POST["funcionario_id"]."' LIMIT 1");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output["funcionario_id"] = $row["funcionario_id"];
        $output["username"] = $row["username"];
        $output["password"] = $row["password"];
    }
    echo json_encode($output);
}
?>
