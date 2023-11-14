<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Seleccione la habitacion</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Cuarto_id Start -->
				<div class="col-md-12">
				  <div class="form-group">
				      <select id="cuarto_id" name="cuarto_id" class="form-control">
									<option value=""> [-SELECCIONE-] </option>
				          <?php foreach ($cuartos as $value) { ?>
				             <option value="<?php echo $value->id; ?>" <?php if($data->cuarto_id == $value->id) { echo 'selected'; }?>><?php echo $value->numero . ' ' . $value->descripcion; ?></option>
				          <?php } ?>
				      </select>
				      <div class="label label-danger">{{ $errors->first("cuarto_id") }}</div>
				   </div>
				</div>
				<!-- Cuarto_id End -->
				<input type="hidden" class="form-control" id="status" name="status" value="1">
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"> Defina los insumos que requiere </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Recomendaciones Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <textarea class="form-control summernote" id="solicitado" name="solicitado">{{{ isset($data->solicitado ) ? $data->solicitado  : old('solicitado') }}}</textarea>
						<div class="label label-danger">{{ $errors->first("medicamentos") }}</div>
				 </div>
				</div>
				<!-- Recomendaciones End -->
			</div>
		</div>
	</div>
</div>


@section('scripts')
<script>
$(document).ready(function() {
	$('.summernote').summernote({
			height: 350, // set editor height
			minHeight: null, // set minimum height of editor
			maxHeight: null, // set maximum height of editor
			focus: false // set focus to editable area after initializing summernote
	});
	$('.inline-editor').summernote({
			airMode: true
	});
});
window.edit = function () {
		$(".click2edit").summernote()
}, window.save = function () {
		$(".click2edit").summernote('destroy');
}


</script>

@endsection
