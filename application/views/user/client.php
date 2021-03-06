<div class="well panel panel-default" style="margin-top:1%;">
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	  <!-- CREAR CLIENTE -->
	  <div class="panel panel-primary">
		<div class="panel-heading" role="tab" id="headingOne">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			  CREAR CLIENTE
			</a>
		  </h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		  <div class="panel-body">
			
			<div class="row">
				<div id="divFrmClient" class="col-md-6 col-md-offset-3" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
					<form id="frmNewClient">
						<fieldset class="scheduler-border">
						  <legend class="scheduler-border">Datos</legend>		  
						  <div class="form-group">
							<label for="txtName">C.I./R.U.C.:</label>
							<input type="text" required="true" class="form-control" id="txtCedula" name="txtCedula" placeholder="Ingrese C.I./R.U.C." maxlength="13"/>
						  </div>
						  <div class="form-group">
							<label for="txtName">Nombre:</label>
							<input type="text" required="true" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ingrese Nombre"/>
						  </div>
						  <div class="form-group">
							<label for="txtName">Apellido:</label>
							<input type="text" required="true" class="form-control" id="txtApellido" name="txtApellido" placeholder="Ingrese Apellido"/>
						  </div>
						  <div class="form-group">
							<label for="txtName">E-mail:</label>
							<input type="email"  class="form-control" id="txtEmail" name="txtEmail" placeholder="Ingrese Email"/>
						  </div>
						  <div class="form-group">
							<label for="txtName">Dirección:</label>
							<input type="text" required="true" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Ingrese Dirección"/>
						  </div>
						</fieldset>
					  
					  
					  <fieldset class="scheduler-border">
						<legend class="scheduler-border">Teléfonos</legend>
					  	<div class="form-group">
							
							<div class="input-group">
						      <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Ingrese Teléfono" maxlength="10" onkeypress="$.ValidaSoloNumeros()"/>
						      <span class="input-group-btn">
						        <button class="btn btn-default" type="button" title="Agregar Teléfono" id="btnTels"> <i class="glyphicon glyphicon-plus-sign"></i> <i class="glyphicon glyphicon-earphone"></i></button>
						      </span>
						    </div>
							
							
							<br>
							<div style="overflow-x:hidden; overflow-y:auto; max-height:110px;display:none;" id="divTbTels">
								<table class="table-hovered table-bordered" cellspacing="0" width="100%">
									
									<thead>
										<tr>
											<th class="text-center">Teléfono</th>
											<th class="text-center">Acción</th>
										</tr>
									</thead>
									<tbody id="tbodyTels">
										
									</tbody>
								</table>
							</div>
						</div>  
					  </fieldset>
					  
					  
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
	  <!--END CREAR CLIENTE-->
	  <!-- LISTAR MODELOS -->
	  <div class="panel panel-primary">
		<div class="panel-heading" role="tab" id="headingThree">
		  <h4 class="panel-title">
			<a class="collapsed" id="ltClient" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			  LISTAR CLIENTES
			</a>
		  </h4>
		</div>
		<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
		  <div class="panel-body">
			
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<table data-order='[[ 0, "asc" ]]' class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbClients">
						<thead>
							<tr>
								<th class="text-center"> Cédula </th>
								<th class="text-center"> Nombres </th>
								<th class="text-center"> Apellidos </th>
								<th class="text-center"> Teléfono(s) </th>
								<th class="text-center">Acción</th>
							</tr>
						</thead>
						
					</table>
				</div>
			</div>

		  </div>
		</div>
	  </div>
	  <!-- END LISTAR MODELOS -->
	</div>
</div>
<!-- Modal HTML -->
<div id="mdClient" class="modal fade">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Editar Cliente</h4>
			</div>
			<form role="form" id='frmMdClient'>
				<div class="modal-body">		
				
					<span id="spIdCliMd"></span>
					
					<fieldset class="scheduler-border">
						  <legend class="scheduler-border">Datos</legend>		  
						  <div class="form-group">
							<label for="txtNameMd">C.I./R.U.C.:</label>
							<input type="text" required="true" class="form-control" id="txtCedulaMd" name="txtCedulaMd" placeholder="Ingrese C.I./R.U.C."/>
						  </div>
						  <div class="form-group">
							<label for="txtName">Nombre:</label>
							<input type="text" required="true" class="form-control" id="txtNombreMd" name="txtNombreMd" placeholder="Ingrese Nombre"/>
						  </div>
						  <div class="form-group">
							<label for="txtName">Apellido:</label>
							<input type="text" required="true" class="form-control" id="txtApellidoMd" name="txtApellidoMd" placeholder="Ingrese Apellido"/>
						  </div>
						  <div class="form-group">
							<label for="txtName">E-mail:</label>
							<input type="email" class="form-control" id="txtEmailMd" name="txtEmailMd" placeholder="Ingrese Email"/>
						  </div>
						  <div class="form-group">
							<label for="txtName">Dirección:</label>
							<input type="text" required="true" class="form-control" id="txtDireccionMd" name="txtDireccionMd" placeholder="Ingrese Dirección"/>
						  </div>
						</fieldset>
					  
					  
					  <fieldset class="scheduler-border">
						<legend class="scheduler-border">Telefonos</legend>
					  	<div class="form-group">
							
							<div class="input-group">
						      <input type="text" class="form-control" id="txtTelefonoMd" placeholder="Ingrese Teléfono" maxlength="10" onkeypress="$.ValidaSoloNumeros()"/>
						      <span class="input-group-btn">
						        <button class="btn btn-default" type="button" title="Agregar Teléfono" id="btnTelsMd"> <i class="glyphicon glyphicon-plus-sign"></i> <i class="glyphicon glyphicon-earphone"></i></button>
						      </span>
						    </div>
							
							
							<br>
							<div style="overflow-x:hidden; overflow-y:auto; max-height:110px;display:none;" id="divTbTelsMd">
								<table class="table-hovered table-bordered" cellspacing="0" width="100%">
									
									<thead>
										<tr>
											<th class="text-center">Teléfono</th>
											<th class="text-center">Acción</th>
										</tr>
									</thead>
									<tbody id="tbodyTelsMd">
										
									</tbody>
								</table>
							</div>
						</div>  
					  </fieldset>
					
				</div>
			
				<div class="modal-footer">
					<div class="row">
						<div align="center">
							<button type="button" class="button button-3d button-rounded" data-dismiss="modal">Cancelar</button>
							<button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- End Modal HTML -->