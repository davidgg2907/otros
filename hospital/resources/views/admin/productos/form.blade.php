<!-- Descripcion Start -->
<div class="col-md-3">
 <div class="form-group">
    <label for="descripcion" class="control-label"> Tipo de Servicio </label>
    <select class="form-control select2" id="scope" name="scope">
      <option value=""> [ SELECCIONE ] </option>
      <option value="1" <?php if($data->scope == 1) { echo 'selected'; } ?>> Hospitalizacion </option>
      <option value="2" <?php if($data->scope == 2) { echo 'selected'; } ?>> Urgencias </option>
    </select>
  </div>
</div>
<!-- Descripcion End -->


<!-- Descripcion Start -->
<div class="col-md-9">
 <div class="form-group">
  <label for="descripcion" class="control-label"> Descripcion </label>
    <input type="text" class="form-control" id="descripcion" name="descripcion"
    value="{{{ isset($data->descripcion ) ? $data->descripcion  : old('descripcion') }}}">
    <div class="label label-danger">{{ $errors->first("descripcion") }}</div>
 </div>
</div>
<!-- Descripcion End -->

<!-- Precio Start -->
<div class="col-md-3">
 <div class="form-group">
  <label for="precio" class="control-label"> Precio </label>
    <input type="text" class="form-control" id="precio" name="precio"
    value="{{{ isset($data->precio ) ? $data->precio  : old('precio') }}}">
    <div class="label label-danger">{{ $errors->first("precio") }}</div>
 </div>
</div>
<!-- Precio End -->

<!-- Iva Start -->
<div class="col-md-3">
 <div class="form-group">
  <label for="iva" class="control-label"> Iva </label>
	<select class="form-control" id="iva" name="iva">
		<option value="0" <?php if($data->iva == 0) { echo 'selected'; } ?>>NO</option>
		<option value="1" <?php if($data->iva == 1) { echo 'selected'; } ?>>SI</option>
	</select>
    <div class="label label-danger">{{ $errors->first("iva") }}</div>
 </div>
</div>
<!-- Iva End -->

<!-- Valor_iva Start -->
<div class="col-md-3">
 <div class="form-group">
  <label for="valor_iva" class="control-label"> I.V.A </label>
    <input type="text" class="form-control" id="valor_iva" name="valor_iva" readonly
    value="{{{ isset($data->valor_iva ) ? $data->valor_iva  : old('valor_iva') }}}">
    <div class="label label-danger">{{ $errors->first("valor_iva") }}</div>
 </div>
</div>
<!-- Valor_iva End -->

<!-- Precio_neto Start -->
<div class="col-md-3">
 <div class="form-group">
  <label for="precio_neto" class="control-label"> Precio Neto </label>
    <input type="text" class="form-control" id="precio_neto" name="precio_neto" readonly
    value="{{{ isset($data->precio_neto ) ? $data->precio_neto  : old('precio_neto') }}}">
    <div class="label label-danger">{{ $errors->first("precio_neto") }}</div>
 </div>
</div>
<!-- Precio_neto End -->

<input type="hidden" class="form-control" id="status" name="status" value="1">


@section('scripts')
<script>

$('#precio').on('change',function(){
	calculaNeto();
});

$('#iva').on('change',function(){
	calculaNeto();
});


function calculaNeto() {

	var precio 		= parseFloat($('#precio').val());
	var con_iva 	= $('#iva').val();
	var iva = 0;
	var neto = 0;

  alert(con_iva);

	if(isNaN(precio)) { precio = 0; }

	if(isNaN(con_iva)) { con_iva = 0; }

	if(con_iva == 1) {

		iva = precio * {{ $empresa->impuesto/100 }};
		precio_neto = precio + iva;

	} else {
		precio_neto = precio;
	}

	$('#valor_iva').val(iva.toFixed(2));
	$('#precio_neto').val(precio_neto.toFixed(2));
}
</script>


@endsection
