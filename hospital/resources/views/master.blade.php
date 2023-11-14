<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo url('/'); ?>/accets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo url('/'); ?>/accets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo url('/'); ?>/accets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo url('/'); ?>/accets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo url('/'); ?>/accets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo url('/'); ?>/accets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo url('/'); ?>/accets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo url('/'); ?>/accets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo url('/'); ?>/accets/build/css/custom.min.css" rel="stylesheet">

    <!-- Datepicker -->
    <link href="<?php echo url('/'); ?>/accets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

    <!-- Datetimepicker -->
    <link href="<?php echo url('/'); ?>/accets/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- Chosen -->
    <link href="<?php echo url('/'); ?>/accets/vendors/chosen/chosen.css" rel="stylesheet">
    <?php
    $contr = Request::segment(1);
    $action = Request::segment(2);
    $contrnew = $contr . '/' . $action;
    ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo url('/'); ?>/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li <?php if($action == 'generator'){?>class="active "<?php } ?>><a href="<?php echo url("/")."/admin/generator";?>"><i class="fa fa-home"></i> Generator </a></li>

				        <!-- BO : Demo -->
                <li <?php if($action == 'demo'){?>class="active "<?php } ?>>
                    <a href="<?php echo url("/"); ?>/admin/demo"><i class="fa fa-users"></i>
                    Demo
                    </a>
                </li>
                <!--  EO : Demo -->

                

				<!-- BO : Vishal -->
                <li <?php if($action == 'vishal'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/vishal"><i class="fa fa-users"></i>
                    Vishal
                    </a>
                </li>
                <!--  EO : Vishal -->

               

				<!-- BO : Pages -->
                <li <?php if($action == 'pages'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/pages"><i class="fa fa-users"></i>
                    Pages
                    </a>
                </li>
                <!--  EO : Pages -->

               

				<!-- BO : Cajas -->
                <li <?php if($action == 'cajas'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/cajas"><i class="fa fa-users"></i>
                    Cajas
                    </a>
                </li>
                <!--  EO : Cajas -->

               

				<!-- BO : Bancos -->
                <li <?php if($action == 'bancos'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/bancos"><i class="fa fa-users"></i>
                    Bancos
                    </a>
                </li>
                <!--  EO : Bancos -->

               

				<!-- BO : Amonestaciones -->
                <li <?php if($action == 'amonestaciones'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/amonestaciones"><i class="fa fa-users"></i>
                    Amonestaciones
                    </a>
                </li>
                <!--  EO : Amonestaciones -->

               

				<!-- BO : Comercios -->
                <li <?php if($action == 'comercios'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/comercios"><i class="fa fa-users"></i>
                    Comercios
                    </a>
                </li>
                <!--  EO : Comercios -->

               

				<!-- BO : Dispercion -->
                <li <?php if($action == 'dispercion'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/dispercion"><i class="fa fa-users"></i>
                    Dispercion
                    </a>
                </li>
                <!--  EO : Dispercion -->

               

				<!-- BO : Dispersionmovimientos -->
                <li <?php if($action == 'dispersionmovimientos'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/dispersionmovimientos"><i class="fa fa-users"></i>
                    Dispersionmovimientos
                    </a>
                </li>
                <!--  EO : Dispersionmovimientos -->

               

				<!-- BO : Documentos -->
                <li <?php if($action == 'documentos'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/documentos"><i class="fa fa-users"></i>
                    Documentos
                    </a>
                </li>
                <!--  EO : Documentos -->

               

				<!-- BO : Expediente -->
                <li <?php if($action == 'expediente'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/expediente"><i class="fa fa-users"></i>
                    Expediente
                    </a>
                </li>
                <!--  EO : Expediente -->

               

				<!-- BO : Facturas -->
                <li <?php if($action == 'facturas'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/facturas"><i class="fa fa-users"></i>
                    Facturas
                    </a>
                </li>
                <!--  EO : Facturas -->

               

				<!-- BO : Historialmovimientos -->
                <li <?php if($action == 'historialmovimientos'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/historialmovimientos"><i class="fa fa-users"></i>
                    Historialmovimientos
                    </a>
                </li>
                <!--  EO : Historialmovimientos -->

               

				<!-- BO : Movimientos -->
                <li <?php if($action == 'movimientos'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/movimientos"><i class="fa fa-users"></i>
                    Movimientos
                    </a>
                </li>
                <!--  EO : Movimientos -->

               

				<!-- BO : Productos -->
                <li <?php if($action == 'productos'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/productos"><i class="fa fa-users"></i>
                    Productos
                    </a>
                </li>
                <!--  EO : Productos -->

               

				<!-- BO : Tarjetas -->
                <li <?php if($action == 'tarjetas'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/tarjetas"><i class="fa fa-users"></i>
                    Tarjetas
                    </a>
                </li>
                <!--  EO : Tarjetas -->

               

				<!-- BO : Movimientosdocumentoss -->
                <li <?php if($action == 'movimientosdocumentoss'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/movimientosdocumentoss"><i class="fa fa-users"></i>
                    Movimientosdocumentoss
                    </a>
                </li>
                <!--  EO : Movimientosdocumentoss -->

               

				<!-- BO : Users -->
                <li <?php if($action == 'users'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/users"><i class="fa fa-users"></i>
                    Users
                    </a>
                </li>
                <!--  EO : Users -->

               

				<!-- BO : Roles -->
                <li <?php if($action == 'roles'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/roles"><i class="fa fa-users"></i>
                    Roles
                    </a>
                </li>
                <!--  EO : Roles -->

               

				<!-- BO : Role_user -->
                <li <?php if($action == 'role_user'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/role_user"><i class="fa fa-users"></i>
                    Role_user
                    </a>
                </li>
                <!--  EO : Role_user -->

               

				<!-- BO : Permission_role -->
                <li <?php if($action == 'permission_role'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/permission_role"><i class="fa fa-users"></i>
                    Permission_role
                    </a>
                </li>
                <!--  EO : Permission_role -->

               

				<!-- BO : Permissions -->
                <li <?php if($action == 'permissions'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/permissions"><i class="fa fa-users"></i>
                    Permissions
                    </a>
                </li>
                <!--  EO : Permissions -->

               

				<!-- BO : Clientes -->
                <li <?php if($action == 'clientes'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/clientes"><i class="fa fa-users"></i>
                    Clientes
                    </a>
                </li>
                <!--  EO : Clientes -->

               

				<!-- BO : ClienteDirecciones -->
                <li <?php if($action == 'clienteDirecciones'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/clienteDirecciones"><i class="fa fa-users"></i>
                    ClienteDirecciones
                    </a>
                </li>
                <!--  EO : ClienteDirecciones -->

               

				<!-- BO : ProductosActividades -->
                <li <?php if($action == 'productosActividades'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/productosActividades"><i class="fa fa-users"></i>
                    ProductosActividades
                    </a>
                </li>
                <!--  EO : ProductosActividades -->

               

				<!-- BO : Operadores -->
                <li <?php if($action == 'operadores'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/operadores"><i class="fa fa-users"></i>
                    Operadores
                    </a>
                </li>
                <!--  EO : Operadores -->

               

				<!-- BO : Ordenes -->
                <li <?php if($action == 'ordenes'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/ordenes"><i class="fa fa-users"></i>
                    Ordenes
                    </a>
                </li>
                <!--  EO : Ordenes -->

               

				<!-- BO : OrdenesServicios -->
                <li <?php if($action == 'ordenesServicios'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/ordenesServicios"><i class="fa fa-users"></i>
                    OrdenesServicios
                    </a>
                </li>
                <!--  EO : OrdenesServicios -->

               

				<!-- BO : MiTabla -->
                <li <?php if($action == 'miTabla'){?>class="active "<?php } ?>  >
                    <a href="<?php echo url("/"); ?>/admin/miTabla"><i class="fa fa-users"></i>
                    MiTabla
                    </a>
                </li>
                <!--  EO : MiTabla -->

               

								<!-- BO : Despachos -->
				                <li <?php if($action == 'despachos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/despachos"><i class="fa fa-users"></i>
				                    Despachos
				                    </a>
				                </li>
				                <!--  EO : Despachos -->

				               

								<!-- BO : Categorias -->
				                <li <?php if($action == 'categorias'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/categorias"><i class="fa fa-users"></i>
				                    Categorias
				                    </a>
				                </li>
				                <!--  EO : Categorias -->

				               

								<!-- BO : Departamentos -->
				                <li <?php if($action == 'departamentos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/departamentos"><i class="fa fa-users"></i>
				                    Departamentos
				                    </a>
				                </li>
				                <!--  EO : Departamentos -->

				               

								<!-- BO : Giros -->
				                <li <?php if($action == 'giros'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/giros"><i class="fa fa-users"></i>
				                    Giros
				                    </a>
				                </li>
				                <!--  EO : Giros -->

				               

								<!-- BO : Grupo_vendedoress -->
				                <li <?php if($action == 'grupo_vendedoress'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/grupo_vendedoress"><i class="fa fa-users"></i>
				                    Grupo_vendedoress
				                    </a>
				                </li>
				                <!--  EO : Grupo_vendedoress -->

				               

								<!-- BO : Impuestos -->
				                <li <?php if($action == 'impuestos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/impuestos"><i class="fa fa-users"></i>
				                    Impuestos
				                    </a>
				                </li>
				                <!--  EO : Impuestos -->

				               

								<!-- BO : Monedas -->
				                <li <?php if($action == 'monedas'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/monedas"><i class="fa fa-users"></i>
				                    Monedas
				                    </a>
				                </li>
				                <!--  EO : Monedas -->

				               

								<!-- BO : Proveedores -->
				                <li <?php if($action == 'proveedores'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/proveedores"><i class="fa fa-users"></i>
				                    Proveedores
				                    </a>
				                </li>
				                <!--  EO : Proveedores -->

				               

								<!-- BO : Series -->
				                <li <?php if($action == 'series'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/series"><i class="fa fa-users"></i>
				                    Series
				                    </a>
				                </li>
				                <!--  EO : Series -->

				               

								<!-- BO : Unidades -->
				                <li <?php if($action == 'unidades'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/unidades"><i class="fa fa-users"></i>
				                    Unidades
				                    </a>
				                </li>
				                <!--  EO : Unidades -->

				               

								<!-- BO : Vendedores -->
				                <li <?php if($action == 'vendedores'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/vendedores"><i class="fa fa-users"></i>
				                    Vendedores
				                    </a>
				                </li>
				                <!--  EO : Vendedores -->

				               

								<!-- BO : Compras -->
				                <li <?php if($action == 'compras'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/compras"><i class="fa fa-users"></i>
				                    Compras
				                    </a>
				                </li>
				                <!--  EO : Compras -->

				               

								<!-- BO : Pedidos -->
				                <li <?php if($action == 'pedidos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/pedidos"><i class="fa fa-users"></i>
				                    Pedidos
				                    </a>
				                </li>
				                <!--  EO : Pedidos -->

				               

								<!-- BO : Cotizaciones -->
				                <li <?php if($action == 'cotizaciones'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/cotizaciones"><i class="fa fa-users"></i>
				                    Cotizaciones
				                    </a>
				                </li>
				                <!--  EO : Cotizaciones -->

				               

								<!-- BO : Sucursales -->
				                <li <?php if($action == 'sucursales'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/sucursales"><i class="fa fa-users"></i>
				                    Sucursales
				                    </a>
				                </li>
				                <!--  EO : Sucursales -->

				               

								<!-- BO : Ventas -->
				                <li <?php if($action == 'ventas'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/ventas"><i class="fa fa-users"></i>
				                    Ventas
				                    </a>
				                </li>
				                <!--  EO : Ventas -->

				               

								<!-- BO : Traspasos -->
				                <li <?php if($action == 'traspasos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/traspasos"><i class="fa fa-users"></i>
				                    Traspasos
				                    </a>
				                </li>
				                <!--  EO : Traspasos -->

				               

								<!-- BO : Devoluciones -->
				                <li <?php if($action == 'devoluciones'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/devoluciones"><i class="fa fa-users"></i>
				                    Devoluciones
				                    </a>
				                </li>
				                <!--  EO : Devoluciones -->

				               

								<!-- BO : Corte -->
				                <li <?php if($action == 'corte'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/corte"><i class="fa fa-users"></i>
				                    Corte
				                    </a>
				                </li>
				                <!--  EO : Corte -->

				               

								<!-- BO : Estatus -->
				                <li <?php if($action == 'estatus'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/estatus"><i class="fa fa-users"></i>
				                    Estatus
				                    </a>
				                </li>
				                <!--  EO : Estatus -->

				               

								<!-- BO : Personal -->
				                <li <?php if($action == 'personal'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/personal"><i class="fa fa-users"></i>
				                    Personal
				                    </a>
				                </li>
				                <!--  EO : Personal -->

				               

								<!-- BO : Lineamientos -->
				                <li <?php if($action == 'lineamientos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/lineamientos"><i class="fa fa-users"></i>
				                    Lineamientos
				                    </a>
				                </li>
				                <!--  EO : Lineamientos -->

				               

								<!-- BO : Cursos -->
				                <li <?php if($action == 'cursos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/cursos"><i class="fa fa-users"></i>
				                    Cursos
				                    </a>
				                </li>
				                <!--  EO : Cursos -->

				               

								<!-- BO : MedidasEvaluacion -->
				                <li <?php if($action == 'medidasEvaluacion'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/medidasEvaluacion"><i class="fa fa-users"></i>
				                    MedidasEvaluacion
				                    </a>
				                </li>
				                <!--  EO : MedidasEvaluacion -->

				               

								<!-- BO : Salas -->
				                <li <?php if($action == 'salas'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/salas"><i class="fa fa-users"></i>
				                    Salas
				                    </a>
				                </li>
				                <!--  EO : Salas -->

				               

								<!-- BO : Auditorias -->
				                <li <?php if($action == 'auditorias'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/auditorias"><i class="fa fa-users"></i>
				                    Auditorias
				                    </a>
				                </li>
				                <!--  EO : Auditorias -->

				               

								<!-- BO : PersonalExpedientes -->
				                <li <?php if($action == 'personalExpedientes'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/personalExpedientes"><i class="fa fa-users"></i>
				                    PersonalExpedientes
				                    </a>
				                </li>
				                <!--  EO : PersonalExpedientes -->

				               

								<!-- BO : LineamientosApartados -->
				                <li <?php if($action == 'lineamientosApartados'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/lineamientosApartados"><i class="fa fa-users"></i>
				                    LineamientosApartados
				                    </a>
				                </li>
				                <!--  EO : LineamientosApartados -->

				               

								<!-- BO : LineamientosSecciones -->
				                <li <?php if($action == 'lineamientosSecciones'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/lineamientosSecciones"><i class="fa fa-users"></i>
				                    LineamientosSecciones
				                    </a>
				                </li>
				                <!--  EO : LineamientosSecciones -->

				               

								<!-- BO : LineamientosRequerimientos -->
				                <li <?php if($action == 'lineamientosRequerimientos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/lineamientosRequerimientos"><i class="fa fa-users"></i>
				                    LineamientosRequerimientos
				                    </a>
				                </li>
				                <!--  EO : LineamientosRequerimientos -->

				               

								<!-- BO : AuditoriasReporte -->
				                <li <?php if($action == 'auditoriasReporte'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/auditoriasReporte"><i class="fa fa-users"></i>
				                    AuditoriasReporte
				                    </a>
				                </li>
				                <!--  EO : AuditoriasReporte -->

				               

								<!-- BO : AuditoriasCompromisos -->
				                <li <?php if($action == 'auditoriasCompromisos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/auditoriasCompromisos"><i class="fa fa-users"></i>
				                    AuditoriasCompromisos
				                    </a>
				                </li>
				                <!--  EO : AuditoriasCompromisos -->

				               

								<!-- BO : AuditoriasSombras -->
				                <li <?php if($action == 'auditoriasSombras'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/auditoriasSombras"><i class="fa fa-users"></i>
				                    AuditoriasSombras
				                    </a>
				                </li>
				                <!--  EO : AuditoriasSombras -->

				               

								<!-- BO : Evaluadores -->
				                <li <?php if($action == 'evaluadores'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/evaluadores"><i class="fa fa-users"></i>
				                    Evaluadores
				                    </a>
				                </li>
				                <!--  EO : Evaluadores -->

				               

								<!-- BO : Agency_network -->
				                <li <?php if($action == 'agency_network'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/agency_network"><i class="fa fa-users"></i>
				                    Agency_network
				                    </a>
				                </li>
				                <!--  EO : Agency_network -->

				               

								<!-- BO : Agency_holding -->
				                <li <?php if($action == 'agency_holding'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/agency_holding"><i class="fa fa-users"></i>
				                    Agency_holding
				                    </a>
				                </li>
				                <!--  EO : Agency_holding -->

				               

								<!-- BO : Participantes -->
				                <li <?php if($action == 'participantes'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/participantes"><i class="fa fa-users"></i>
				                    Participantes
				                    </a>
				                </li>
				                <!--  EO : Participantes -->

				               

								<!-- BO : Campanas -->
				                <li <?php if($action == 'campanas'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/campanas"><i class="fa fa-users"></i>
				                    Campanas
				                    </a>
				                </li>
				                <!--  EO : Campanas -->

				               

								<!-- BO : Client_company -->
				                <li <?php if($action == 'client_company'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/client_company"><i class="fa fa-users"></i>
				                    Client_company
				                    </a>
				                </li>
				                <!--  EO : Client_company -->

				               

								<!-- BO : Jueces -->
				                <li <?php if($action == 'jueces'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/jueces"><i class="fa fa-users"></i>
				                    Jueces
				                    </a>
				                </li>
				                <!--  EO : Jueces -->

				               

								<!-- BO : Salas_asignaciones -->
				                <li <?php if($action == 'salas_asignaciones'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/salas_asignaciones"><i class="fa fa-users"></i>
				                    Salas_asignaciones
				                    </a>
				                </li>
				                <!--  EO : Salas_asignaciones -->

				               

								<!-- BO : Campanas_autorizacion -->
				                <li <?php if($action == 'campanas_autorizacion'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/campanas_autorizacion"><i class="fa fa-users"></i>
				                    Campanas_autorizacion
				                    </a>
				                </li>
				                <!--  EO : Campanas_autorizacion -->

				               

								<!-- BO : Campanas_categorias -->
				                <li <?php if($action == 'campanas_categorias'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/campanas_categorias"><i class="fa fa-users"></i>
				                    Campanas_categorias
				                    </a>
				                </li>
				                <!--  EO : Campanas_categorias -->

				               

								<!-- BO : Campanas_creditos -->
				                <li <?php if($action == 'campanas_creditos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/campanas_creditos"><i class="fa fa-users"></i>
				                    Campanas_creditos
				                    </a>
				                </li>
				                <!--  EO : Campanas_creditos -->

				               

								<!-- BO : Campanas_archivos -->
				                <li <?php if($action == 'campanas_archivos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/campanas_archivos"><i class="fa fa-users"></i>
				                    Campanas_archivos
				                    </a>
				                </li>
				                <!--  EO : Campanas_archivos -->

				               

								<!-- BO : Campanas_resumen -->
				                <li <?php if($action == 'campanas_resumen'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/campanas_resumen"><i class="fa fa-users"></i>
				                    Campanas_resumen
				                    </a>
				                </li>
				                <!--  EO : Campanas_resumen -->

				               

								<!-- BO : Campanas_pagos -->
				                <li <?php if($action == 'campanas_pagos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/campanas_pagos"><i class="fa fa-users"></i>
				                    Campanas_pagos
				                    </a>
				                </li>
				                <!--  EO : Campanas_pagos -->

				               

								<!-- BO : Campanas_facturacion -->
				                <li <?php if($action == 'campanas_facturacion'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/campanas_facturacion"><i class="fa fa-users"></i>
				                    Campanas_facturacion
				                    </a>
				                </li>
				                <!--  EO : Campanas_facturacion -->

				               

								<!-- BO : Parametros -->
				                <li <?php if($action == 'parametros'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/parametros"><i class="fa fa-users"></i>
				                    Parametros
				                    </a>
				                </li>
				                <!--  EO : Parametros -->

				               

								<!-- BO : Opciones -->
				                <li <?php if($action == 'opciones'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/opciones"><i class="fa fa-users"></i>
				                    Opciones
				                    </a>
				                </li>
				                <!--  EO : Opciones -->

				               

								<!-- BO : Sistema -->
				                <li <?php if($action == 'sistema'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/sistema"><i class="fa fa-users"></i>
				                    Sistema
				                    </a>
				                </li>
				                <!--  EO : Sistema -->

				               

								<!-- BO : Agenda -->
				                <li <?php if($action == 'agenda'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/agenda"><i class="fa fa-users"></i>
				                    Agenda
				                    </a>
				                </li>
				                <!--  EO : Agenda -->

				               

								<!-- BO : Precalificacion -->
				                <li <?php if($action == 'precalificacion'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/precalificacion"><i class="fa fa-users"></i>
				                    Precalificacion
				                    </a>
				                </li>
				                <!--  EO : Precalificacion -->

				               

								<!-- BO : Visitas -->
				                <li <?php if($action == 'visitas'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/visitas"><i class="fa fa-users"></i>
				                    Visitas
				                    </a>
				                </li>
				                <!--  EO : Visitas -->

				               

								<!-- BO : Productos_parametros -->
				                <li <?php if($action == 'productos_parametros'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/productos_parametros"><i class="fa fa-users"></i>
				                    Productos_parametros
				                    </a>
				                </li>
				                <!--  EO : Productos_parametros -->

				               

								<!-- BO : Documentos_tipos -->
				                <li <?php if($action == 'documentos_tipos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/documentos_tipos"><i class="fa fa-users"></i>
				                    Documentos_tipos
				                    </a>
				                </li>
				                <!--  EO : Documentos_tipos -->

				               

								<!-- BO : Productos_simulador -->
				                <li <?php if($action == 'productos_simulador'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/productos_simulador"><i class="fa fa-users"></i>
				                    Productos_simulador
				                    </a>
				                </li>
				                <!--  EO : Productos_simulador -->

				               

								<!-- BO : Bitacora -->
				                <li <?php if($action == 'bitacora'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/bitacora"><i class="fa fa-users"></i>
				                    Bitacora
				                    </a>
				                </li>
				                <!--  EO : Bitacora -->

				               

								<!-- BO : Simuladores -->
				                <li <?php if($action == 'simuladores'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/simuladores"><i class="fa fa-users"></i>
				                    Simuladores
				                    </a>
				                </li>
				                <!--  EO : Simuladores -->

				               

								<!-- BO : Simuladores_valores -->
				                <li <?php if($action == 'simuladores_valores'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/simuladores_valores"><i class="fa fa-users"></i>
				                    Simuladores_valores
				                    </a>
				                </li>
				                <!--  EO : Simuladores_valores -->

				               

								<!-- BO : Expedientes -->
				                <li <?php if($action == 'expedientes'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/expedientes"><i class="fa fa-users"></i>
				                    Expedientes
				                    </a>
				                </li>
				                <!--  EO : Expedientes -->

				               

								<!-- BO : Clientes_cotitulares -->
				                <li <?php if($action == 'clientes_cotitulares'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/clientes_cotitulares"><i class="fa fa-users"></i>
				                    Clientes_cotitulares
				                    </a>
				                </li>
				                <!--  EO : Clientes_cotitulares -->

				               

								<!-- BO : Clientes_referencias -->
				                <li <?php if($action == 'clientes_referencias'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/clientes_referencias"><i class="fa fa-users"></i>
				                    Clientes_referencias
				                    </a>
				                </li>
				                <!--  EO : Clientes_referencias -->

				               

								<!-- BO : Solicitudes -->
				                <li <?php if($action == 'solicitudes'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/solicitudes"><i class="fa fa-users"></i>
				                    Solicitudes
				                    </a>
				                </li>
				                <!--  EO : Solicitudes -->

				               

								<!-- BO : Asesores -->
				                <li <?php if($action == 'asesores'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/asesores"><i class="fa fa-users"></i>
				                    Asesores
				                    </a>
				                </li>
				                <!--  EO : Asesores -->

				               

								<!-- BO : Conf_documentacion -->
				                <li <?php if($action == 'conf_documentacion'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/conf_documentacion"><i class="fa fa-users"></i>
				                    Conf_documentacion
				                    </a>
				                </li>
				                <!--  EO : Conf_documentacion -->

				               

								<!-- BO : Conf_flujo -->
				                <li <?php if($action == 'conf_flujo'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/conf_flujo"><i class="fa fa-users"></i>
				                    Conf_flujo
				                    </a>
				                </li>
				                <!--  EO : Conf_flujo -->

				               

								<!-- BO : Conf_productos -->
				                <li <?php if($action == 'conf_productos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/conf_productos"><i class="fa fa-users"></i>
				                    Conf_productos
				                    </a>
				                </li>
				                <!--  EO : Conf_productos -->

				               

								<!-- BO : Solicitudes_expediente -->
				                <li <?php if($action == 'solicitudes_expediente'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/solicitudes_expediente"><i class="fa fa-users"></i>
				                    Solicitudes_expediente
				                    </a>
				                </li>
				                <!--  EO : Solicitudes_expediente -->

				               

								<!-- BO : Conf_bancos -->
				                <li <?php if($action == 'conf_bancos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/conf_bancos"><i class="fa fa-users"></i>
				                    Conf_bancos
				                    </a>
				                </li>
				                <!--  EO : Conf_bancos -->

				               

								<!-- BO : Conf_reglas -->
				                <li <?php if($action == 'conf_reglas'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/conf_reglas"><i class="fa fa-users"></i>
				                    Conf_reglas
				                    </a>
				                </li>
				                <!--  EO : Conf_reglas -->

				               

								<!-- BO : Conf_sistema -->
				                <li <?php if($action == 'conf_sistema'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/conf_sistema"><i class="fa fa-users"></i>
				                    Conf_sistema
				                    </a>
				                </li>
				                <!--  EO : Conf_sistema -->

				               

								<!-- BO : Envios -->
				                <li <?php if($action == 'envios'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/envios"><i class="fa fa-users"></i>
				                    Envios
				                    </a>
				                </li>
				                <!--  EO : Envios -->

				               

								<!-- BO : Solicitudes_rechazos -->
				                <li <?php if($action == 'solicitudes_rechazos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/solicitudes_rechazos"><i class="fa fa-users"></i>
				                    Solicitudes_rechazos
				                    </a>
				                </li>
				                <!--  EO : Solicitudes_rechazos -->

				               

								<!-- BO : Solicitudes_expreglas -->
				                <li <?php if($action == 'solicitudes_expreglas'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/solicitudes_expreglas"><i class="fa fa-users"></i>
				                    Solicitudes_expreglas
				                    </a>
				                </li>
				                <!--  EO : Solicitudes_expreglas -->

				               

								<!-- BO : Solicitudes_contratos -->
				                <li <?php if($action == 'solicitudes_contratos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/solicitudes_contratos"><i class="fa fa-users"></i>
				                    Solicitudes_contratos
				                    </a>
				                </li>
				                <!--  EO : Solicitudes_contratos -->

				               

								<!-- BO : Conf_asesores -->
				                <li <?php if($action == 'conf_asesores'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/conf_asesores"><i class="fa fa-users"></i>
				                    Conf_asesores
				                    </a>
				                </li>
				                <!--  EO : Conf_asesores -->

				               

								<!-- BO : Almacenes -->
				                <li <?php if($action == 'almacenes'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/almacenes"><i class="fa fa-users"></i>
				                    Almacenes
				                    </a>
				                </li>
				                <!--  EO : Almacenes -->

				               

								<!-- BO : Areas -->
				                <li <?php if($action == 'areas'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/areas"><i class="fa fa-users"></i>
				                    Areas
				                    </a>
				                </li>
				                <!--  EO : Areas -->

				               

								<!-- BO : Caja_movimientos -->
				                <li <?php if($action == 'caja_movimientos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/caja_movimientos"><i class="fa fa-users"></i>
				                    Caja_movimientos
				                    </a>
				                </li>
				                <!--  EO : Caja_movimientos -->

				               

								<!-- BO : Clasificaciones -->
				                <li <?php if($action == 'clasificaciones'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/clasificaciones"><i class="fa fa-users"></i>
				                    Clasificaciones
				                    </a>
				                </li>
				                <!--  EO : Clasificaciones -->

				               

								<!-- BO : Clientes_domicilios -->
				                <li <?php if($action == 'clientes_domicilios'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/clientes_domicilios"><i class="fa fa-users"></i>
				                    Clientes_domicilios
				                    </a>
				                </li>
				                <!--  EO : Clientes_domicilios -->

				               

								<!-- BO : Modulos -->
				                <li <?php if($action == 'modulos'){?>class="active "<?php } ?>  >
				                    <a href="<?php echo url("/"); ?>/admin/modulos"><i class="fa fa-users"></i>
				                    Modulos
				                    </a>
				                </li>
				                <!--  EO : Modulos -->

				               <!--  @@@@@#####@@@@@ -->

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

				                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                

                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->



            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo url('/'); ?>/images/img.jpg" alt="">John Doe
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="<?php echo url('/'); ?>/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?php echo url('/'); ?>/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?php echo url('/'); ?>/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?php echo url('/'); ?>/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->


      <div class = "container">
        @yield('content')
      </div>




        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo url('/'); ?>/accets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo url('/'); ?>/accets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo url('/'); ?>/accets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- Select2 -->
    <script src="<?php echo url('/'); ?>/accets/vendors/select2/dist/js/select2.full.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".select2").select2();
      });
    </script>
    <!-- NProgress -->
    <script src="<?php echo url('/'); ?>/accets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo url('/'); ?>/accets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo url('/'); ?>/accets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo url('/'); ?>/accets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo url('/'); ?>/accets/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo url('/'); ?>/accets/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo url('/'); ?>/accets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo url('/'); ?>/accets/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo url('/'); ?>/accets/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo url('/'); ?>/accets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo url('/'); ?>/accets/vendors/chosen/chosen.jquery.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo url('/'); ?>/accets/build/js/custom.min.js"></script>
    <script type="text/javascript">
      $(".date").datepicker({
        format: 'yyyy-mm-dd'
      });
      $('.datetime').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
      });
      $('.timepicker').datetimepicker({
        format: 'HH:mm:ss'
      });
    </script>
    <script src="<?php echo url('/'); ?>/accets/recordDel.js"></script>
  </body>
</html>