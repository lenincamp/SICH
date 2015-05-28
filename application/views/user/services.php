<div class="well panel panel-default" style="margin-top:1%;min-height:590px;">
  <div class="panel-body">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#sectionA">Servicios</a></li>
		<li><a data-toggle="tab" href="#sectionB">Áreas de Trabajo</a></li>
	</ul>
	<div class="tab-content">
		
		<!-- SERVICIOS -->
		<div id="sectionA" class="tab-pane fade in active">
			<br>
			<div class="panel-group" id="accordionCar" role="tablist" aria-multiselectable="true">
			  
			  <!-- CREAR VEHICULO -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingSaveCar">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordionCar" href="#collapseSaveCar" aria-expanded="true" aria-controls="collapseSaveCar">
					  CREAR SERVICIO
					</a>
				  </h4>
				</div>
				<div id="collapseSaveCar" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSaveCar">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-8 col-md-offset-2" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
								<form id="frmCar">
								  <h3>EN CONSTRUCCIÓN</h3>
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
		<!-- END SERVICIOS -->
		
		<!-- AREAS DE TRABAJO -->
		<div id="sectionB" class="tab-pane fade">
			<br>
			<div class="panel-group" id="accordionMarks" role="tablist" aria-multiselectable="true">
			  
			  <!-- CREAR MARCA -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingSaveMark">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordionMarks" href="#collapseSaveMark" aria-expanded="true" aria-controls="collapseSaveMark">
					  CREAR ÁREA DE TRABAJO
					</a>
				  </h4>
				</div>
				<div id="collapseSaveMark" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSaveMark">
					<div class="panel-body">
						<div class="row">
							<div id="divFrmAreaTrab" class="col-md-6 col-md-offset-3" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
								<form id="frmAreaTrab">
								  <div class="form-group">
									<label for="txtName">Nombre:</label>
									<input type="text" class="form-control" id="txtNameArea" name="txtNameArea" placeholder="Ingrese Nombre">
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
			  <!-- END CREAR AREA DE TRABAJO -->
			  
			  <!-- LISTAR AREA DE TRABAJO -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingListMarks">
				  <h4 class="panel-title">
					<a class="collapsed" id="ltArea" data-toggle="collapse" data-parent="#accordionMarks" href="#collapseListMarks" aria-expanded="false" aria-controls="collapseListMarks">
					  LISTAR ÁREA DE TRABAJO
					</a>
				  </h4>
				</div>
				<div id="collapseListMarks" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingListMarks">
				  <div class="panel-body">
					
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<table data-order='[[ 0, "asc" ]]' class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbAreaTrab">
								<thead>
									<tr>
										<th class="text-center"> Nombre </th>
										<th class="text-center"> Disponible </th>
										<th class="text-center">Acción</th>
									</tr>
								</thead>
								
							</table>
						</div>
					</div>

				  </div>
				</div>
			  </div>
			  <!-- END LISTAR AREA DE TRABAJO -->
			</div>
				
		</div>
		
		<!-- Modal AREA DE TRABAJO HTML -->
		<div id="areaModal" class="modal fade">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Editar Área de Trabajo</h4>
					</div>
					<form role="form" id='frmMdArea'>
						<div class="modal-body">		
							<span id="spIdArea"></span>
							<div class="form-group">
								<label for="txtNameAreaEdit">Nombre:</label>
								<input type="text" class="form-control" id="txtNameAreaEdit" name="txtNameAreaEdit" placeholder="Ingrese Nombre">
							</div>
							<div class="form-group">
								<label for="chkEstEdit">Disponible:</label>
								<input type="checkbox" class="form-control" id="chkEstEdit" name="chkEstEdit" value="true" style="display:table-cell; height:auto; width:auto;">
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
		<!-- END AREA DE TRABAJO -->
	</div>
  </div>
</div>
