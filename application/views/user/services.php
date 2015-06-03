<div class="well panel panel-default" style="margin-top:1%;min-height:590px;">
  <div class="panel-body">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#sectionB">Detalle de Trabajo</a></li>
		<li><a data-toggle="tab" href="#sectionA">Servicios</a></li>
	</ul>
	<div class="tab-content">
		
		<!-- SERVICIOS -->
		<div id="sectionA" class="tab-pane fade">
			<br>
			<div class="panel-group" id="accordionCar" role="tablist" aria-multiselectable="true">
			  
			  <!-- CREAR SERVICIO -->
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
						<span id="ars"></span>
						<div class="row">
							<div class="col-md-8 col-md-offset-2" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
								<form id="frmServices">
									<div class="form-group">
										<label for="txtNameService">Nombre:</label>
										<input type="text" required="true" class="form-control" id="txtNameService" name="txtNameService" placeholder="Ingrese Nombre">
									</div>
									<fieldset class="scheduler-border">
									<legend class="scheduler-border">Detalle de trabajo</legend>
										<div id="contenedor_servicios" name="cotenedor_servicios">
										<!--carga dinamica por ajax--><h4 class="text-info">Cargando detalles de trabajo, por favor espere...</h4>
										</div>
									</fieldset>
									<fieldset class="scheduler-border">
									<legend class="scheduler-border">Precios</legend>
										<div>
											<?php
												if ( ! empty($categorias))
												{
													$contador=1;
													$artId="";
													$separador="";
													foreach ($categorias as $key => $value) 
													{
														$class=$contador%3==0?"":"borderRight";
														echo "<div class='form-group col-md-4 ".$class."'>
														<label for='prc".$value['cat_id']."'>".$value['cat_nom']."</label>
														<input type='number' step='0.01' class='form-control' id='prc".$value['cat_id']."' name='prc".$value['cat_id']."' value='0.00' >
														</div>";
														$contador++;
														$artId=$artId.$separador.$value['cat_id'];
														$separador=",";
													}
													echo "<span id='ctg' data-toggle=\"".$artId."\"></span>";
												}
												else
												{
													echo "<a class='btn btn-info' role='button' href='".base_url()."car/start'>No cuentas con ninguna categoría disponible. ¡Crealos!</a>";
												}
											?>
										</div>
									</fieldset>
									<div class="row">
									  <div class="col-xs-offset-4 col-md-offset-5" id="buttonsAction">
										<button type="submit" class="button button-3d-primary button-rounded">Guardar</button>
									  </div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
			  </div>
			  <!-- END CREAR SERVICIO -->
			  
			  <!-- LISTAR SERVICIO -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingListCar">
				  <h4 class="panel-title">
					<a class="collapsed" id="ltService" data-toggle="collapse" data-parent="#accordionCar" href="#collapseListService" aria-expanded="false" aria-controls="collapseListService">
					  LISTAR SERVICIOS
					</a>
				  </h4>
				</div>
				<div id="collapseListService" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingListCar">
				  <div class="panel-body">
					
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<table data-order='[[ 0, "asc" ]]' class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbService">
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
									<?php
										if ( ! empty($categorias))
										{
											$contador=1;
											$artId="";
											$separador="";
											foreach ($categorias as $key => $value) 
											{
												$class=$contador%3==0?"":"borderRight";
												echo "<div class='form-group col-md-4 ".$class."'>
												<label for='editprc".$value['cat_id']."'>".$value['cat_nom']."</label>
												<input type='number' step='0.01' class='form-control' id='editprc".$value['cat_id']."' name='editprc".$value['cat_id']."' value='0.00' >
												</div>";
												$contador++;
												$artId=$artId.$separador.$value['cat_id'];
												$separador=",";
											}
											echo "<span id='ctg' data-toggle=\"".$artId."\"></span>";
										}
										else
										{
											echo "<a class='btn btn-info' role='button' href='".base_url()."car/start'>No cuentas con ninguna categoría disponible. ¡Crealos!</a>";
										}
									?>
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
					<a data-toggle="collapse" data-parent="#accordionMarks" href="#collapseSaveMark" aria-expanded="true" aria-controls="collapseSaveMark">
					  CREAR DETALLE DE TRABAJO
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
					  LISTAR DETALLE DE TRABAJO
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
						<h4 class="modal-title">Editar Detalle de Trabajo</h4>
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
