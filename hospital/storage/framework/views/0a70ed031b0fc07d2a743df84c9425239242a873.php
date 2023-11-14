<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Datos Generales </div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Paciente_id Start -->
				<div class="col-md-12">
					<div class="form-group">
							<label for="paciente_id" class="control-label"> Paciente </label>
							<div class="input-group">
								<input type="text" class="form-control" name="paciente_nombre" id="paciente_nombre" value="" readonly/>
								<input type="hidden" name="paciente_id" id="paciente_id" value=""/>
								<span class="input-group-btn">
									<button type="button" class="btn waves-effect waves-light btn-info" onclick="buscaPaciente();"><i class="fa fa-search"></i></button>
								</span>
							</div>
							<div class="label label-danger"><?php echo e($errors->first("paciente_id")); ?></div>
					 </div>
				</div>
				<!-- Paciente_id End -->


				<!-- Medico_id Start -->
				<div class="col-md-12">
					<div class="form-group">
						<?php if(Auth::user()->medico_id == 0) { ?>
							<label for="medico_id" class="control-label"> Medico que Emite la receta </label>

							<?php if(Auth::user()->asistente_id != 0) { ?>

								<?php
									$asistente = \App\admin\Asistentes::find(Auth::user()->asistente_id);
									$docs = explode(',',$asistente->doctores);
								?>
								<label for="medico_id" class="control-label"> Medico que Emite la receta </label>
								<select id="medico_id" name="medico_id" class="form-control">
										<option value=""> [-SELECCIONE-] </option>
										<?php foreach ($medicos as $value) { ?>

											 <?php if(in_array($value->id, $docs)) { ?>
												 <option value="<?php echo $value->id; ?>" <?php if($data->medico_id == $value->id) { echo 'selected'; }?>><?php echo $value->nombre; ?></option>
											 <?php }?>

										<?php } ?>
								</select>

							<?php } else { ?>
								<div class="input-group">
									<input type="text" class="form-control" name="medico_nombre" id="medico_nombre" value="" readonly/>
									<input type="hidden" name="medico_id" id="medico_id" value=""/>
									<span class="input-group-btn">
										<button type="button" class="btn waves-effect waves-light btn-info" onclick="buscarMedicos();"><i class="fa fa-search"></i></button>
									</span>
								</div>
							<?php } ?>

						<?php } else { ?>

							<input type="hidden" class="form-control" name="medico_id" id="medico_id" value="<?php echo e(Auth::user()->medico_id); ?>" />

						<?php } ?>
						<div class="label label-danger"><?php echo e($errors->first("medico_id")); ?></div>
					 </div>
				</div>
				<!-- Medico_id End -->


			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Medicamento y Dosificacion</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Recomendaciones Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <textarea class="form-control summernote" id="medicamentos" name="medicamentos"><?php echo e(isset($data->medicamentos ) ? $data->medicamentos  : old('medicamentos')); ?></textarea>
						<div class="label label-danger"><?php echo e($errors->first("medicamentos")); ?></div>
				 </div>
				</div>
				<!-- Recomendaciones End -->
			</div>
		</div>
	</div>
</div>

<input type="hidden" class="form-control" id="status" name="status" value="1">



<?php echo $__env->make('admin.buscadores.medicos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('admin.buscadores.pacientes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('scripts'); ?>
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


<?php echo $__env->make('admin.buscadores.medscript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('admin.buscadores.pacscript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</script>

<?php $__env->stopSection(); ?>
