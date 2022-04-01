<?php 
include('include/dbcon.php');
include('include/todas_funcionarios.php');
$query = '';
$output = array();
$query .= "SELECT * FROM funcionario ";
if(isset($_POST["search"]["value"]))
{
    $query .= 'WHERE username LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY funcionario_id ASC ';
}

$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
    $sub_array = array();

    $sub_array[] = $row["funcionario_id"];
    $sub_array[] = $row["username"];
    $sub_array[] = $row["password"];
    $sub_array[] = '<button type="button" name="update" id="'.$row["funcionario_id"].'" class="btn btn-primary btn-sm update">Edit</button>';
    $sub_array[] = '<button type="button" name="delete" id="'.$row["funcionario_id"].'" class="btn btn-danger btn-sm delete">Delete</button>';
    $data[] = $sub_array;
}
$output = array(
    "draw"              =>  intval($_POST["draw"]),
    "recordsTotal"      =>  $filtered_rows,
    "recordsFiltered"   =>  get_total_all_records(),
    "data"              =>  $data
);
echo json_encode($output);
?>
