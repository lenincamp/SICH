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
						<form id="frmOrd">
						  <fieldset class="scheduler-border">
							<legend class="scheduler-border">Datos Generales</legend>
								<div class="form-group col-sm-6" style="margin-right:1px;">
									<label for="txtNumeroOrden">N° de Orden:</label>
									<input type="text" class="form-control" id="txtNumeroOrden" name="txtNumeroOrden" placeholder="Ingrese N° de Orden"/>
								</div>
								<div class="form-group col-md-6">
									<label for="txtFecha">Fecha:</label>
									<input type="date" required="true" class="form-control" id="txtFecha" name="txtFecha"/>
								</div>
								<div class="form-group col-md-6">
									<label for="txtCosto">Costo Total:</label>
									<input type="text" readOnly="true" class="form-control" id="txtCosto" name="txtCosto" value="0,00"/>
								</div>
								<div class="form-group col-md-6">
									<label for="slcFormaPAgo">Forma de Pago:</label>
									<select class="form-control" id="slcFormaPAgo" name="slcFormaPAgo">
									<?php
										if ( ! empty($formasPago))
										{
											foreach ($formasPago as $key => $value) 
											{
												echo "<option value=".$value['fpg_id'].">".$value['fpg_nom']."</option>";
											}
										}
									?>
									</select>
								</div>
								<div class="form-group col-md-6">
									<label for="txtTarjeta">Pago con tarjeta:</label>
									<input type="number" class="form-control" id="txtTarjeta" name="txtTarjeta" placeholder="Ingrese N° de Tarjeta"/>
								</div>
								<div class="form-group col-md-6" style="padding-top:16px; padding-bottom:16px;">
									<label for="chkReserva" style="width:auto;">Reserva:</label>
									<input type="checkBox" class="form-control" id="chkReserva" name="chkReserva" value="true"  style="display:table-cell; height:auto; width:auto;"/>
								</div>
								<div class="form-group col-md-6" style="display:none;" id="divAbono">
									<label for="txtAbono">Abono:</label>
									<input type="number" step="0.01" class="form-control" id="txtAbono" name="txtAbono" placeholder="Ingrese abono"/>
								</div>
								<div class="form-group col-xs-12" d>
									<label for="txtObservacionesGeneral">Observaciones:</label>
									<input type="text" class="form-control" id="txtObservacionesGeneral" name="txtObservacionesGeneral" placeholder="Ingrese Observaciones"/>
								</div>
						  </fieldset>
						  <fieldset class="scheduler-border">
							<legend class="scheduler-border">Datos Cliente</legend>
							  <span id="spClient"></span>
							  <div class="form-group col-md-5">
								<label for="txtCedula">C.I./R.U.C.:</label><a href="#" id="searchClient"><img src="<?php echo base_url()?>static/img/search.png" style="height:30px; padding:3px;" alt=""> </a>
								<input type="text" required="true" class="form-control" id="txtCedula" name="txtCedula" placeholder="Ingrese C.I./R.U.C."/>
							  </div>
							  <div class="form-group col-xs-12">
								<label for="txtNombre">Nombres y Apellidos:</label>
								<input type="text" readOnly="true" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre..."/>
							  </div>
							  <div class="form-group col-md-5">
								<label for="txtEmail">E-mail:</label>
								<input type="text" readOnly="true" class="form-control" id="txtEmail" name="txtEmail" placeholder="Teléfono..."/>
							  </div>
							  <div class="form-group col-md-7">
								<label for="txtDireccion">Dirección:</label>
								<input type="text" readOnly="true" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Dirección..."/>
							  </div>
						  </fieldset>
						  <fieldset class="scheduler-border">
							<legend class="scheduler-border">Datos Vehículo</legend>
								<div id="tableCars">
								
								</div>
						  </fieldset>
						  <fieldset class="scheduler-border">
							<legend class="scheduler-border">Inventario de Vehículo</legend>
								<?php
								if ( ! empty($inventario))
								{
									$contador=1;
									$ids="";
									$separador="";
									foreach ($inventario as $key => $value) 
									{
										$clase=$contador%3==0?"":"borderRight";
										echo "<div class='form-group col-md-4 ".$clase."' >
										<label for='inv".$value['pie_id']."' style='width:90%;'>".$value['pie_nom']."</label>
										<input type='checkbox' class='form-control' id='inv".$value['pie_id']."' name='inv".$value['pie_id']."' value='".$value['pie_id']."' style='display:table-cell; height:auto; width:auto;'>
										</div>";
										$ids=$ids.$separador.$value['pie_id'];
										$separador=",";
										$contador++;
									}
									echo "<span id='idsInv' data-toggle='".$ids."'/>";
								}
								else
								{
									echo "<div class='col-xs-12>'><a class='btn btn-info' role='button' href='".base_url()."car/start'>No cuentas con detalles de inventario disponible. ¡Crealos!</a></div>";
								}
							?>
							<div class="form-group col-md-6">
								<label for="txtKilometraje">Kilometraje:</label>
								<input type="number" class="form-control" id="txtKilometraje" name="txtKilometraje" placeholder="Ingrese Kilometraje"/>
							</div>
							<div class="form-group col-xs-12">
								<label for="txtObservacionInventario">Observaciones:</label>
								<input type="text" class="form-control" id="txtObservacionInventario" name="txtObservacionInventario" placeholder="Ingrese observaciones"/>
							</div>
							<div class="form-group col-md-12">
								<label >Combustible:</label><br/>
								<div align="center" class="form-group" style="background-image: url('<?php echo base_url()?>static/img/gasometro.png'); background-size: 100% 100%; height:140px; width:140px;">
									<!--img src="<?php echo base_url()?>static/img/gasometro.png" style="height:140px; padding:10px;" alt=""><br/-->
									<canvas height="70" width="100" id="canvasInsert">canvas tag no soported</canvas>
									<a class='btn btn-danger' role='button' onclick="limpiar(this)">Limpiar</a>
								</div>
							</div>
						  </fieldset>
						  <fieldset class="scheduler-border">
							<legend class="scheduler-border">Servicios</legend>
							<div class="form-group col-md-6">
								<label for="txtFechaIngreso">Fecha de Ingreso:</label>
								<input type="date" class="form-control" id="txtFechaIngreso" name="txtFechaIngreso"/>
							</div>
							<div class="form-group col-md-6">
								<label for="txtFechaEntrega">Fecha de Estimada de Entrega:</label>
								<input type="date" class="form-control" id="txtFechaEntrega" name="txtFechaEntrega"/>
							</div>
							<span id='servicios' />
							<?php
								if ( ! empty($servicios))
								{
									$contador=1;
									foreach ($servicios as $key => $value) 
									{
										$clase=$contador%3==0?"":"borderRight";
										echo "<div class='form-group col-md-4 ".$clase."' >
										<label for='srv".$value['srv_id']."' style='width:90%;'>".$value['srv_nom']."</label>
										<input type='checkbox' class='form-control' id='srv".$value['srv_id']."' name='srv".$value['srv_id']."' value='".$value['srv_id']."' onchange=\"loadDetails('detallesTrabajo','',".$value['srv_id'].")\" style='display:table-cell; height:auto; width:auto;'>
										</div>";
										$contador++;
									}
								}
								else
								{
									echo "<div class='col-xs-12>'><a class='btn btn-info' role='button' href='".base_url()."service/start'>No cuentas con ningún servicio disponible. ¡Crealos!</a></div>";
								}
							?>
							<legend style="margin-top:20px;">Detalles del Trabajo</legend>
							<span id='idsArt' />
							<div id="detallesTrabajo">
								<!--carga dinamica con ajax-->
							</div>
							<?php
								/*if ( ! empty($detallesTrabajos))
								{
									$contador=1;
									foreach ($detallesTrabajo as $key => $value) 
									{
										$color=$contador%3==0?"transparent":"silver";
										echo "<div class='form-group col-md-4' style='border-right: 1px solid ".$color."; height:40px;'>
										<label for='chk".$value['art_id']."' style='width:90%;'>".$value['art_nom']."</label>
										<input  type='checkbox' class='form-control' id='chk".$value['art_id']."' name='chk".$value['art_id']."' value='".$value['art_id']."' style='display:table-cell; height:auto; width:auto;'>
										</div>";
										$contador++;
									}
								}
								else
								{
									echo "<a class='btn btn-info' role='button' href='".base_url()."service/start'>No cuentas con ningún área de trabajo disponible. ¡Crealas!</a>";
								}*/
							?>
						  </fieldset>
						  <fieldset class="scheduler-border">
							<legend class="scheduler-border">Costos</legend>
							<div id="costosServicio">
							</div>
						  </fieldset>
						  <div class="row">
							  <div class="col-md-offset-5" id="buttonsAction">
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
			<a class="collapsed" id="ltOrd" data-toggle="collapse" data-parent="#accordionCar" href="#collapseListCar" aria-expanded="false" aria-controls="collapseListCar">
			  LISTAR ORDENES DE TRABAJO
			</a>
		  </h4>
		</div>
		<div id="collapseListCar" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingListCar">
		  <div class="panel-body">
			
			<div class="row">
				<div class="col-xs-12">
					<table data-order='[[ 0, "asc" ],[ 0, "asc" ],[ 0, "asc" ],[ 0, "asc" ],[ 0, "asc" ],[ 0, "asc" ],[ 0, "asc" ]]' class="table table-hovered table-bordered" cellspacing="0" width="100%" id="tbOrd">
						<thead>
							<tr>
								<th class="text-center">N°</th>
								<th class="text-center">Fecha</th>
								<th class="text-center">Cliente</th>
								<th class="text-center">Fecha Ing.</th>
								<th class="text-center">Fecha Ent.</th>
								<th class="text-center">Reserva</th>
								<th class="text-center">Total</th>
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
<!-- Modal HTML -->
<div id="mdOrden" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Editar Orden de Trabajo</h4>
			</div>
			<form role="form" id='frmMdClient'>
				<div class="modal-body">		
					<span id="spIdOrden"></span>
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Datos Generales</legend>
							<div class="form-group col-sm-6" style="margin-right:1px;">
								<label for="txtNumeroOrden">N° de Orden:</label>
								<input type="text" class="form-control" id="txtNumeroOrden" name="txtNumeroOrden" placeholder="Ingrese N° de Orden"/>
							</div>
							<div class="form-group col-md-6">
								<label for="txtFecha">Fecha:</label>
								<input type="date" required="true" class="form-control" id="txtFecha" name="txtFecha"/>
							</div>
							<div class="form-group col-md-6">
								<label for="txtCosto">Costo Total:</label>
								<input type="text" readOnly="true" class="form-control" id="txtCosto" name="txtCosto" value="0,00"/>
							</div>
							<div class="form-group col-md-6">
								<label for="slcFormaPAgo">Forma de Pago:</label>
								<select class="form-control" id="slcFormaPAgo" name="slcFormaPAgo">
								<?php
									if ( ! empty($formasPago))
									{
										foreach ($formasPago as $key => $value) 
										{
											echo "<option value=".$value['fpg_id'].">".$value['fpg_nom']."</option>";
										}
									}
								?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="txtTarjeta">Pago con tarjeta:</label>
								<input type="number" class="form-control" id="txtTarjeta" name="txtTarjeta" placeholder="Ingrese N° de Tarjeta"/>
							</div>
							<div class="form-group col-md-6" style="padding-top:16px; padding-bottom:16px;">
								<label for="chkReserva" style="width:auto;">Reserva:</label>
								<input type="checkBox" class="form-control" id="chkReserva" name="chkReserva" value="true"  style="display:table-cell; height:auto; width:auto;"/>
							</div>
							<div class="form-group col-md-6" style="display:none;" id="divAbono">
								<label for="txtAbono">Abono:</label>
								<input type="number" step="0.01" class="form-control" id="txtAbono" name="txtAbono" placeholder="Ingrese abono"/>
							</div>
							<div class="form-group col-xs-12" d>
								<label for="txtObservacionesGeneral">Observaciones:</label>
								<input type="text" class="form-control" id="txtObservacionesGeneral" name="txtObservacionesGeneral" placeholder="Ingrese Observaciones"/>
							</div>
					  </fieldset>
				</div>
			
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
