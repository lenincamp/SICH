<?php if(@$this->user) redirect ('welcome/menu');?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="<?php echo base_url()?>static/img/logo.png">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta charset="utf-8">
<script src="<?php echo base_url()?>static/js/jquery-1.11.3.min.js"></script>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<LINK REL=StyleSheet HREF="<?php echo base_url()?>static/css/style.css" TYPE="text/css">
</head>
<body>
<!--<div class="menu_templ" style="width:100%;max-width:612px;background-color:#d3c2bd;">-->
<div>
<!--header-->
<div class="navbar divMetro height-30pr encabezado" height="40px"  >
	<div class="container" style="margin:0px; padding:0px;" >
		<div class="imgHolder col-xs-8 col-sm-5 col-md-4 col-lg-3">
			<img src="<?php echo base_url()?>static/img/logo_chan.png" style="width:100%;" alt="">
		</div>
	</div>
</div>
<!--end header-->
<div class="container-fluid bgLogin" style="padding:0px; margin-left:-5px; ">
  <div class="row-fluid">
    <div  style="/*overflow-x:hidden; overflow-y:scroll; max-height:800px;height:85vh; width:100%;*/">
		
		<?php if(@$error_login): ?>
			Error en el usuario o contrase&ntilde;a.
			<br />
		<?php endif; ?>
 
		<?php echo @validation_errors(); ?>
 
		<br />
		
		<div class="centrado">
			<div class=" bgCabeceraLogin" >
				<h3 style="">Inicio de Sesión</h3>
			</div>
			<div class="divMetro contenedorLogin" align="center">
				<form method='post' action='<?php echo base_url()?>welcome/login/'>
				<div class="campoLogin">
					<img src="<?php echo base_url()?>static/img/perfil.png">
					<input placeholder="Usuario" type="text" id="username" name="username" value="<?php echo @$this->input->post('username'); ?>">
				</div>
				<div class="campoLogin">
					<img src="<?php echo base_url()?>static/img/pass.png">
					<input placeholder="Contraseña" type="password" id="password" name="password" value="<?php echo @$this->input->post('password'); ?>">
				</div>
				<input class="buttonLogin" type="submit" value="ENTRAR">
				</form>
				
			</div>
		</div>
    </div>
  </div>
<!--footer-->
<div class="navbar-inverse navbar-fixed-bottom" style="background-color:rgba(15,15,15,0.9); margin-top:10px;" role="navigation">
	<div class="container" style="margin:0px;" >
		<a href="http://www.alexnb92.wix.com/encoding-ideas" style="color:white; font-size:2vmin ;">
			<img src="<?php echo base_url()?>static/img/mini_logo.png" style="height:30px;" alt="">
			Desarrollado por <b>Encoding Ideas</b>
		</a>
	</div>
</div>
</body>
</html>
