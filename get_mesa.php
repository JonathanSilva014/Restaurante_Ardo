<?php 
include('include/dbcon.php');
include('include/todas_mesas.php');

if(isset($_POST["mesa_id"]))
{
    $output = array();
    $statement = $connection->prepare("SELECT * FROM mesa WHERE mesa_id = '".$_POST["mesa_id"]."' LIMIT 1");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output["mesa_id"] = $row["mesa_id"];
        $output["n_lugares"] = $row["n_lugares"];
    }
    echo json_encode($output);
}
?>
