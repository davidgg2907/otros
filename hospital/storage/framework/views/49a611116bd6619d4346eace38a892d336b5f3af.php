<?php $__env->startSection('content'); ?>

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Escritorio</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="index.html">Hospital</a></li>
            <li class="active">Escritorio</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">

  <div class="col-md-8">

    <div class="panel panel-default">
      <div class="panel-heading">REPORTE DE CITAS</div>
      <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="table-responsive">
              <div id="consultas_chart"></div>
            </div>
          </div>
      </div>
    </div>

  </div>

  <div class="col-sm-4" id="frmListado">

    <div class="panel panel-default">
      <div class="panel-heading">PROXIMAS CITAS</div>
      <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="table-responsive">
              <?php foreach($citados as $value) { ?>
                <div class="alert alert-warning" style="border-radius: 10px">
                  <?php echo e($value->paciente->nombre); ?>, <?php echo e(date('d/mY',strtotime($value->fecha))); ?> <?php echo e($value->hora); ?>

                </div>
              <?php } ?>
            </div>
          </div>
      </div>
    </div>

  </div>

</div>


<div class="row">

  <div class="col-sm-4" id="frmListado">

      <div class="panel panel-default">
        <div class="panel-heading">ULTIMOSV PAGOS</div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <div class="table-responsive">
                <?php foreach($pagos as $value) { ?>
                  <div class="alert <?php if($value->status == 1) { echo 'alert-info'; } else if($value->status == 2) { echo 'alert-success'; }?>" style="border-radius: 10px">

                    <?php if($value->status == 1) { echo '<b>PENDIENTE:</b>'; } else if($value->status == 2) { echo '<b>PAGADO:</b>'; }?>
                    <?php echo e($value->paciente->nombre); ?> $ <?php echo e(number_format($value->monto,2,".",",")); ?>

                  </div>
                <?php } ?>
              </div>
            </div>
        </div>
      </div>

    </div>

  <div class="col-md-8">

    <div class="panel panel-default">
      <div class="panel-heading">HOSPITALIZACIONES</div>
      <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="table-responsive">
              <div id="hospitalizaciones_chart"></div>
            </div>
          </div>
      </div>
    </div>

  </div>

</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script>

  // Morris bar chart
  Morris.Bar({
     element: 'consultas_chart',
     data: [
       {y: 'Total', a: <?php echo  (int)$citas['total']; ?>, b: null, c:null, d:null},
       {y: 'Pendientes', a: null, b: <?php echo  (int)$citas['pendientes']; ?>, c:null, d:null},
       {y: 'Finalizadas', a: null, b: null, c: <?php echo  (int)$citas['finalizadas']; ?>, d:null },
       {y: 'Canceladas', a: null, b: null, c: null, d:<?php echo  (int)$citas['canceladas']; ?>},

     ],
     xkey: 'y',
     ykeys: ['a','b','c','d'],
     labels: ['Total', 'Pendientes', 'Finalizadas','Canceladas'],
     barColors:['#ab8ce4', '#fec107', '#00c292','#fb9678'],
     stacked: true,
     hoverCallback: function (index, options, content, row) {
       var finalContent = $(content);
       var cpt = 0;

       $.each(row, function (n, v) {
         if (v == null) {
           $(finalContent).eq(cpt).empty();
         }
         cpt++;
       });

       return finalContent;
     }
  });

  // Morris bar chart
  Morris.Bar({
     element: 'hospitalizaciones_chart',
     data: [
       {y: 'Total', a: <?php echo  (int)$hospitalizacion['total']; ?>, b: null, c:null, d:null},
       {y: 'Ingresados', a: null, b: <?php echo  (int)$hospitalizacion['ingresados']; ?>, c:null, d:null},
       {y: 'Altas', a: null, b: null, c: <?php echo  (int)$hospitalizacion['altas']; ?>, d:null },
       {y: 'Canceladas', a: null, b: null, c: null, d:<?php echo  (int)$hospitalizacion['canceladas']; ?>},

     ],
     xkey: 'y',
     ykeys: ['a','b','c','d'],
     labels: ['Total', 'Pendientes', 'Finalizadas','Canceladas'],
     barColors:['#ab8ce4', '#fec107', '#00c292','#fb9678'],
     stacked: true,
     hoverCallback: function (index, options, content, row) {
       var finalContent = $(content);
       var cpt = 0;

       $.each(row, function (n, v) {
         if (v == null) {
           $(finalContent).eq(cpt).empty();
         }
         cpt++;
       });

       return finalContent;
     }
  });

</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>