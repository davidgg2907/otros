<tr>
    <td class="text-sm-left"> {!! $child !!} <i class="fa {{ $module['icon_font'] }} fa-lg"></i> {{ strtoupper($module['nombre']) }} </td>
    <td class="text-sm-center">

      <input type="checkbox" name="<?php echo "module[".$module['id']."][view]"?>" <?php echo  ($seleccionados['view_'.$module['id']] != 1) ? "" : "checked"?> value="1"/>
    </td>
    <td class="text-sm-center">
      <input type="checkbox" name="<?php echo "module[".$module['id']."][add]"?>" <?php echo  ($seleccionados['add_'.$module['id']] != 1) ? "" : "checked"?> value="1"/>
    </td>
    <td class="text-sm-center">
      <input type="checkbox" name="<?php echo "module[".$module['id']."][edit]"?>" <?php echo  ($seleccionados['edit_'.$module['id']] != 1) ? "" : "checked"?> value="1"/>
    </th>
    <td class="text-sm-center">
      <input type="checkbox" name="<?php echo "module[".$module['id']."][delete]"?>" <?php echo  ($seleccionados['delete_'.$module['id']] != 1) ? "" : "checked"?> value="1"/>
    </td>
  </tr>
