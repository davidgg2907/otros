
<!-- Nombre Start -->
<div class="col-md-12">
 <div class="form-group">
  <label for="nombre" class="control-label"> Nombre </label>
    <input type="text" class="form-control" id="nombre" name="nombre"
    value="{{{ isset($data->nombre ) ? $data->nombre  : old('nombre') }}}">
    <div class="label label-danger">{{ $errors->first("nombre") }}</div>
 </div>
</div>
<!-- Nombre End -->


<!-- Caducidad Start -->
<div class="col-md-4">
 <div class="form-group">
  <label for="caducidad" class="control-label"> Caducidad </label>
    <input type="text" class="form-control" id="caducidad" name="caducidad"
    value="{{{ isset($data->caducidad ) ? $data->caducidad  : old('caducidad') }}}">
    <div class="label label-danger">{{ $errors->first("caducidad") }}</div>
 </div>
</div>
<!-- Caducidad End -->

<!-- Costo Start -->
<div class="col-md-4">
 <div class="form-group">
  <label for="costo" class="control-label"> Costo </label>
    <input type="text" class="form-control" id="costo" name="costo"
    value="{{{ isset($data->costo ) ? $data->costo  : old('costo') }}}">
    <div class="label label-danger">{{ $errors->first("costo") }}</div>
 </div>
</div>
<!-- Costo End -->

<!-- Precio Start -->
<div class="col-md-4">
 <div class="form-group">
  <label for="precio" class="control-label"> Precio </label>
    <input type="text" class="form-control" id="precio" name="precio"
    value="{{{ isset($data->precio ) ? $data->precio  : old('precio') }}}">
    <div class="label label-danger">{{ $errors->first("precio") }}</div>
 </div>
</div>
<!-- Precio End -->

<!-- Descripcion Start -->
<div class="col-md-12">
 <div class="form-group">
  <label for="descripcion" class="control-label"> Descripcion </label>
	<textarea class="form-control" id="descripcion" name="descripcion">{{{ isset($data->descripcion ) ? $data->descripcion  : old('descripcion') }}}</textarea>
  <div class="label label-danger">{{ $errors->first("descripcion") }}</div>
 </div>
</div>
<!-- Descripcion End -->

<input type="hidden" class="form-control" id="status" name="status" value="1">
