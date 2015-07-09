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
						  <div align="center">
							<button type="submit" class="button button-3d-primary button-rounded">Guardar</button>
						  </div>
					  </div>
					</form>
				</div>
			</div>
		  </div>
		</div>
	  </div>
	  <!-- PARAMETRO DE ORDENES DE TRABAJO -->
	  <div class="panel panel-primary">
		<div class="panel-heading" role="tab" id="headingTwo">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			  PARAMETRO DE ORDENES DE TRABAJO
			</a>
		  </h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		  <div class="panel-body">
			
			<div class="row">
				<div class="col-md-6 col-md-offset-3" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
					<form id="frmParamsOrd">
					  <div class="form-group">
						<label for="txtNumOrd">N° de Orden de Trabajo Actual:</label>
						<input type="number" required="true" min="1" step="1" required="true" class="form-control" id="txtNumOrd" name="txtNumOrd" value="<?php if ( ! empty($params)){echo $params[0]["num_ord"];}?>" placeholder="Ingrese N° de Orden de Trabajo Actual"/>
					  </div>
					  <div class="form-group">
						<label for="txtIva">Iva(%):</label>
						<input type="number" required="true" min="0" step="0.01" required="true" class="form-control" id="txtIva" value="<?php if ( ! empty($params)){echo $params[0]["iva"];}?>"  name="txtIva" placeholder="Ingrese porcentaje de IVA"/>
					  </div>
					  <div class="form-group">
						<label for="txtMrgTop">Margen Superior(cm):</label>
						<input type="number" required="true" min="0" step="0.01" required="true" class="form-control" id="txtMrgTop" value="<?php if ( ! empty($params)){echo $params[0]["mrg_top_ord"];}?>"  name="txtMrgTop" placeholder="Ingrese margen superior"/>
					  </div>
					  <div class="row">
						  <div align="center">
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
