<div class="well optionBar" align="center">
	<h3>Configuraciones</h3>
</div>
<div class="well panel panel-default" style="margin-top:1%;">
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	  <!-- CAMBIAR CONTRASEÑA -->
	  <div class="panel panel-primary">
		<div class="panel-heading" role="tab" id="headingOne">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			  CAMBIAR CONTRASEÑA
			</a>
		  </h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		  <div class="panel-body">
			
			<div class="row">
				<div class="col-md-6 col-md-offset-3" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
					<form id="frmChangePass">
					  <div class="form-group">
						<label for="txtName">Contraseña actual:</label>
						<input type="password" required="true" class="form-control" id="txtActualPass" name="txtActualPass" placeholder="Ingrese Contraseña Actual"/>
					  </div>
					  <div class="form-group">
						<label for="txtName">Nueva contraseña:</label>
						<input type="password" required="true" class="form-control" id="txtNewPass" name="txtNewPass" placeholder="Ingrese Nueva Contraseña"/>
					  </div>
					  <div class="form-group">
						<label for="txtName">Nueva contraseña (Confirmar):</label>
						<input type="password" required="true" class="form-control" id="txtPassConfirm" name="txtPassConfirm" placeholder="Confirme Nueva Contraseña"/>
					  </div>
					  <div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<h5><strong>Aviso: </strong>El cambio de contraseña provocará el cierre de la sesión actual.</h5>
					  </div>
					  <div class="row">
						  <div class="col-xs-offset-4 col-md-offset-5">
							<button type="submit" class="button button-3d-primary button-rounded">Guardar</button>
						  </div>
					  </div>
					</form>
				</div>
			</div>
			
		  </div>
		</div>
	  </div>
	</div>
</div>
