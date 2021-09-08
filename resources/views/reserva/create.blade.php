@extends('layouts.app')


@section('tittle', 'Reservas')

@section('content')

  
<br><br>
   
<div class="container">

	<div class="row justify-content-center">
		<div class="col-md-8">

			<div class="card">
				<div class="card-header text-center">
					<h2>Reservas</h2>
				</div>
				<div class="card-body">

				   
					<div class="container-fluid">
					 <div class="row">
					  <div class="col-md-6 col-sm-6 col-xs-12">
				   
					   <!-- Form code begins -->
					   {!! Form::open(['method' => 'POST', 'route' => 'reserva.store', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}

					   {!! csrf_field() !!} 


						 <p><label for="date">
							<label class="control-label" for="date">Fecha de la Reserva</label>
							<input class="form-control" id="date" type="text" name="date" placeholder="DD/MM/YYYY" value="{{ old('date') }}">
							{!! $errors->first('date','<span class=error>:message</span>') !!}
						</label></p>  


						 <p><label for="personas" >
							Personas
							
							{!! Form::number('personas', null, array('placeholder' => 'Personas' ,'class' => 'form-control' ,'min'=>1 , 'max'=>40)) !!}
							{!! $errors->first('personas','<span class=error>:message</span>') !!}
						</label></p>  

						<div class="row">
							<label for="Hora" >
								Hora
								
								{!! Form::select('hora', array(
									'8' => '8 am', '9' => '9 am', '10' => '10 am', '11' => '11 am', '12' => '12 m'
									, '13' => '1 pm', '14' => '2 pm', '15' => '3 pm', '16' => '4 pm', '17' => '5 pm'
									, '18' => '6 pm', '19' => '7 pm', '20' => '8 pm', '21' => '9 pm', '20' => '10 pm'
									
									), array('class' => 'form-control')) !!}
								{!! $errors->first('hora','<span class=error>:message</span>') !!}
							</label> 
							<label for="minutos" >
								Minutos
								
								{!! Form::select('minutos', array(
									'00' => '00', '05' => '05', '10' => '10', '15' => '15', '20' => '20'
									, '25' => '25', '30' => '30', '35' => '35', '40' => '40', '45' => '45'
									, '50' => '50', '55' => '55'
									
									), array('class' => 'form-control')) !!}
								{!! $errors->first('minutos','<span class=error>:message</span>') !!}
							</label> 
						</div>
 
						<hr>
						<div class="form-group ">
							Observaciones: 
							<p>
								<textarea class="form-control" name="observacion" rows="3"></textarea>
							</p>
						</div>  


						 <div class="form-group"> <!-- Submit button -->
							<button class="btn btn-success btn-sm" type="submit" ><i class="fas fa-check-square fa-1x" aria-hidden="true"   ></i> Guardar</button>
						 </div>


						 {!! Form::close() !!}
						<!-- Form code ends --> 
				   
					   </div>
					 </div>    
					</div>
				   			   


				</div>
				<div class="card-footer  text-center" style="background-color: white;">


				</div>

			</div>
		</div>
	</div>
</div>



<br>
<br>

@endsection


@section('scripts')


	<script type="text/javascript">
		
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	

	</script>

@endsection