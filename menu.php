<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Menu</title>
<link rel="stylesheet" href="css/style.css">
<!-- jQuery e Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 </head>
<body>
<nav id="barra_navegacao" class="navbar navbar-inverse">
	<div class="container-fluid">
		<ul class="nav navbar-nav">
			<li><a href="index.php">Home</a></li>
			<li class="active"><a href="menu.php">Menu</a></li>
			<li><a href="contatos.php">Contatos</a></li>
			<li><a href="login.php">Gerência</a></li>
		</ul>
	</div>
</nav>
<nav id="barra_navegacao2" class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
			<li class="list active" data-filter="all"><a href="#">Tudo</a></li>
			<li class="list" data-filter="carnes"><a href="#">Carnes</a></li>
			<li class="list" data-filter="sushi"><a href="#">Sushi</a></li>
			<li class="list" data-filter="peixe"><a href="#">Peixe</a></li>
			<li class="list" data-filter="sobremesa"><a href="#">Sobremesa</a></li>
			<li class="list" data-filter="bebidas"><a href="#">Bebidas</a></li>
        </ul>
    </div>
</nav>
<section>
	<div class="product">
	<div id="box">
	<ul class="estilizacao">
		<li class="itemBox carnes">
			<img src="img/costeletao.png" >
			<div class="conteudo">
				<p class="prato ">Costeletão (2px)</p>
				<p class="preco">29 €</p>
			</div>
		</li>
		<li class="itemBox carnes">
			<img src="img/peito_frango.png" >
			<div class="conteudo">
				<p class="prato ">Peito de Frango</p>
				<p class="preco">14 €</p>
			</div>
		</li>
		<li class="itemBox carnes">
			<img src="img/vitelao.png" >
			<div class="conteudo">
				<p class="prato ">Vitelão</p>
				<p class="preco">14 €</p>
			</div>
		</li>
		<li class="itemBox sushi">
			<img src="img/sushi_16.png" >
			<div class="conteudo">
				<p class="prato ">Freestyle 16pc</p>
				<p class="preco">19 €</p>
			</div>
		</li>
		<li class="itemBox sushi">
			<img src="img/sushi_25.png" >
			<div class="conteudo">
				<p class="prato ">Freestyle 25pc</p>
				<p class="preco">28 €</p>
			</div>
		</li>
		<li class="itemBox sushi">
			<img src="img/sushi_carpaccio.png" >
			<div class="conteudo">
				<p class="prato ">Carpaccio</p>
				<p class="preco">16 €</p>
			</div>
		</li>
		<li class="itemBox peixe">
			<img src="img/arroz_marisco.png" >
			<div class="conteudo">
				<p class="prato ">Arroz de Marisco</p>
				<p class="preco">8 €</p>
			</div>
		</li>
		<li class="itemBox peixe">
			<img src="img/camarao_tigre.png" >
			<div class="conteudo">
				<p class="prato ">Camarão Tigre Neroxs</p>
				<p class="preco">11,90 €</p>
			</div>
		</li>
		<li class="itemBox sobremesa">
			<img src="img/sobremesa_terrina_bolacha.png" >
			<div class="conteudo">
				<p class="prato ">Terrina de Bolacha</p>
				<p class="preco">1,10 €</p>
			</div>
		</li>
		<li class="itemBox sobremesa">
			<img src="img/sobremesa_doce_ovos.png" >
			<div class="conteudo">
				<p class="prato ">Doce de Ovos</p>
				<p class="preco">2 €</p>
			</div>
		</li>
			<li class="itemBox bebidas">
			<img src="img/long_island.png" >
			<div class="conteudo">
				<p class="prato ">Long Island Iced Tea</p>
				<p class="preco">1,10 €</p>
			</div>
		</li>
			<li class="itemBox bebidas">
			<img src="img/cocktail_do_dia.png" >
			<div class="conteudo">
				<p class="prato ">Cocktail do Dia</p>
				<p class="preco">1,40 €</p>
		</li>
			</div>

	</ul>
	</div>
</section>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.5.1.js"integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
crossorigin="anonymous">
</script>

<script type="text/javascript">
	$(document).ready(function(){
	$('.list').click(function(){
		const value = $(this).attr('data-filter');
			if(value == 'all'){
			$('.itemBox').show('1000');
			} else{
				$('.itemBox').not('.'+value).hide('1000');
				$('.itemBox').filter('.'+value).show('1000');
			}
	})	
		$('.list').click	(function(){
			$(this).addClass('active').siblings().removeClass('active');
		})	
	})
</script>
<!---->  
