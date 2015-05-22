<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="<?php echo base_url()?>static/img/logo.png">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta charset="utf-8">
<script src="<?php echo base_url()?>static/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>static/js/header.js"></script>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>static/css/style.css" type="text/css">
<!--link rel="stylesheet" href="<?php echo base_url()?>static/css/boostrap.css" type="text/css"-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="<?= base_url() ?>static/css/buttons.css">
<script type="text/javascript" src="<?= base_url() ?>static/js/buttons.js"></script>

<?php  
	if ( ! empty($css))
	{
		foreach ($css as $key => $value) 
		{
			echo "<link rel='stylesheet' $key='$value'>";
		}
	}
?>

<title> sich - <?php echo $title ?></title>
</head>
<body>
<!--<div class="menu_templ" style="width:100%;max-width:612px;background-color:#d3c2bd;">-->
<div>

<!--header-->
<div class="navbar divMetro height-30pr encabezado" height="40px"  >
	<div class="container" style="margin:0px; padding:0px;" >
		<div class="imgHolder col-xs-8 col-sm-5 col-md-4 col-lg-3">
			<!--inicio prueba-->
			<ul id="menu1">
				<li><img src="<?php echo base_url()?>static/img/user.png" style="width:100%;" alt="">
					<ul>
						<li><a href="servicio1.html"><img src="<?php echo base_url()?>static/img/conf.png" style="width:15%; margin:5px;" alt="">Configuración</a></li>
						<li><a href="<?php echo base_url()?>main/logout/"><img src="<?php echo base_url()?>static/img/salir.png" style="width:15%; margin:5px;" alt="">Salir</a></li>
					</ul>
				</li>
			</ul>
			<!--fin prueba-->
			<span style='text-transform: capitalize;'>
				<?php 
					$user_data = (array)$this->session->userdata('logged_user');
					echo explode(" ", $user_data['per_nom'])[0].' '.explode(' ', $user_data['per_ape'])[0];
				?>
			</sapan>
		</div>
	</div>
</div>
<!--end header-->
<div class="container-fluid" style="padding:0px; margin-left:-5px; ">
  <div class="row-fluid">
    <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2" style="/*overflow-x:hidden; overflow-y:scroll; max-height:800px;*/">
		<ul id="css3menu1" class="topmenu">
			<li class="topmenu"><a id="mn_home" href="<?php echo base_url()?>main/home/" ><span><img src="<?php echo base_url()?>static/img/inicio.png" style="height:40px;" alt=""></br>Inicio</span></a></li>
			<li class="topmenu"><a href="#" ><span><img src="<?php echo base_url()?>static/img/cliente.png" style="height:40px;" alt=""></br>Clientes</span></a></li>
			<li class="topmenu"><a id="mn_car" href="<?php echo base_url()?>car/start" ><span><img src="<?php echo base_url()?>static/img/vehiculos.png" style="height:35px;" alt=""></br>Vehiculos</span></a></li>
			<li class="topmenu"><a onclick="seleccionar(this)" href="#"><span><img src="<?php echo base_url()?>static/img/servicios.png" style="height:40px;" alt=""></br>Servicios</span></a></li>
			<li class="topmenu"><a onclick="seleccionar(this)" href="#"><span><img src="<?php echo base_url()?>static/img/ordenTrabajo.png" style="height:40px;" alt=""></br>Orden de</br>Trabajo</span></a></li>
			<li class="topmenu"><a onclick="seleccionar(this)" href="#"></span><img src="<?php echo base_url()?>static/img/reportes.png" style="height:40px;" alt=""></br>Reportes</span></a></li>
		</ul>
	</div>
    <div class="col-xs-9 col-md-10">
    <!--Body content-->