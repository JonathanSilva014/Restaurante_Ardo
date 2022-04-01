<?php 
include('include/dbcon.php');
include('include/todas_reservas.php');
$query = '';
$output = array();
$query .= "SELECT * FROM reserva ";
if(isset($_POST["search"]["value"]))
{
    $query .= 'WHERE reserva_data LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR reserva_hora LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR reserva_id LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR cliente_nome LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR cliente_telemovel LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR reserva_estado LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR mesa_id LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY reserva_id ASC ';
}

$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
    $sub_array = array();

    $sub_array[] = $row["reserva_id"];
    $sub_array[] = $row["cliente_nome"];
    $sub_array[] = $row["cliente_telemovel"];
    $sub_array[] = $row["n_pessoas"];
    $sub_array[] = $row["reserva_data"];
    $sub_array[] = $row["reserva_estado"];
    $sub_array[] = $row["reserva_hora"];
    $sub_array[] = $row["mesa_id"];
    $sub_array[] = '<button type="button" name="update" id="'.$row["reserva_id"].'" class="btn btn-primary btn-sm update">Edit</button>';
    $sub_array[] = '<button type="button" name="delete" id="'.$row["reserva_id"].'" class="btn btn-danger btn-sm delete">Delete</button>';
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
