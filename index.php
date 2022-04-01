<!DOCTYPE html>
<html lang="pt">
<head>
    <title>ORDO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- jQuery e Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- DataTimePicker -->
    <script src="js/jquery.datetimepicker.full.min.js"></script>
    <link rel="stylesheet" href="css/jquery.datetimepicker.min.css">
    
    <!-- Nosso CSS e JS -->
    <link rel="stylesheet" href="css/style.css">
    <script src="js/scripts.js"></script>
</head>
<body>

<nav id="barra_navegacao" class="navbar navbar-inverse">
    <div class="container-fluid">

        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="contatos.php">Contatos</a></li>
            <li><a href="login.php">Gerência</a></li>
        </ul>
    </div>
</nav>
  
<div class="container">
    <div class="row justify-content-center">
        <div id="area_esquerda" class="col-xs-6 my-auto">
            <img src="img/ordo.png" alt="Ordo Logo" id="ordo_logo" href="#"></img>
            <button type="button" id="btn_reservar" class="btn btn-lg btn-block" data-toggle="modal" data-target="#modalReserva">Reservar!</button>
        </div>
        <div class="col-xs-6" style="display: flex;flex-direction: column;">
            <img id="pratoPrincipal" src="img/sushi_25.png">
            <div id="pratosIcones">
                <img class="pratos" src="img/camarao_tigre.png" onmouseover="bigImg(this)">
                <img class="pratos" src="img/long_island.png" onmouseover="bigImg(this)">  
                <img class="pratos" src="img/sushi_25.png" onmouseover="bigImg(this)">
            </div>     
        </div>
    </div>
</div>

<footer>
    <div id="NAOELIMINAR">
    </div>
    <div id="footer_texto">
        <p>Universidade Portucalense 20/21
        Projeto Reservas de Restaurante</p>
        <p>Fernanda Fortes, Jonas Louras, Jonathan Silva e Delsey Cheiz </p>
    </div>
    <div>
        <a href="https://www.instagram.com/ordobhconcept/"><img class="footer_icons" src="img/instagram.png" alt="Instagram"></a>
        <a href="https://www.facebook.com/ORDO.BH.Concept"><img class="footer_icons" src="img/facebook.png" alt="Facebook"></a>
        <a href="https://www.zomato.com/pt/porto/ordo-bh-concept-le%C3%A7a-do-balio"><img class="footer_icons" src="img/zoomato.png" alt="Zoomato"></a>
    </div>
</footer>

</body>
</html>



<div id="modalReserva" class="modal fade">
    <div class="modal-dialog">
        <form autocomplete="off" method="post" id="form_reserva" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Reservar</h4>
                </div>
                <div class="modal-body">
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

<script>
    // input data -> datetimepicker
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

$(document).on('submit', '#form_reserva', function(event){ //Submeter uma nova reserva ou update a uma reserva
    event.preventDefault();
    var nome = $('#reserva_nome').val();
    var telemovel = $('#reserva_telemovel').val();
    var npessoas = $('#reserva_n_pessoas').val();
    var data = $('#reserva_data').val();
    var hora = $('#reserva_hora').val();
    let myForm = document.getElementById('form_reserva');
    $('#operation').val("Add");
    let formData = new FormData(myForm);
    if(reserva_nome != '' && reserva_telemovel != '' && reserva_n_pessoas != '' && reserva_data != ''  && reserva_hora != '')
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
                $('#modalReserva').modal('hide');
                alert("Reserva efetuada com sucesso!");
            },
            error:function(data)
            {
                alert("Erro, tente de novo.");
                console.log(data);
            }
        });
    }
    else
    {
        alert("Por favor preencha todos os campos.");
    }
});
</script>
