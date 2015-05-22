<!--div class="well panel panel-default" style="margin-top:1%;"-->
<div class="panel panel-default" style="margin-top:1%;">
  <div class="panel-body">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#sectionA">Vehículo</a></li>
		<li><a data-toggle="tab" href="#sectionB">Marca</a></li>
		<li><a data-toggle="tab" href="#sectionC">Modelo</a></li>   
	</ul>
	<div class="tab-content">
		<div id="sectionA" class="tab-pane fade in active">
			<h3>Section A</h3>
			<p>Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui. Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
		</div>
		<div id="sectionB" class="tab-pane fade">
			<br>
			<div class="row">
				<!--div class="col-md-6 col-md-offset-3" style="border: 1px solid #ccc; padding:10px 35px 40px 35px;background-color:#FFF;"-->
				<div class="well col-md-6 col-md-offset-3">	
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
	
		<div id="sectionC" class="tab-pane fade">
		<br>
			<div class="well col-md-6 col-md-offset-3">	
				<form id="frmModel">
				  <div class="form-group">
					<label for="txtName">Nombre:</label>
					<input type="text" class="form-control" id="txtName" name="name" placeholder="Ingrese Nombre">
				  </div>
				  
				  <div class="form-group">
					<label for="txtName">Marca:</label>
					<select class="selectpicker" data-live-search="true" data-size="5">
						<option>TOYOTA</option>
						<option>CITROEN</option>
						<option>HYUNDAY</option>
						<option>MAZDA</option>
					</select>
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
