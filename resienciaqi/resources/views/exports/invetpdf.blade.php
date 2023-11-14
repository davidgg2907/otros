<div>
  <h3>INVENTARIO DE PRODUCTOS</h3>
</div>

<table style="width:100%; border:1px solid" cellpading="0" cellspacing="0">
  <thead>
    <tr>
      <th style="width:100%; border:1px solid;font-size:10px">Tipo</th>
      <th style="width:100%; border:1px solid;font-size:10px">SKU</th>
      <th style="width:100%; border:1px solid;font-size:10px">Descripcion</th>
      <th style="width:100%; border:1px solid;font-size:10px">Costo</th>
      <th style="width:100%; border:1px solid;font-size:10px">Volumen</th>
      <th style="width:100%; border:1px solid;font-size:10px">Precio</th>
      <th style="width:100%; border:1px solid;font-size:10px">Existencia</th>
      <?PHP foreach(\App\admin\Almacenes::where('status',1)->orderBy('orden','ASC')->get() as $almacenes) { ?>
        <th style="width:100%; border:1px solid;font-size:10px">{{ $almacenes->nombre }}</th>
      <?PHP }?>
      <!--<th></th> -->
    </tr>
  </thead>
  <tbody id="myTable">
    <?php foreach($data as $key => $value) { ?>
      <tr id="hide<?php $value->id; ?>" >
        <td style="width:100%; border:1px solid;text-align:center"> {{{ $value['tipo'] }}} </td>
        <td style="width:100%; border:1px solid;text-align:left"> {{{ $key }}} </td>
        <td style="width:100%; border:1px solid;text-align:center"> {{{ $value['descripcion'] }}} </td>
        <td style="width:100%; border:1px solid;text-align:center"> {{{ $value['costo'] }}} </td>
        <td style="width:100%; border:1px solid;text-align:center"> {{{ $value['volumen'] }}} </td>
        <td style="width:100%; border:1px solid;text-align:center"> {{{ $value['precio'] }}} </td>


        <td style="width:100%; border:1px solid;text-align:center"> {{{ $value['existencia'] }}} </td>
        <?PHP foreach(\App\admin\Almacenes::get() as $almacenes) { ?>
          <td style="width:100%; border:1px solid;text-align:center"> {{{ $value['detalle'][$almacenes->id]['existencia'] }}} </td>
        <?PHP }?>
      </tr>
    <?php }  ?>
  </tbody>
</table>
