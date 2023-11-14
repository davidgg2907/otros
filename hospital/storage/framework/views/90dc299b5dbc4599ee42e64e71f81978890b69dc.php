
<div style="width:49%; float: left; text-align:left; margin-bottom: 10px;">
  <?php if($empresa->logotipo) { ?>
    <img src="<?php echo e(asset('uploads/empresa/' . $empresa->logotipo)); ?>" width="100"/>
  <?php } else {  ?>

  <?php } ?>
</div>

<div style="width:49%; float: left; text-align:right; margin-bottom: 10px; font-size: 11px;">
  <p><br/></p><h3>HOJA DE TRIAGE</h3>

  <?php if($data->tarjeta == 'AMARILLO') { $color = "#fec107"; } elseif($data->tarjeta == 'ROJO') { $color = "#d9534f"; } else { $color = "#00c292";} ?>
  <h3>URGENCIA: <span style="color: <?php echo e($color); ?>"><?php echo e($data->tarjeta); ?></span> </h3>


</div>

<div style="width:100%; margin-top:10px"><hr style="border:1px solid #F9F9F9"></div>

<div style="width:98%; margin-top:20px; padding-left:10px; padding-right:10px; padding-top:10px; padding-bottom:10px font-size: px; background: #CCC; height:100px;">
 
	<table style="width:100%;" cellpadding="1" cellspacing="10">
		<tr>
			<td style="background: #FFF; border:1px solid; #000; padding-left:10px; font-size:12px;"><strong>No Folio:</strong> <?php echo $data->id; ?></td>			
			<td colspan="2" style="background: #FFF; border:1px solid; #000; padding-left:10px; font-size:12px;"><strong>FECHA;</strong> <?php echo $data->fecha; ?></td>
			<td style="background: #FFF; border:1px solid; #000; padding-left:10px; font-size:12px;"><strong>HORA:</strong> <?php echo $data->hora; ?></td>
		</tr>

		<tr>
			<td colspan="4" style="background: #FFF; border:1px solid; #000; padding-left:10px; font-size:12px;"><strong>NOMBRE DEL PACIENTE:</strong> <?php echo $data->paciente; ?></td>
		</tr>

		<tr>
			<td colspan="4" style="background: #FFF; border:1px solid; #000; padding-left:10px; font-size:12px;"><strong>DOMICILIO:</strong> <?php echo $data->domicilio; ?> <?php echo $data->colonia; ?> <?php echo $data->cp; ?></td>
		</tr>


		<tr>
			<td colspan="4" style="background: #FFF; border:1px solid; #000; padding-left:10px; font-size:12px;"><strong>MEDICO:</strong> <?php echo $data->doctor; ?> </td>
		</tr>

		<tr>
			<td colspan="4" style="background: #FFF; border:1px solid; #000; padding-left:10px; font-size:12px;"><strong>ENFERMERA:</strong> <?php echo $data->enfermera; ?> </td>
		</tr>

		<tr>
			<td colspan="4" style="background: #FFF; border:1px solid; #000; padding-left:10px; font-size:12px;"><strong>JEFA:</strong> <?php echo $data->jefa; ?> </td>
		</tr>


		<tr>
			<td style="background: #FFF; border:1px solid; #000; padding-left:10px; font-size:12px;"><strong>EDAD:</strong> <?php echo $data->edad; ?></td>
			<td style="background: #FFF; border:1px solid; #000; padding-left:10px; font-size:12px;"><strong>GENERO:</strong> <?php echo $data->genero; ?></td>
			<td style="background: #FFF; border:1px solid; #000; padding-left:10px; font-size:12px;"><strong>PESO:</strong> <?php echo $data->peso; ?></td>
			<td style="background: #FFF; border:1px solid; #000; padding-left:10px; font-size:12px;"><strong>TALLA:</strong> <?php echo $data->talla; ?></td>
		</tr>

	</table>

</div>


<div style="width:98%; padding:5px; margin-top:10px; font-size: 10px; background: #CCC; ">
	<h3>SIGNOS VITALES</h3>
</div>

<div style="width:98%; margin-top:20px; padding-left:10px; padding-right:10px; padding-top:10px; padding-bottom:10px; background: #CCC; height:100px;">
 
	<table style="width:100%;" cellpadding="1" cellspacing="10">
		<tr>
			<td style="background: #FFF; border:1px solid; #000; padding-left:10px;  font-size:12px;"><strong>TA:</strong> <?php echo $data->ta; ?></td>
			<td style="width:20%"><p></br></p></td>			
			<td style="background: #FFF; border:1px solid; #000; padding-left:10px; "><strong>T*:</strong> <?php echo $data->t; ?></td>
		</tr>
		<tr>
			<td style="background: #FFF; border:1px solid; #000; padding-left:10px;  font-size:12px;"><strong>FR:</strong> <?php echo $data->fr; ?></td>
			<td><p></br></p></td>	
			<td style="background: #FFF; border:1px solid; #000; padding-left:10px;  font-size:12px;"><strong>SP02:</strong> <?php echo $data->sp02; ?></td>
		</tr>
		<tr>
			<td style="background: #FFF; border:1px solid; #000; padding-left:10px;  font-size:12px;"><strong>FC:</strong> <?php echo $data->fc; ?></td>
			<td><p></br></p></td>	
			<td style="background: #FFF; border:1px solid; #000; padding-left:10px;  font-size:12px;"><strong>GLUCOSA CAPILAR:</strong> <?php echo $data->gcapilar; ?></td>
		</tr>
	</table>

</div>


<div style="width:98%; margin-top:20px; padding-left:10px; padding-right:10px; padding-top:10px; background: #CCC;">
 
	<table style="width:100%;" cellpadding="1" cellspacing="10">
		<tr>
			<td><strong>GLASGOW</strong></td>
			<td style="font-size: 12px;"><strong>OCULAR:</strong></td>
			<td style="background: #FFF; border:1px solid; #000; padding-left:5px; font-size: 12px;"><?php echo $data->ocular; ?></td>
			<td style="font-size: 12px;"><strong>VERBAL:</strong></td>	
			<td style="background: #FFF; border:1px solid; #000; padding-left:5px; font-size: 12px; "><?php echo $data->verbal; ?></td>
			<td style="font-size: 12px;"><strong>MOTRIZ:</strong></td>
			<td style="background: #FFF; border:1px solid; #000; padding-left:5px; font-size: 12px; "><?php echo $data->motriz; ?></td>
			<td style="font-size: 12px;"><strong>TOTAL:</strong></td>
			<td style="background: #FFF; border:1px solid; #000; padding-left:5px; font-size: 12px; "><?php echo $data->gtotal; ?></td>
	</tr>
	</table>

</div>



<div style="width:100%; margin-top:20px; padding-left:10px; padding-right:10px; padding-top:10px; padding-bottom:10px font-size: 8px;;">
	<table>
		<tr>
			<td style="width:5%"></td>
			<td style="width:30%">
				<table style="width:100%;" cellpadding="0" cellspacing="0">
					<tr>
					<td style="background: #03a9f3; text-align:center; padding:10px;">ANTECEDENTES</td>	
					</tr>	
					<tr>
					<td style="background: #CCC;padding:5px;"> Diabetes</td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px;"> Hipertension Arterial</td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px;"> Alegias</td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px;"> FUM</td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px;"> Enfermedades Cardiacas</td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px;"> Otras</td>
					</tr>
				</table>
			</td>
			<td style="width:30%">
				<table style="width:100%;" cellpadding="0" cellspacing="0">
					<tr>
					<td style="background: #575757; text-align:center; padding:10px;">SI</td>	
					</tr>	
					<tr>
					<td style="background: #CCC;padding:5px; text-align:center"><?php if($data->diabetes != "NO") { echo $data->diabetes; } else { echo "<br/>"; } ?> </td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px; text-align:center"><?php if($data->hipertencion != "NO") { echo $data->hipertencion; } else { echo "<br/>"; } ?> </td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px; text-align:center"><?php if($data->alergias != "NO") { echo $data->alergias; } else { echo "<br/>"; } ?> </td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px; text-align:center"><?php if($data->fum != "NO") { echo $data->fum; } else { echo "<br/>"; } ?> </td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px; text-align:center"><?php if($data->ecardiacas != "NO") { echo $data->ecardiacas; } else { echo "<br/>"; } ?> </td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px; text-align:center"><?php if($data->otras != "NO") { echo $data->otras; } else { echo "<br/>"; } ?> </td>
					</tr>
				</table>
			</td>
			<td style="width:30%">
				<table style="width:100%;" cellpadding="0" cellspacing="0">
					<tr>
					<td style="background: #9b715c; text-align:center; padding:10px;">NO</td>	
					<tr>	
					<tr>
					<td style="background: #CCC;padding:5px; text-align:center"><?php if($data->diabetes != "SI") { echo "X"; } else {  echo "<br/>"; } ?> </td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px; text-align:center"><?php if($data->hipertencion != "SI") { echo "X"; } else {  echo "<br/>"; } ?> </td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px; text-align:center"><?php if($data->alergias != "SI") { echo "X"; } else {  echo "<br/>"; } ?> </td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px; text-align:center"><?php if($data->fum != "SI") { echo "X"; } else {  echo "<br/>"; } ?> </td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px; text-align:center"><?php if($data->ecardiacas != "SI") { echo "X"; } else {  echo "<br/>"; } ?> </td>
					</tr>
					<tr>
					<td style="background: #CCC;padding:5px; text-align:center"><?php if($data->otras != "SI") { echo "X"; } else {  echo "<br/>"; } ?> </td>
					</tr>
				</table>

			</td>
			<td style="width:5%"></td>
		</tr>
    </table>
</div>



<div style="width:100%; margin-top:20px; padding-left:10px; padding-right:12px; padding-top:10px; padding-bottom:10px font-size: 8px;;">
	<table>
		<tr>
			<td style="width:50%">
				<table style="width:100%;" cellpadding="0" cellspacing="0">
					<tr>
					<td style="background:#ff0404; text-align:center; padding:10px; font-size:12px	;">ROJO</td>	
					</tr>	
						
					<tr>
						<td style="background: #ff6161;padding:5px; font-size:10px;">
							<ul>
								<li>URGENCIA ATENCION INMEDIATA<br/><br/></li>
								<li>TRAUMA CHOQUE<br/><br/></li>
								<li>0-3 Mins<br/><br/></li>								
							</ul>
							<br/><br/>
						</td>
					</tr>
				</table>
			</td>
			<td style="width:50%">
				<table style="width:100%;" cellpadding="0" cellspacing="0">
					<tr>
					<td style="background:#ffc71f ; text-align:center;  font-size:10px;padding:10px;">AMARILLO</td>	
					<tr>	
					<tr>
						<td style="background: #e1be53;padding:5px; font-size:10px;">
							<ul>
								<li>URGENCIA CALIFICADA<br/><br/></li>
								<li>VALORACION SECUNDARIA<br/><br/></li>
								<li>HASTA 30 Mins<br/><br/></li>								
							</ul>
							<br/><br/>
						</td>
					</tr>
				</table>
			</td>
			<td style="width:50%">
				<table style="width:100%;" cellpadding="0" cellspacing="0">
					<tr>
						<td style="background: #007307; text-align:center; font-size:10px; padding:10px;">VERDE</td>	
 					</tr>	
					<tr>
					 <td style="background: #1ca024;padding:5px; font-size:10px;">
					 	<ul>
							<li>URGENCIA MENOR<br/><br/></li>
							<li>VALORACION SECUNDARIA<br/><br/></li>
							<li>CLINICA DE ADSCRIPCION<br/><br/></li>
							<li>HASTA 120 Mins</li>
						</ul>
					</td>
					</tr>					
				</table>

			</td>
		</tr>
    </table>
</div>

