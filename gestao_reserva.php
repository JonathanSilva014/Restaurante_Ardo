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
            <li class="active"><a href="gestao_reserva.php">Reservas</a></li>
            <li><a href="gestao_mesa.php">Mesas</a></li>
            <li><a href="gestao_funcionario.php">Funcionários</a></li>
        </ul>
    </div>
</nav>

<div class="row">
    <div class="col-sm-9">
        <div class="container">
            <div class="tabela">
                <table id="reserva" class="table table-striped">  
                    <thead bgcolor="#1C7FFF">
                        <tr class="table-primary">
                            <th>ID</th>
                            <th>Cliente</th>  
                            <th>Telemóvel</th>
                            <th>Nº Pessoas</th>
                            <th>Data</th>
                            <th>Estado</th>
                            <th>Hora</th>
                            <th>Mesa</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                </table>
                <br>
                <div>
                    <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success">Adicionar Reserva</button>
                </div>
            </div>
        </div>
    </div>            
    <div id="contentorOcupacao" class="col-sm-2">
        <form id="form_ocupacao" style="display: flex;flex-direction: column;">
            <label for="dataOcupacao"><h3>% de Ocupação</h3></label>
            <input name="dataOcupacao" id="dataOcupacao" type="text"><br>
            <input type="submit" class="btn btn-Secondary" value="Escolher Data"></input>
        </form>
        <h3 id="percentagemOcupacao">0%</h3>
    </div>
</div>

</body>
</html>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form autocomplete="off" method="post" id="form_reserva" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Adicionar Reserva</h4>
                </div>
                <div class="modal-body">
                    <div id="id-group" class="form-group">
                        <label>ID:</label>
                        <input value="id" readonly id="reserva_id" type="text" class="form-control" name="reserva_id" placeholder="Insira o ID...">
                    </div>
                    <div id="nome-group" class="form-group">
                        <label for="reserva_nome">Nome</label>
                        <input id="reserva_nome" type="text" class="form-control" name="reserva_nome" placeholder="Insira o seu nome...">
                    </div>
                    <div id="telemovel-group" class="form-group">
                        <label for="reserva_telemovel">Telemóvel</label>
                        <input id="reserva_telemovel" type="tel" class="form-control" name="reserva_telemovel" placeholder="Insira o seu telemóvel...">
                    </div>
                    <div id="n_pessoas-group" class="form-group">
                        <label for="reserva_n_pessoas">Nº Pessoas</label>
                        <input id="reserva_n_pessoas" type="number" class="form-control" name="reserva_n_pessoas" placeholder="Insira o nº de pessoas...">
                    </div>
                    <div id="data-group" class="form-group">
                        <label for="reserva_data">Data</label>
                        <input id="reserva_data" type="text" class="form-control" name="reserva_data" placeholder="Insira a data...">
                    </div>
                    <div id="hora-group" class="form-group">
                        <label for="reserva_hora">Hora</label>
                        <input id="reserva_hora" type="text" class="form-control" name="reserva_hora" placeholder="Insira a hora...">
                    </div>
                    <div id="mesa_id-group" class="form-group">
                        <label for="mesa_id">Mesa</label>
                        <input hidden id="mesa_id" type="text" class="form-control" name="mesa_id" placeholder="Insira a mesa...">
                    </div>
                    <div id="estado-group" class="form-group">
                        <label for="reserva_estado">Estado</label>
                        <select class="custom-select" id="reserva_estado" type="text" class="form-control" name="reserva_estado" placeholder="Insira o estado...">
                            <option value="marcada">Marcada</option>
                            <option value="efetuada">Efetuada</option>
                            <option value="cancelada">Cancelada</option>
                        </select>
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

        jQuery('#dataOcupacao').datetimepicker({
            timepicker:false,
            format:'d/M/Y'
        })

        jQuery('#reserva_data').datetimepicker({
            timepicker:false,
            format:'d/M/Y'
        })
    
        // input hora -> datetimepicker
        jQuery('#reserva_hora').datetimepicker({
            datepicker:false,
            format: 'H:i',
            allowTimes:[
            //Almoço
            '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00',
            //Jantar
            '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30'
            ]
        });

        $('#add_button').click(function(){
            $('#mesa_id-group').hide();
            $('#form_reserva')[0].reset();
            $('.modal-title').text("Adicionar Detalhes da Reserva");
            $('#action').val("Add");
            $('#operation').val("Add");
        });



        $('#form_ocupacao').submit(function(event){
            event.preventDefault();
            var dataOcupacao = $('#dataOcupacao').val();
            
            var n_reservas = 0;
            var n_mesas = 0;
            var percentagem = 0.00;
            
            if(dataOcupacao != ''){
                $.ajax({
                    url:"get_ocupacao.php",
                    type:'POST',
                    data:{dataOcupacao:dataOcupacao},
                    success:function(result)
                    {
                        var data = jQuery.parseJSON(result);
                        n_mesas = data.n_mesas;
                        n_reservas = data.n_reservas;
                        percentagem = Math.round((n_reservas * 100)/n_mesas);

                        $('#percentagemOcupacao').text(percentagem+"%");
                    },
                    error:function(data)
                    {
                        console.log(data);
                        console.log("erro");
                    }
                });
            }
        });



        var dataTable = $('#reserva').DataTable({
            "paging":false,
            "processing":true,
            "serverSide":true,
            "order": [],
            "info":true,
            "ajax":{
                url:"busca_reserva.php",
                type:"POST"
            }
        });

     $(document).on('submit', '#form_reserva', function(event){ //Submeter uma nova reserva ou update a uma reserva
        event.preventDefault();

        var reserva_id = $('#reserva_id').val();
        var reserva_nome = $('#reserva_nome').val();
        var reserva_telemovel = $('#reserva_telemovel').val();
        var reserva_n_pessoas = $('#reserva_n_pessoas').val();
        var reserva_data = $('#reserva_data').val();
        var reserva_estado = $('#reserva_estado').val();
        var reserva_hora = $('#reserva_hora').val();
        var reserva_mesa_id = $('#mesa_id').val();
        let myForm = document.getElementById('form_reserva');
        let formData = new FormData(myForm);
        
        if(reserva_id != '' && reserva_nome != '' && reserva_telemovel != '' && reserva_n_pessoas != '' && reserva_data != '' && reserva_estado != '' && reserva_hora != '')
        {
            $.ajax({
                url:"insert_update_reserva.php",
                method:'POST',
                data:formData,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    $('#form_reserva')[0].reset();
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
        var reserva_id = $(this).attr("id");
        $('#mesa_id-group').show();
        $.ajax({
            url:"get_reserva.php",
            method:"POST",
            data:{reserva_id:reserva_id},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#reserva_id').val(data.reserva_id);
                $('#reserva_nome').val(data.cliente_nome);
                $('#reserva_telemovel').val(data.cliente_telemovel);
                $('#reserva_n_pessoas').val(data.n_pessoas);
                $('#reserva_data').val(data.reserva_data);
                $('#reserva_estado').val(data.reserva_estado);
                $('#reserva_hora').val(data.reserva_hora);
                $('#mesa_id-group').show();
                $('#mesa_id').val(data.mesa_id);
                $('.modal-title').text("Editar Reserva");
                $('#course_id').val(reserva_id);
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

        var reserva_id = $(this).attr("id");
        if(confirm("Tem a certeza que quer eliminar esta reserva?"))
        {
            $.ajax({
                url:"delete_reserva.php",
                method:"POST",
                data:{reserva_id:reserva_id},
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
