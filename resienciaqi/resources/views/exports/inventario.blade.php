<table class="table text-left">
  <thead>
    <tr>
      <th>Almacen</th>
      <th>SKU</th>
      <th>Producto</th>
      <th>Existencia</th>
      <!--<th></th> -->
    </tr>
  </thead>
  <tbody>
    <?php foreach($data as $value) { ?>
      <tr id="hide<?php $value->id; ?>" >
        <td> {{{ $value->almacen->tipo }}} </td>
        <td> {{{ $value->producto->sku }}} </td>
        <td> {{{ $value->producto->descripcion }}} </td>
        <td>
          <span class="badge <?php if($value->cantidad > $value->producto->stock_min) { echo 'bg-success'; } else { echo 'bg-danger'; } ?>">
            {{{ $value->cantidad }}}
          </span>
        </td>
        <!--<td>
           <a href="<?php echo url("/"); ?>/admin/inventario/edit/<?php echo $value->id; ?>" title="Edit" data-toggle="tooltip">
            <i class="fa fa-file-pdf fa-lg text-info m-r-10"></i>
           </a>
        </td>-->
      </tr>
    <?php }  ?>
  </tbody>

</table>
