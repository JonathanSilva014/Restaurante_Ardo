<?php
    session_start();

    if(!isset($_SESSION['loggedIN'])){
        header('Location: login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerência Ordo</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- DataTimePicker -->
    <script src="js/jquery.datetimepicker.full.min.js"></script>
    <link rel="stylesheet" href="css/jquery.datetimepicker.min.css">
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav id="barra_navegacao" class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="logout.php">Home</a></li>
            <li class="active"><a href="login.php">Gerência</a></li>
        </ul>
    </div>
</nav>
    
<nav id="barra_navegacao2" class="navbar navbar-inverse">
    <div class="container-fluid">

        <ul class="nav navbar-nav">
            <li><a href="gestao_reserva.php">Reservas</a></li>
            <li class="active"><a href="gestao_mesa.php">Mesas</a></li>
            <li><a href="gestao_funcionario.php">Funcionários</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="tabela">
        <table id="mesa" class="table table-striped">  
            <thead bgcolor="#1C7FFF">
                <tr class="table-primary">
                    <th>ID</th>
                    <th>Nº Lugares</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
        </table>
        <br>
        <div>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success">Adicionar mesa</button>
        </div>
    </div>
</div>
         
</body>
</html>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="form_mesa" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Adicionar mesa</h4>
                </div>
                <div class="modal-body">
                    <div id="id-group" class="form-group">
                        <label>ID:</label>
                        <label id="mesa_id" type="text" class="form-control" name="mesa_id" placeholder="Insira o ID..."></label>
                    </div>
                    <div id="n_lugares-group" class="form-group">
                        <label for="n_lugares">Nº lugares</label>
                        <input id="n_lugares" type="number" class="form-control" name="n_lugares" placeholder="Insira o nº de lugares...">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="operation" id="operation"/>
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add"/>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        $('#add_button').click(function(){
            $('#form_mesa')[0].reset();
            $('.modal-title').text("Adicionar Detalhes da mesa");
            $('#action').val("Add");
            $('#operation').val("Add");
        });

    var dataTable = $('#mesa').DataTable({
        "paging":true,
        "processing":true,
        "serverSide":true,
        "order": [],
        "info":true,
        "ajax":{
            url:"busca_mesa.php",
            type:"POST"
        }
     });

     $(document).on('submit', '#form_mesa', function(event){ //Submeter uma nova mesa ou update a uma mesa
        event.preventDefault();
        var mesa_id = $('#mesa_id').text();
        var n_lugares = $('#n_lugares').val();
        let myForm2 = document.getElementById('form_mesa');
        let formData = new FormData(myForm2);
        formData.append('mesa_id', mesa_id);
        formData.append('n_lugares', n_lugares);
        
        if(n_lugares != '')
        {
            $.ajax({
                url:"insert_update_mesa.php",
                method:'POST',
                data:formData,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    $('#form_mesa')[0].reset();
                    $('#userModal').modal('hide');
                    dataTable.ajax.reload();
                },
                error:function(data)
                {
                    console.log(data);
                }
            });
        }
        else
        {
            alert("Por favor preencha todos os campos.");
        }
    });
    
    $(document).on('click', '.update', function(event){ //Meter dados da linha na Modal. ex -> [10, Joao Loureiro, 910203044, 2, 10/Jan/2021, marcada, 11:00]
        var mesa_id = $(this).attr("id");
        console.log("mesa id" + mesa_id);
        $.ajax({
            url:"get_mesa.php",
            method:"POST",
            data:{mesa_id:mesa_id},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#mesa_id').text(data.mesa_id);
                $('#n_lugares').val(data.n_lugares);
                $('.modal-title').text("Editar mesa");
                $('#action').val("Save");
                $('#operation').val("Edit");
            },
            error:function(data)
            {
                console.log(data);
            }
        });
     });


    $(document).on('click','.delete', function(){ //Elimina uma linha

        var mesa_id = $(this).attr("id");
        if(confirm("Tem a certeza que quer eliminar esta mesa?"))
        {
            $.ajax({
                url:"delete_mesa.php",
                method:"POST",
                data:{mesa_id:mesa_id},
                success:function(data)
                {
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            return false;
        }
     });

    });
</script>
