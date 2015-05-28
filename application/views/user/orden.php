<div class="well panel panel-default" style="margin-top:1%;min-height:590px;">
  <div class="panel-group" id="accordionCar" role="tablist" aria-multiselectable="true">
	  <!-- CREAR ORDEN DE TRABAJO -->
	  <div class="panel panel-primary">
		<div class="panel-heading" role="tab" id="headingSaveCar">
		  <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordionCar" href="#collapseSaveCar" aria-expanded="true" aria-controls="collapseSaveCar">
			  ORDEN DE TRABAJO
			</a>
		  </h4>
		</div>
		<div id="collapseSaveCar" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSaveCar">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-10 col-md-offset-1" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
						<form id="frmCar">
						  <fieldset class="scheduler-border">
							<legend class="scheduler-border">Datos Generales</legend>
								<div class="form-group col-md-6">
									<label for="txtName">N° de Orden:</label>
									<input type="text" class="form-control" id="txtNumeroOrden" name="txtNumeroOrden" placeholder="Ingrese N° de Orden"/>
								</div>
								<div class="form-group col-md-6">
									<label for="txtName">Fecha:</label>
									<input type="date" required="true" class="form-control" id="txtFecha" name="txtFecha"/>
								</div>
								<div class="form-group col-md-6">
									<label for="txtName">Costo Total:</label>
									<input type="text" readOnly="true" class="form-control" id="txtCosto" name="txtCosto" value="0,00"/>
								</div>
						  </fieldset>
						  <fieldset class="scheduler-border">
							<legend class="scheduler-border">Datos Cliente</legend>
							  <div class="form-group col-md-5">
								<label for="txtName">C.I./R.U.C.:</label><a href="#" id="searchClient"><img src="<?php echo base_url()?>static/img/search.png" style="height:30px; padding:3px;" alt=""> </a>
								<input type="text" required="true" class="form-control" id="txtCedula" name="txtCedula" placeholder="Ingrese C.I./R.U.C."/>
							  </div>
							  <div class="form-group col-xs-12">
								<label for="txtName">Nombres y Apellidos:</label>
								<input type="text" readOnly="true" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre..."/>
							  </div>
							  <div class="form-group col-md-4">
								<label for="txtName">Teléfono:</label>
								<input type="text" readOnly="true" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Teléfono..."/>
							  </div>
							  <div class="form-group col-md-8">
								<label for="txtName">Dirección:</label>
								<input type="text" readOnly="true" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Dirección..."/>
							  </div>
						  </fieldset>
						  <fieldset class="scheduler-border">
							<legend class="scheduler-border">Datos Vehículo</legend>
								<table data-order='[[ 0, "asc" ]]' class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbCar">
									<thead>
										<tr>
											<th class="text-center">Marca</th>
											<th class="text-center">Modelo</th>
											<th class="text-center">Placa</th>
											<th class="text-center">Chasis</th>
											<th class="text-center">Motor</th>
											<th class="text-center">Color</th>
											<th class="text-center">Acción</th>
										</tr>
									</thead>
									
								</table>
						  </fieldset>
						  <fieldset class="scheduler-border">
							<legend class="scheduler-border">Inventario de Vehículo</legend>
								Carga dinamica de partes de vehiculo
						  </fieldset>
						  <fieldset class="scheduler-border">
							<legend class="scheduler-border">Servicios</legend>
							<div class="form-group col-md-6">
								<label for="txtName">Fecha de Ingreso:</label>
								<input type="date" class="form-control" id="txtFechaIngreso" name="txtFechaIngreso"/>
							</div>
							<div class="form-group col-md-6">
								<label for="txtName">Fecha de Estimada de Entrega:</label>
								<input type="date" class="form-control" id="txtFechaEntrega" name="txtFechaEntrega"/>
							</div>
							<?php
								if ( ! empty($servicios))
								{
									$contador=1;
									foreach ($servicios as $key => $value) 
									{
										$color=$contador%3==0?"transparent":"silver";
										echo "<div class='form-group col-md-4' style='border-right: 1px solid ".$color.";'>
										<label for='chk".$value['art_id']."' style='width:90%;'>".$value['art_nom']."</label>
										<input type='checkbox' class='form-control' id='chk".$value['art_id']."' name='chk".$value['art_id']."' value='".$value['art_id']."' style='display:table-cell; height:auto; width:auto;'>
										</div>";
										$contador++;
									}
								}
								else
								{
									echo "<a class='btn btn-info' role='button' href='".base_url()."service/start'>No cuentas con ningún servicio disponible. ¡Crealos!</a>";
								}
							?>
							<legend >Detalles del Trabajo</legend>
							<?php
								if ( ! empty($detallesTrabajo))
								{
									$contador=1;
									foreach ($detallesTrabajo as $key => $value) 
									{
										$color=$contador%3==0?"transparent":"silver";
										echo "<div class='form-group col-md-4' style='border-right: 1px solid ".$color."; height:40px;'>
										<label for='chk".$value['art_id']."' style='width:90%;'>".$value['art_nom']."</label>
										<input type='checkbox' class='form-control' id='chk".$value['art_id']."' name='chk".$value['art_id']."' value='".$value['art_id']."' style='display:table-cell; height:auto; width:auto;'>
										</div>";
										$contador++;
									}
								}
								else
								{
									echo "<a class='btn btn-info' role='button' href='".base_url()."service/start'>No cuentas con ningún área de trabajo disponible. ¡Crealas!</a>";
								}
							?>
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
			  LISTAR ORDENES DE TRABAJO
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
	  <!-- END LISTAR ORDEN DE TRABAJO -->
	</div>
<!-- END ORDEN DE TRABAJO -->
</div>
