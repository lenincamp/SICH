<div class="well panel panel-default" style="margin-top:1%;">
  <div class="panel-body">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#sectionA">Vehículo</a></li>
		<li><a data-toggle="tab" href="#sectionB">Marca</a></li>
		<li><a data-toggle="tab" href="#sectionC">Modelo</a></li>   
	</ul>
	<div class="tab-content">
		
		<!-- VEHICULO -->
		<div id="sectionA" class="tab-pane fade in active">
			<h3>Section A</h3>
			<p>Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui. Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
		</div>
		<!-- END VEHICULO -->
		
		<!-- MARCA -->
		<div id="sectionB" class="tab-pane fade">
			<br>
			<div class="row">
				<div class="col-md-6 col-md-offset-3" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;">	
					<form id="frmMark">
					  <div class="form-group">
						<label for="txtName">Nombre:</label>
						<input type="text" class="form-control" id="txtName" name="name" placeholder="Ingrese Nombre">
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
		<!-- END MARCA -->
		
		<!-- MODELO -->
		<div id="sectionC" class="tab-pane fade">
			<br>

			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			  
			  <!-- CREAR MODELO -->
			  <div class="panel panel-primary">
				<div class="panel-heading" role="tab" id="headingOne">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
								<label for="txtMark">Marca:</label>
								<select class="selectpicker" data-live-search="true" data-size="5" name="id_mark" id="txtMark">
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
					<a class="collapsed" id="ltModel" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
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
		<!-- END MODELO -->
	</div>
  </div>
</div>
