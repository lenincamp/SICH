<div class="well panel panel-default" style="margin-top:1%;min-height:590px;">
  <div class="panel-body">
	<ul class="nav nav-tabs">
		<li><a data-toggle="tab" href="#sectionA">Crear</a></li>
		<li class="active"><a data-toggle="tab" href="#sectionB">Pendientes</a></li>
	</ul>
	<div class="tab-content">
		
		<!-- SERVICIOS -->
		<div id="sectionA" class="tab-pane fade">
			<br>
			<div class="panel-group" id="accordionCar" role="tablist" aria-multiselectable="true">
			  
			  <!-- CREAR GARANTIA -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingSaveCar">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordionCar" href="#collapseSaveCar" aria-expanded="true" aria-controls="collapseSaveCar">
					  CREAR GARANTIA
					</a>
				  </h4>
				</div>
				<div id="collapseSaveCar" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSaveCar">
					<div class="panel-body">
						<span id="ars"></span>
						<div class="row">
							<div class="col-md-8 col-md-offset-2" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
								<form id="frmServices">
									<div class="form-group">
										<label for="txtNameService">EN CONSTRUCCION:</label>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
			  </div>
			  <!-- END CREAR GARANTIA -->
			  
			  <!-- LISTAR GARANTIA -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingListCar">
				  <h4 class="panel-title">
					<a class="collapsed" id="ltService" data-toggle="collapse" data-parent="#accordionCar" href="#collapseListService" aria-expanded="false" aria-controls="collapseListService">
					  LISTAR GARANTIA
					</a>
				  </h4>
				</div>
				<div id="collapseListService" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingListCar">
				  <div class="panel-body">
					
					<div class="row">
						<div class="col-xs-12">
							<table data-order='[[ 0, "asc" ]]' class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbService">
								<thead>
									<tr>
										<th class="text-center">Fecha</th>
										<th class="text-center">Cliente</th>
										<th class="text-center">Vehículo</th>
										<th class="text-center">Placa</th>
										<th class="text-center">Servicios</th>
										<th class="text-center">Acción</th>
									</tr>
								</thead>
								
							</table>
						</div>
					</div>

				  </div>
				</div>
			  </div>
			  <!-- END LISTAR SERVICIO -->
			</div>
		</div>
		<!-- Modal SERVICIO HTML -->
		<div id="servicioModal" class="modal fade">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Editar Servicio</h4>
					</div>
					<form role="form" id='frmMdServicio'>
						<div class="modal-body">		
							<span id="spIdServicio"></span>
							<div class="form-group">
								<label for="txtNameServicioEdit">Nombre:</label>
								<input type="text" class="form-control" id="txtNameServicioEdit" name="txtNameServicioEdit" placeholder="Ingrese Nombre">
							</div>
							<fieldset class="scheduler-border">
							<legend class="scheduler-border">Detalle de trabajo</legend>
								<div id="edit_contenedor_servicios" name="edit_cotenedor_servicios">
									<!--carga dinamica por ajax-->
								</div>
							</fieldset>
							<fieldset class="scheduler-border">
							<legend class="scheduler-border">Precios</legend>
								<div>
									
								</div>
							</fieldset>
							</div>
					
						<div class="modal-footer">
							<div class="row">
								<div align="center" id="buttonsActionEdit">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- End Modal HTML -->
		<!-- END SERVICIOS -->
		
		<!-- AREAS DE TRABAJO -->
		<div id="sectionB" class="tab-pane fade in active">
			<br>
			<div class="panel-group" id="accordionMarks" role="tablist" aria-multiselectable="true">
			  
			  <!-- CREAR MARCA -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingSaveMark">
				  <h4 class="panel-title">
					<a data-toggle="collapse" id="ltOblg" data-parent="#accordionMarks" href="#collapseSaveMark" aria-expanded="true" aria-controls="collapseSaveMark">
					  LISTAR GARANTIAS PENDIENTES
					</a>
				  </h4>
				</div>
				<div id="collapseSaveMark" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSaveMark">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12">
								<table data-order='[[ 0, "asc" ],[ 0, "asc" ],[ 0, "asc" ],[ 0, "asc" ],[ 0, "asc" ]]' class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbOblg">
									<thead>
										<tr>
											<th class="text-center">Fecha</th>
											<th class="text-center">Cliente</th>
											<th class="text-center">Vehículo</th>
											<th class="text-center">Placa</th>
											<th class="text-center">Servicios</th>
											<th class="text-center">Acción</th>
										</tr>
									</thead>
									
								</table>
							</div>
						</div>
					</div>
				</div>
				
			  </div>
		  		<!-- Modal SERVICIO HTML -->
				<div id="revisionModal" class="modal fade">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title">Revisar Garantía</h4>
							</div>
							<form role="form" id='frmMdRevision'>
								<div class="modal-body">		
									<span id="spIdRevision"></span>
									<fieldset class="scheduler-border">
									<legend class="scheduler-border">Datos</legend>
									
											<div class="form-group col-xs-12">
												<label for="txtFechaRev">Fecha de revisión:</label>
												<input type="date" class="form-control" id="txtFechaRev" name="txtFechaRev" readonly="true">
											</div>
											<div class="form-group col-xs-12">
												<label for="txtClienteRev">Cliente:</label>
												<input type="text" class="form-control" id="txtClienteRev" name="txtClienteRev" readonly="true">
											</div>
											<div class="form-group col-sm-6">
												<label for="txtVehiculoRev">Vehiculo (Marca y Modelo):</label>
												<input type="text" class="form-control" id="txtVehiculoRev" name="txtVehiculoRev" readonly="true">
											</div>
											<div class="form-group col-sm-6">
												<label for="txtPlacaRev">Placa:</label>
												<input type="text" class="form-control" id="txtPlacaRev" name="txtPlacaRev" readonly="true">
											</div>
											<div class="form-group col-xs-12">
												<label for="txtServRev">Servicios:</label>
												<input type="text" class="form-control" id="txtServRev" name="txtServRev" readonly="true">
											</div>
											<div class="form-group col-sm-6">
												<label for="txtNumRev">N° Orden de Trabajo:</label>
												<input type="text" class="form-control" id="txtNumRev" name="txtNumRev" readonly="true">
											</div>
											<div class="form-group col-sm-6">
												<label for="txtFchEmiRev">Fecha de Orden de Trabajo:</label>
												<input type="date" class="form-control" id="txtFchEmiRev" name="txtFchEmiRev" readonly="true">
											</div>
											<div class="form-group col-xs-12">
												<label for="txtObsRev">Observaciones:</label>
												<textarea type="date" class="form-control" id="txtObsRev" name="txtObsRev" rows="3"></textarea>
											</div>
										</div>
									</fieldset>
								<div class="modal-footer">
									<div class="row">
										<div align="center" id="buttonsActionEdit">
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
			  <!-- END CREAR AREA DE TRABAJO -->
	</div>
  </div>
</div>
