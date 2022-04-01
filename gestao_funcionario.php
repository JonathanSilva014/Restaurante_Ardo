<?php
   
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
            <li><a href="gestao_mesa.php">Mesas</a></li>
            <li class="active"><a href="gestao_funcionario.php">Funcionários</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="tabela">
        <table id="funcionario" class="table table-striped">  
            <thead bgcolor="#1C7FFF">
                <tr class="table-primary">
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
        </table>
        <br>
        <div>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success">Adicionar funcionario</button>
        </div>
    </div>
</div>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="form_funcionario" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Adicionar funcionario</h4>
                </div>
                <div class="modal-body">
                    <div id="id-group" class="form-group">
                            <label>ID:</label>
                            <input value="id" readonly id="funcionario_id" type="text" class="form-control" name="funcionario_id" placeholder="Insira o ID...">
                    </div>
                    <div id="username-group" class="form-group">
                        <label>Username</label>
                        <input id="username" type="text" class="form-control" name="username" placeholder="Insira o username...">
                    </div>
                    <div id="password-group" class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="text" class="form-control" name="password" placeholder="Insira a password...">
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
</body>
</html>

<script type="text/javascript">
    
    $(document).ready(function(){
        $('#add_button').click(function(){
            $('#form_funcionario')[0].reset();
            $('.modal-title').text("Adicionar Detalhes da funcionario");
            $('#action').val("Add");
            $('#operation').val("Add");
        });

    var dataTable = $('#funcionario').DataTable({
        "processing":true,
        "serverSide":true,
        "order": [],
        "info":true,
        "ajax":{
            url:"busca_funcionario.php",
            type:"POST"
        }
     });

     $(document).on('submit', '#form_funcionario', function(event){ //Submeter uma nova funcionario ou update a uma funcionario
        event.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        let myForm2 = document.getElementById('form_funcionario');
        let formData = new FormData(myForm2);
        formData.append('username', username);
        formData.append('password', password);
        
        if(password != '' && username != '')
        {
            $.ajax({
                url:"insert_update_funcionario.php",
                method:'POST',
                data:formData,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    $('#form_funcionario')[0].reset();
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
        var funcionario_id = $(this).attr("id");
        console.log("funcionario id: " + funcionario_id);
        $.ajax({
            url:"get_funcionario.php",
            method:"POST",
            data:{funcionario_id:funcionario_id},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#funcionario_id').val(data.funcionario_id);
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('.modal-title').text("Editar funcionario");
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

        var funcionario_id = $(this).attr("id");
        if(confirm("Tem a certeza que quer eliminar esta funcionario?"))
        {
            $.ajax({
                url:"delete_funcionario.php",
                method:"POST",
                data:{funcionario_id:funcionario_id},
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
