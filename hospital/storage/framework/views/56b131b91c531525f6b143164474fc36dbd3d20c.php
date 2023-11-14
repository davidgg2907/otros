<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-heading">Archivo de Analisis</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Archivo Start -->
				<div class="col-md-12">
					<div class="form-group">
						<input type="file" name="archivo" class="dropify" />
						<input type="hidden" name="old_archivo" value="<?php if (isset($data->archivo) && $data->archivo!=""){echo $data->archivo; } ?>" />
					</div>
				</div>
				<!-- Archivo End -->
			</div>
		</div>
	</div>
</div>

<div class="col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">Datos Generales</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">

				<input type="hidden" class="form-control" id="orden_id" name="orden_id" value="<?php echo e(isset($data->orden_id ) ? $data->orden_id  : 0); ?>">
				<input type="hidden" class="form-control" id="enfermera_id" name="enfermera_id" value="<?php echo e(isset($data->enfermera_id ) ? $data->enfermera_id  : 0); ?>">
				<input type="hidden" class="form-control" id="status" name="status" value="1">

				<!-- Medico_id Start -->
				<div class="col-md-12">
					<div class="form-group">

						<?php if(Auth::user()->medico_id == 0) { ?>

							<label for="medico_id" class="control-label"> Medico que Solicitante </label>
							<div class="input-group">
								<input type="text" class="form-control" name="medico_nombre" id="medico_nombre" value="" readonly/>
								<input type="hidden" name="medico_id" id="medico_id" value=""/>
								<span class="input-group-btn">
									<button type="button" class="btn waves-effect waves-light btn-info" onclick="buscarMedicos();"><i class="fa fa-search"></i></button>
								</span>
							</div>
							<div class="label label-danger"><?php echo e($errors->first("medico_id")); ?></div>

						<?php } else { ?>

							<input type="hidden" class="form-control" name="medico_id" id="medico_id" value="<?php echo e(Auth::user()->medico_id); ?>" />

						<?php } ?>

					 </div>
				</div>
				<!-- Medico_id End -->

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

				<!-- Fecha Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="fecha" class="control-label"> F. Realizacion </label>
						<input type="text" class="form-control dates" id="fecha" name="fecha" autocomplete="off"
						value="<?php echo e(isset($data->fecha ) ? $data->fecha  : old('fecha')); ?>">
						<div class="label label-danger"><?php echo e($errors->first("fecha")); ?></div>
				 </div>
				</div>
				<!-- Fecha End -->

				<!-- Nombre Start -->
				<div class="col-md-6">
				 <div class="form-group">
					<label for="nombre" class="control-label"> Nombre del Analisis </label>
						<input type="text" class="form-control" id="nombre" name="nombre" autocomplete="off"
						value="<?php echo e(isset($data->nombre ) ? $data->nombre  : old('nombre')); ?>">
						<div class="label label-danger"><?php echo e($errors->first("nombre")); ?></div>
				 </div>
				</div>
				<!-- Nombre End -->

			</div>
		</div>
	</div>
</div>


<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">RESULTADOS</div>
		<div class="panel-wrapper collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Diagnostico Start -->
				<div class="col-md-12">
				 <div class="form-group">
					 <textarea class="form-control summernote" id="diagnostico" name="diagnostico"><?php echo e(isset($data->diagnostico ) ? $data->diagnostico  : old('diagnostico')); ?></textarea>
						<div class="label label-danger"><?php echo e($errors->first("diagnostico")); ?></div>
				 </div>
				</div>
				<!-- Diagnostico End -->
			</div>
		</div>
	</div>
</div>

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
