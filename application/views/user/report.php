<div class="well panel panel-default" style="margin-top:1%;min-height:590px;">
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<li class="active"><a id="ltCrt" data-toggle="tab" href="#sectionA">Ingresos</a></li>
			<li><a data-toggle="tab" href="#sectionB">Garantias</a></li>
			<li><a data-toggle="tab" href="#sectionC">Ordenes de Trabajo</a></li>
		</ul>
		<div class="tab-content">
			<!-- VENTAS -->
			<div id="sectionA" class="tab-pane fade  in active">
				<br>
				<div class="panel-group" id="accordionCar" role="tablist" aria-multiselectable="true">
				  
				  <!-- REPORTE DE VENTAS -->
				  <div class="panel panel-primary">
					<div class="panel-heading" role="tab" id="headingSaveCar">
					  <h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordionCar" href="#collapseSaveCar" aria-expanded="true" aria-controls="collapseSaveCar">
						  REPORTE DE INGRESOS
						</a>
					  </h4>
					</div>
					<div id="collapseSaveCar" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSaveCar">
						<div class="panel-body">
							<div class="row" style="padding:10px;">
								<div class="col-xs-12" style="border: 1px solid #ccc; padding:10px 15px 15px 15px;background-color:#FFF;">	
									<form id="frmVent">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Datos de Reporte</legend>
											<div class="form-group col-sm-6">
												<label for="txtDesdeVent">Desde:</label>
												<input type="date" class="form-control" id="txtDesdeVent" name="txtDesdeVent"/>
											</div>
											<div class="form-group col-sm-6">
												<label for="txtHastaVent">Hasta:</label>
												<input type="date" class="form-control" id="txtHastaVent" name="txtHastaVent"/>
											</div>
											<div class="form-group col-sm-6">
												<label for="txtEstVent">Estado:</label>
												<select type="date" class="form-control" id="txtEstVent" name="txtEstVent">
													<option value="1">Todas</option>
													<option value="2">Reservas</option>
													<option value="3">Ventas</option>
												</select>
											</div>
										</fieldset>
										<div class="alert alert-info alert-dismissable">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<h5><strong>Información: </strong>En este reporte se detallan los ingresos producidos dentro de un determinado periodo de tiempo.</h5>
										</div>
										<div class="row">
										  <div align="center" id="buttonsAction">
											<a onclick="$.descargarVent('1')" href="#" class="button button-3d-primary button-rounded" role="button">Descargar</a>
										  </div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					
				  </div>
				  <!-- END REPORTE DE VENTAS -->
				</div>
			</div>
			<!-- END VENTAS -->
			
			<!-- AREAS DE TRABAJO -->
			<div id="sectionB" class="tab-pane fade">
				<br>
				<div class="panel-group" id="accordionMarks" role="tablist" aria-multiselectable="true">
				  
				  <!-- CREAR MARCA -->
				  <div class="panel panel-primary">
					<div class="panel-heading" role="tab" id="headingSaveMark">
					  <h4 class="panel-title">
						<a data-toggle="collapse" id="ltOblg" data-parent="#accordionMarks" href="#collapseSaveMark" aria-expanded="true" aria-controls="collapseSaveMark">
						  REPORTE DE GARANTIAS
						</a>
					  </h4>
					</div>
					<div id="collapseSaveMark" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSaveMark">
						<div class="panel-body">
							<div class="row" style="padding:10px;">
								<div class="col-xs-12" style="border: 1px solid #ccc; padding:10px 15px 15px 15px;background-color:#FFF;">	
									<form id="frmVent">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Datos de Reporte</legend>
											<div class="form-group col-sm-6">
												<label for="txtLimitGarant">Días limite:</label>
												<input type="number" min="0" class="form-control" id="txtLimitGarant" name="txtLimitGarant" placeholder="Ingrese días limite" value="0" step="1"/>
											</div>
											<div class="form-group col-sm-6">
												<label for="txtEstGarant">Estado:</label>
												<select type="date" class="form-control" id="txtEstGarant" name="txtEstGarant">
													<option value="1">Todas</option>
													<option value="2">Obligatorias</option>
													<option value="3">No obligatorias</option>
												</select>
											</div>
										</fieldset>
										<div class="row">
										  <div align="center" id="buttonsAction">
											<a onclick="$.descargarGarant()" href="#" class="button button-3d-primary button-rounded" role="button">Descargar</a>
										  </div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					
				  </div>
					
				  <!-- END CREAR AREA DE TRABAJO -->
				</div>
			</div>
		</div>
	</div>
</div>