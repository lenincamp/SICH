<div class="well panel panel-default" style="margin-top:1%;min-height:590px;">
  <div class="panel-body">
	<ul class="nav nav-tabs">
		<li><a data-toggle="tab" href="#sectionB">Marca</a></li>
		<li><a data-toggle="tab" href="#sectionD">Categoría</a></li>
		<li><a data-toggle="tab" href="#sectionC">Modelo</a></li>
		<li class="active"><a data-toggle="tab" href="#sectionA">Vehículo</a></li>
		<li><a data-toggle="tab" href="#sectionE">Detalle de Inventario</a></li>
	</ul>
	<div class="tab-content">
		
		<!-- MARCA -->
		<div id="sectionB" class="tab-pane fade">
			<br>
			<div class="panel-group" id="accordionMarks" role="tablist" aria-multiselectable="true">
			  
			  <!-- CREAR MARCA -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingSaveMark">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordionMarks" href="#collapseSaveMark" aria-expanded="true" aria-controls="collapseSaveMark">
					  CREAR MARCA
					</a>
				  </h4>
				</div>
				<div id="collapseSaveMark" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSaveMark">
					<div class="panel-body">
						<div class="row">
							<div id="divFrmMark" class="col-md-6 col-md-offset-3" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
								<form id="frmMark">
								  <div class="form-group">
									<label for="txtName">Nombre:</label>
									<input type="text" class="form-control" id="txtNameMark" name="nameMark" placeholder="Ingrese Nombre">
								  </div>
					  
								  <div class="row">
									  <div class="col-md-offset-5">
										<button type="submit" class="button button-3d-primary button-rounded">Guardar</button>
									  </div>
								  </div>
								</form>
							</div>
						</div>
					</div>
				</div>
			  </div>
			  <!-- END CREAR MARCA -->
			  
			  <!-- LISTAR MARCA -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingListMarks">
				  <h4 class="panel-title">
					<a class="collapsed" id="ltMark" data-toggle="collapse" data-parent="#accordionMarks" href="#collapseListMarks" aria-expanded="false" aria-controls="collapseListMarks">
					  LISTAR MARCAS
					</a>
				  </h4>
				</div>
				<div id="collapseListMarks" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingListMarks">
				  <div class="panel-body">
					
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<table data-order='[[ 0, "asc" ]]' class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbMarks">
								<thead>
									<tr>
										<th class="text-center"> Nombre </th>
										<th class="text-center">Acción</th>
									</tr>
								</thead>
								
							</table>
						</div>
					</div>

				  </div>
				</div>
			  </div>
			  <!-- END LISTAR MARCA -->
			</div>
				
		</div>
		
		<!-- Modal Marca HTML -->
		<div id="markModal" class="modal fade">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Editar Marca</h4>
					</div>
					<form role="form" id='frmMdMark'>
						<div class="modal-body">		
							<span id="spIdMk"></span>
							<div class="form-group">
								<label for="txtName">Nombre:</label>
								<input type="text" class="form-control" id="txtNameMarkEdit" name="nameMarkEdit" placeholder="Ingrese Nombre">
							</div>
			  
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
		<!-- END MARCA -->
		
		<!-- CATEGORIA -->
		<div id="sectionD" class="tab-pane fade">
			<br>
			<div class="panel-group" id="accordionCateg" role="tablist" aria-multiselectable="true">
			  
			  <!-- CREAR CATEGORIA -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingSaveMark">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordionCateg" href="#collapseSaveCateg" aria-expanded="true" aria-controls="collapseSaveCateg">
					  CREAR CATEGORIA
					</a>
				  </h4>
				</div>
				<div id="collapseSaveCateg" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSaveMark">
					<div class="panel-body">
						<div class="row">
							<div id="divFrmCateg" class="col-md-6 col-md-offset-3" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
								<form id="frmCateg">
								  <div class="form-group">
									<label for="txtName">Nombre:</label>
									<input type="text" class="form-control" id="txtNameCateg" name="txtNameCateg" placeholder="Ingrese Nombre">
								  </div>
					  
								  <div class="row">
									  <div class="col-md-offset-5">
										<button type="submit" class="button button-3d-primary button-rounded">Guardar</button>
									  </div>
								  </div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
			  </div>
			  <!-- END CREAR CATEGORIA -->
			  
			  <!-- LISTAR CATEGORIA -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingListCateg">
				  <h4 class="panel-title">
					<a class="collapsed" id="ltCateg" data-toggle="collapse" data-parent="#accordionCateg" href="#collapseListCateg" aria-expanded="false" aria-controls="collapseListCateg">
					  LISTAR CATEGORIAS
					</a>
				  </h4>
				</div>
				<div id="collapseListCateg" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingListCateg">
				  <div class="panel-body">
					
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<table data-order='[[ 0, "asc" ]]' class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbCateg">
								<thead>
									<tr>
										<th class="text-center">Nombre</th>
										<th class="text-center">Acción</th>
									</tr>
								</thead>
								
							</table>
						</div>
					</div>

				  </div>
				</div>
			  </div>
			  <!-- END LISTAR CATEGORIA -->
			</div>
				
		</div>
		
		<!-- Modal CATEGORIA HTML -->
		<div id="categModal" class="modal fade">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Editar Categoría</h4>
					</div>
					<form role="form" id='frmMdCateg'>
						<div class="modal-body">		
							<span id="spIdCateg"></span>
							<div class="form-group">
								<label for="txtName">Nombre:</label>
								<input type="text" class="form-control" id="txtNameCategEdit" name="txtNameCategEdit" placeholder="Ingrese Nombre">
							</div>
			  
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
		<!-- END CATEGORIA -->
		
		
		
		<!-- MODELO -->
		<div id="sectionC" class="tab-pane fade">
			<br>

			<div class="panel-group" id="accordionModels" role="tablist" aria-multiselectable="true">
			  
			  <!-- CREAR MODELO -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingOne">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordionModels" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					  CREAR MODELO
					</a>
				  </h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				  <div class="panel-body">
					
					<div class="row">
						<div class="col-md-6 col-md-offset-3" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
							<form id="frmModel">
							  <div class="form-group">
								<label for="txtName">Nombre:</label>
								<input type="text" class="form-control" id="txtName" name="name" placeholder="Ingrese Nombre"/>
							  </div>
				  			  <div class="row">
				  			  	<div class="col-xs-6">
								  <div class="form-group">
									<label for="cmbMark">Marca:</label>
									<select class="form-control" name="id_mark" id="cmbMark">
									</select>
								  </div>
								</div>
								<div class="col-xs-6">
								  <div class="form-group">
									<label for="cmbCat">Categoria:</label>
									<select class="form-control" name="id_cat" id="cmbCat">
									</select>
								  </div>
								</div>
							 </div>
				  
							  <div class="row">
								  <div class="col-md-offset-5">
									<button type="submit" class="button button-3d-primary button-rounded">Crear</button>
								  </div>
							  </div>
							</form>
						</div>
					</div>
					
				  </div>
				</div>
			  </div>
			  <!-- END CREAR MODELO -->
			  
			  <!-- BUSCAR MODELO -->
			  <!--div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingTwo">
				  <h4 class="panel-title">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					  BUSCAR MODELO
					</a>
				  </h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
				  <div class="panel-body">
					Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
				  </div>
				</div>
			  </div-->
			  <!-- END BUSCAR MODELO -->
			  
			  <!-- LISTAR MODELOS -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingThree">
				  <h4 class="panel-title">
					<a class="collapsed" id="ltModel" data-toggle="collapse" data-parent="#accordionModels" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					  LISTAR MODELOS
					</a>
				  </h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
				  <div class="panel-body">
					
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<table data-order='[[ 1, "asc" ],[ 0, "asc" ]]' class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbModels">
								<thead>
									<tr>
										<th class="text-center"> Nombre </th>
										<th class="text-center"> Marca </th>
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
		<div id="mdModel" class="modal fade">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Editar Modelo</h4>
					</div>
					<form role="form" id='frmMdModel'>
						<div class="modal-body">		
						
							<span id="spId"></span>
							<div class="form-group">
								<label for="txtNameMd">Nombre:</label>
								<input type="text" class="form-control" id="txtNameMd" name="nameMd" placeholder="Ingrese Nombre"/>
						  	</div>
			 
							<div class="row">
				  			  	<div class="col-xs-6">
								  <div class="form-group">
									<label for="cmbMark">Marca:</label>
									<select class="form-control" name="id_markMd" id="cmbMarkMd">
									</select>
								  </div>
								</div>
								<div class="col-xs-6">
								  <div class="form-group">
									<label for="cmbCat">Categoria:</label>
									<select class="form-control" name="id_catMd" id="cmbCatMd">
									</select>
								  </div>
								</div>
							 </div>
							  
						</div>
					
						<div class="modal-footer">
							<div class="row">
								<div class="col-md-8">
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
		<!-- END MODELO -->
		
		<!-- VEHICULO -->
		<div id="sectionA" class="tab-pane fade in active">
			<br>
			<div class="panel-group" id="accordionCar" role="tablist" aria-multiselectable="true">
			  
			  <!-- CREAR VEHICULO -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingSaveCar">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordionCar" href="#collapseSaveCar" aria-expanded="true" aria-controls="collapseSaveCar">
					  CREAR VEHICULO
					</a>
				  </h4>
				</div>
				<div id="collapseSaveCar" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSaveCar">
					<div class="panel-body">
						<div class="row">
							<div id="divFrmCar" class="col-md-8 col-md-offset-2" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
								<form id="frmCar" enctype="multipart/form-data">
								  <span id="spClient"></span>
								  <fieldset class="scheduler-border" id="fstDataCli">
									<legend class="scheduler-border">Datos Cliente</legend>
									  <div class="form-group col-xs-12">
										<label for="txtCedula">C.I./R.U.C.:</label><a id="searchClient"><img src="<?php echo base_url()?>static/img/search.png" style="height:30px;cursor:pointer;" alt=""> </a>
										<input type="text" required="true" class="form-control" id="txtCedula" name="txtCedula" placeholder="Ingrese C.I./R.U.C."/>
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtNombre">Nombre:</label>
										<input type="text" required="true" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ingrese Nombre"/>
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtApellido">Apellido:</label>
										<input type="text" required="true" class="form-control" id="txtApellido" name="txtApellido" placeholder="Ingrese Apellido"/>
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtEmail">E-mail:</label>
										<input type="email" required="true" class="form-control" id="txtEmail" name="txtEmail" placeholder="Ingrese Email"/>
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtDireccion">Dirección:</label>
										<input type="text" required="true" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Ingrese Dirección"/>
									  </div>
									  
									  <fieldset class="scheduler-border">
										<legend class="scheduler-border"><h5>Telefonos</h5></legend>
									  	<div class="form-group">
											
											<div class="input-group">
										      <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Ingrese Teléfono" maxlength="10"/>
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
									  
								  </fieldset>
								  <fieldset class="scheduler-border" id="fstDataCar">
									<legend class="scheduler-border">Datos Vehículo</legend>
									  <div class="form-group col-md-6" id="divCmbMarkAjx">
										<label for="cmbMarkAjx">Marca:</label>
										<select class="form-control" name="cmbIdMark" id="cmbMarkAjx">
										</select>
										
									  </div>
									  <div class="form-group col-md-6" id="divCmbMarkAjx">
										<label for="cmbModelAjx">Modelo:</label>
 										<select class="form-control" name="cmbIdModel" id="cmbModelAjx">
										</select>
 										
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtNChasis">Chasis:</label>
										<input type="text" class="form-control" id="txtNChasis" name="txtChasis" placeholder="Ingrese Nombre"/>
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtMotor">Motor:</label>
										<input type="text" required="true" class="form-control" id="txtMotor" name="txtMotor" placeholder="Ingrese Motor"/>
									  </div>
									  <div class="form-group col-xs-12 col-md-6">
										<label for="txtPlaca">Placa:</label>
										<input type="text" required="true" class="form-control" id="txtPlaca" name="txtPlaca" placeholder="Ingrese Placa"/>
									  </div>
									  
									  <div class="form-group col-xs-12 col-md-6">
										<label for="txtAnio">Año:</label>
										<input type="number" min="1980" required="true" class="form-control" id="txtAnio" name="txtAnio" placeholder="Ingrese Año"/>
									  </div>
									  <div class="form-group col-xs-12 col-md-6">
										<label for="txtColor">Color:</label>
										<div class="input-group demo2">
											<input type="text" value="" class="form-control" id="txtColor" name="txtColor"/>
											<span class="input-group-addon"><i></i></span>
										</div>
									  </div>
									  <div class="form-group col-xs-12 col-md-6" id="divTxtCodigo">
										
									  </div>
									  <div class="form-group col-xs-12">
										<label for="images">Fotos:</label>
										<div class="col-xs-12"></div>
										<input name="images[]" id="images" type="file"  multiple="multiple" required = "required"/>
									  </div>
									  	  
								  
								  </fieldset>
								  
								  
								  <div class="row">
									  <div class="col-md-offset-5">
										<button type="submit" class="button button-3d-primary button-rounded">Guardar</button>
									  </div>
								  </div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
			  </div>
			  <!-- END CREAR VEHICULO -->
			  
			  <!-- LISTAR VEHICULO -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingListCar">
				  <h4 class="panel-title">
					<a class="collapsed" id="ltCar" data-toggle="collapse" data-parent="#accordionCar" href="#collapseListCar" aria-expanded="false" aria-controls="collapseListCar">
					  LISTAR VEHICULOS
					</a>
				  </h4>
				</div>
				<div id="collapseListCar" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingListCar">
				  <div class="panel-body">
					
					<div class="row">
						<div class="col-md-12">
							<table class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbCars">
								<thead>
									<tr>
										<th class="text-center">Cédula</th>
										<th class="text-center">Nombre</th>
										<th class="text-center">Marca</th>
										<th class="text-center">Modelo</th>
										<th class="text-center">Placa</th>
										<th class="text-center">Color</th>
										<th class="text-center">Acción</th>
									</tr>
								</thead>
								
							</table>
						</div>
					</div>

				  </div>
				</div>
			  </div>
			  <!-- END LISTAR VEHICULO -->
			</div>
		</div>
		
		<!-- Modal Vehiculo HTML -->
		<div id="mdCar" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Editar Vehículo</h4>
					</div>
					
					<form role="form" id='frmMdCar'>
						<div class="modal-body" id="mdBdCar">
						  <span id="spMdCar"></span>
						  <fieldset class="scheduler-border" id="fstMdDataCli">
							<span id="spMdClient"></span>
							<legend class="scheduler-border">Datos Cliente</legend>
							  <div class="form-group col-xs-12">
								<label for="txtCedulaMd">C.I./R.U.C.:</label>
								<input type="text" required="true" class="form-control" id="txtCedulaMd" name="txtCedulaMd" placeholder="Ingrese C.I./R.U.C."/>
							  </div>
							  <div class="form-group col-xs-12">
								<label for="txtNombreMd">Nombre:</label>
								<input type="text" required="true" class="form-control" id="txtNombreMd" name="txtNombreMd" placeholder="Ingrese Nombre"/>
							  </div>
							  <div class="form-group col-xs-12">
								<label for="txtApellidoMd">Apellido:</label>
								<input type="text" required="true" class="form-control" id="txtApellidoMd" name="txtApellidoMd" placeholder="Ingrese Apellido"/>
							  </div>
							  <div class="form-group col-xs-12">
								<label for="txtEmailMd">E-mail:</label>
								<input type="email" required="true" class="form-control" id="txtEmailMd" name="txtEmailMd" placeholder="Ingrese Email"/>
							  </div>
							  <div class="form-group col-xs-12">
								<label for="txtDireccionMd">Dirección:</label>
								<input type="text" required="true" class="form-control" id="txtDireccionMd" name="txtDireccionMd" placeholder="Ingrese Dirección"/>
							  </div>
							  
							  <fieldset class="scheduler-border">
								<legend class="scheduler-border"><h5>Telefonos</h5></legend>
							  	<div class="form-group">
									
									<div class="input-group">
								      <input type="text" class="form-control" id="txtTelefonoMd" name="txtTelefonoMd" placeholder="Ingrese Teléfono" maxlength="10"/>
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
							  
						  </fieldset>
						  <fieldset class="scheduler-border" id="fstDataCarMd">
							<legend class="scheduler-border">Datos Vehículo</legend>
							  <div class="form-group col-md-6" id="divCmbMarkAjxMd">
								<label for="cmbMarkAjxMd">Marca:</label>
								<select class="form-control" name="cmbIdMarkMd" id="cmbMarkAjxMd">
								</select>
								
							  </div>
							  <div class="form-group col-md-6" id="divCmbMarkAjx">
								<label for="cmbModelAjxMd">Modelo:</label>
								<select class="form-control" name="cmbIdModelMd" id="cmbModelAjxMd">
								</select>
								
							  </div>
							  <div class="form-group col-xs-12">
								<label for="txtNChasisMd">Chasis:</label>
								<input type="text" class="form-control" id="txtNChasisMd" name="txtChasisMd" placeholder="Ingrese Nombre"/>
							  </div>
							  <div class="form-group col-xs-12">
								<label for="txtMotorMd">Motor:</label>
								<input type="text" required="true" class="form-control" id="txtMotorMd" name="txtMotorMd" placeholder="Ingrese Motor"/>
							  </div>
							  <div class="form-group col-xs-12 col-md-6">
								<label for="txtPlaca">Placa:</label>
								<input type="text" required="true" class="form-control" id="txtPlacaMd" name="txtPlacaMd" placeholder="Ingrese Placa"/>
							  </div>
							  
							  <div class="form-group col-xs-12 col-md-6">
								<label for="txtAnio">Año:</label>
								<input type="number" min="1980" required="true" class="form-control" id="txtAnioMd" name="txtAnioMd" placeholder="Ingrese Año"/>
							  </div>
							  <div class="form-group col-xs-12 col-md-6">
								<label for="txtColor">Color:</label>
								<div class="input-group demo2">
									<input type="text" value="" class="form-control" id="txtColorMd" name="txtColorMd"/>
									<span class="input-group-addon"><i></i></span>
								</div>
							  </div>
							  <div class="form-group col-xs-12 col-md-6" id="divTxtCodigoMd">
								
							  </div>
							  <div class="form-group col-xs-12" id="divImagesMd">
								<label for="imagesMd">Fotos:</label>
								<div class="col-xs-12" id="divImgsMd"></div>
								<input name="imagesMd[]" id="imagesMd" type="file"  multiple="multiple"/>
							  </div>
						  </fieldset>	
						</div>
						
						<div class="modal-footer">
							<div class="row">
								<div class="col-md-8">
									<button type="button" class="button button-3d button-rounded" data-dismiss="modal">Cancelar</button>
									<button type="submit"  class="button button-3d-primary button-rounded">Guardar</button>
								</div>
							</div>
						</div>
					</form>	
				</div>
			</div>
		</div>
		<!-- End Modal Vehiculo HTML -->
		
		<!-- END VEHICULO -->
		<!-- DETALLE DE INVENTARIO -->
		<div id="sectionE" class="tab-pane fade">
			<br>
			<div class="panel-group" id="accordionInventario" role="tablist" aria-multiselectable="true">
			  
			  <!-- CREAR DETALLE DE INVENTARIO -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingSaveInventario">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordionInventario" href="#collapseSaveInventario" aria-expanded="true" aria-controls="collapseSaveInventario">
					  CREAR DETALLE DE INVENTARIO
					</a>
				  </h4>
				</div>
				<div id="collapseSaveInventario" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSaveInventario">
					<div class="panel-body">
						<div class="row">
							<div id="divFrmInventario" class="col-md-6 col-md-offset-3" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
								<form id="frmInventario">
								  <div class="form-group">
									<label for="txtNameInventario">Nombre:</label>
									<input type="text" class="form-control" id="txtNameInventario" name="txtNameInventario" placeholder="Ingrese Nombre">
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
			  <!-- END CREAR DETALLE DE INVENTARIO -->
			  
			  <!-- LISTAR DETALLE DE INVENTARIO -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingListInventarios">
				  <h4 class="panel-title">
					<a class="collapsed" id="ltInventario" data-toggle="collapse" data-parent="#accordionInventario" href="#collapseListInventarios" aria-expanded="false" aria-controls="collapseListInventarios">
					  LISTAR DETALLES DE INVENTARIO
					</a>
				  </h4>
				</div>
				<div id="collapseListInventarios" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingListInventarios">
				  <div class="panel-body">
					
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<table data-order='[[ 0, "asc" ]]' class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbInventarios">
								<thead>
									<tr>
										<th class="text-center"> Nombre </th>
										<th class="text-center">Acción</th>
									</tr>
								</thead>
								
							</table>
						</div>
					</div>

				  </div>
				</div>
			  </div>
			  <!-- END LISTAR DETALLE DE INVENTARIO -->
			</div>
				
		</div>
		
		<!-- Modal DETALLE DE INVENTARIO HTML -->
		<div id="inventarioModal" class="modal fade">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Editar Detalle de Inventario</h4>
					</div>
					<form role="form" id='frmMdInventario'>
						<div class="modal-body">		
							<span id="spIdInv"></span>
							<div class="form-group">
								<label for="txtNameInventarioEdit">Nombre:</label>
								<input type="text" class="form-control" id="txtNameInventarioEdit" name="txtNameInventarioEdit" placeholder="Ingrese Nombre">
							</div>
			  
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
		<!-- END DETALLE DE INVENTARIO -->
	</div>
  </div>
</div>
