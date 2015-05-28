<div class="well panel panel-default" style="margin-top:1%;min-height:590px;">
  <div class="panel-body">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#sectionA">Vehículo</a></li>
		<li><a data-toggle="tab" href="#sectionB">Marca</a></li>
		<li><a data-toggle="tab" href="#sectionC">Modelo</a></li>   
	</ul>
	<div class="tab-content">
		
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
							<div class="col-md-8 col-md-offset-2" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
								<form id="frmCar">
								  <span id="spClient"></span>
								  <fieldset class="scheduler-border">
									<legend class="scheduler-border">Datos Cliente</legend>
									  <div class="form-group col-xs-12">
										<label for="txtName">C.I./R.U.C.:</label><a id="searchClient"><img src="<?php echo base_url()?>static/img/search.png" style="height:30px;cursor:pointer;" alt=""> </a>
										<input type="text" required="true" class="form-control" id="txtCedula" name="txtCedula" placeholder="Ingrese C.I./R.U.C."/>
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtName">Nombre:</label>
										<input type="text" required="true" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ingrese Nombre"/>
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtName">Apellido:</label>
										<input type="text" required="true" class="form-control" id="txtApellido" name="txtApellido" placeholder="Ingrese Apellido"/>
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtName">Teléfono:</label>
										<input type="text" required="true" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Ingrese Teléfono"/>
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtName">E-mail:</label>
										<input type="email" required="true" class="form-control" id="txtEmail" name="txtEmail" placeholder="Ingrese Email"/>
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtName">Dirección:</label>
										<input type="text" required="true" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Ingrese Dirección"/>
									  </div>
								  </fieldset>
								  <fieldset class="scheduler-border" id="fstDataCar">
									<legend class="scheduler-border">Datos Vehículo</legend>
									  <div class="form-group col-md-6">
										<label for="cmbMarkAjx">Marca:</label>
										<select class="selectpicker" data-live-search="true" data-size="5" name="cmbIdMark" id="cmbMarkAjx">
										</select>
									  </div>
									  <div class="form-group col-md-6">
										<label for="cmbModelAjx">Modelo:</label>
										<select class="selectpicker" data-live-search="true" data-size="5" name="cmbIdModel" id="cmbModelAjx">
										</select>
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtName">Chasis:</label>
										<input type="text" required="true" class="form-control" id="txtNChasis" name="txtChasis" placeholder="Ingrese Nombre"/>
									  </div>
									  <div class="form-group col-xs-12">
										<label for="txtName">Motor:</label>
										<input type="text" required="true" class="form-control" id="txtMotor" name="txtMotor" placeholder="Ingrese Motor"/>
									  </div>
									  <div class="form-group col-xs-12 col-md-6">
										<label for="txtName">Placa:</label>
										<input type="text" required="true" class="form-control" id="txtPlaca" name="txtPlaca" placeholder="Ingrese Placa"/>
									  </div>
									  
									  <div class="form-group col-xs-12 col-md-6">
										<label for="txtName">Año:</label>
										<input type="number" min="1980" required="true" class="form-control" id="txtAnio" name="txtAnio" placeholder="Ingrese Año"/>
									  </div>
									  <div class="form-group col-xs-12 col-md-6">
										<label for="txtName">Color:</label>
										<div class="input-group demo2">
											<input type="text" value="" class="form-control" />
											<span class="input-group-addon"><i></i></span>
										</div>
									  </div>
									  <div class="form-group col-xs-12 col-md-6">
										<label for="txtName">Código:</label>
										<input type="text" required="true" class="form-control" id="txtCodigo" name="txtCodigo" placeholder="Ingrese Código"/>
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
						<div class="col-md-8 col-md-offset-2">
							<table data-order='[[ 0, "asc" ]]' class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbCar">
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
			  <!-- END LISTAR VEHICULO -->
			</div>
		</div>
		<!-- END VEHICULO -->
		
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
						<h4 class="modal-title">Editar Modelo</h4>
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
								<div class="col-md-10 col-md-offset-1">
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
				  
							  <div class="form-group">
								<label for="cmbMark">Marca:</label>
								<select class="selectpicker" data-live-search="true" data-size="5" name="id_mark" id="cmbMark">
									<?php
									if ( ! empty($mark))
									{
										foreach ($mark as $key => $value) 
										{
											echo "<option value='".$value['mar_id']."'>".$value['mar_nom']."</option>";
										}
									}
									else
									{
										echo "<option>Cree una Marca</option>";
									}
									?>
								</select>
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
			<div class="modal-dialog modal-sm">
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
			  
						  	<div class="form-group">
								<label for="txtMark">Marca:</label>
								<select class="selectpicker" data-live-search="true" data-size="5" name="id_markMd" id="cmbMarkMd">
									<?php
									if ( ! empty($mark))
									{
										foreach ($mark as $key => $value) 
										{
											echo "<option value='".$value['mar_id']."'>".$value['mar_nom']."</option>";
										}
									}
									else
									{
										echo "<option>Cree una Marca</option>";
									}
									?>
								</select>
						  	</div>
						</div>
					
						<div class="modal-footer">
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
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
	</div>
  </div>
</div>
