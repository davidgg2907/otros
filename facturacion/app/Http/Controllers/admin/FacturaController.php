<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Factura;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class FacturaController extends Controller
{
    public $v_fields=array('factura.id', 'factura.emisor', 'factura.metodoPago', 'factura.lugarExpedicion', 'factura.degimenFiscal', 'factura.deceptor', 'factura.domicilioReceptor', 'factura.regimenFiscalReceptor', 'factura.usoCFDI', 'factura.sello', 'factura.noCertificado', 'factura.certificado', 'factura.subTotal', 'factura.moneda', 'factura.total', 'factura.tipoDeComprobante', 'factura.UUID', 'factura.fechaTimbrado', 'factura.rfcProvCertif', 'factura.selloCFD', 'factura.noCertificadoSAT', 'factura.selloSAT', 'factura.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $factura = new \App\admin\Factura;

        $config = array();

        $config['titulo'] = "factura";

        $config['cancelar'] = url('/admin/factura');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de factura",
            'href' => url('/admin/factura'),
            'active' => false
        );

        $data = $factura->getFacturaData($per_page, $request, $sortBy, $order);

        return view('admin/factura/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $factura = new \App\admin\Factura;

      $config = array();

      $config['titulo'] = "factura";

      $config['cancelar'] = url('/admin/factura');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de factura",
          'href' => url('/admin/factura'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar factura",
          'href' => url('/admin/factura/add'),
          'active' => true
      );

      $data = new $factura;

    	return view('admin/factura/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){
        
        //Cargamos el archivo xml
        // image upload code
        $photo_name='';
        $photo_file = $request->file('file');
        if(!is_null($photo_file)){
            
            $photo_name = $photo_file->getClientOriginalName();
            
            if($photo_file->move('uploads/',$photo_name)) {

                $this->leeXML('uploads/' . $photo_name); 
            
            }
            
        }
    }

    public function getDetallado(Request $request){

        $factura = new \App\admin\Factura;

        $users = $factura->getAll('factura');

        $config = array();

        $config['titulo'] = "factura";

        $config['cancelar'] = url('/admin/factura');

        $config['breadcrumbs'][] = array(
            'text'     => "Inicio",
            'href'     => url('/'),
            'active'   => false
        );

        $config['breadcrumbs'][] = array(
            'text'     => "Listado de factura",
            'href'     => url('/admin/factura'),
            'active'   => false
        );

        $config['breadcrumbs'][] = array(
            'text'     => "Editar factura",
            'href'     => url('/admin/factura/edit'),
            'active'   => true
        );

        $data       = array();
        $dataImp    = array();

        if($request->input('sending') == 1) {
           
            $query = \App\admin\Factura_detalle::select('factura_detalle.*','factura.UUID')
                                               ->join('factura','factura.id','factura_detalle.factura_id')
                                               ->where('factura.status',1);

            $queryImp = \App\admin\Factura_impuestos::select('factura_impuestos.*','factura.UUID')
                                                    ->join('factura','factura.id','factura_impuestos.factura_id')
                                                    ->where('factura.status',1);
                                           
            if($request->input('emisor')) {
                $query->where('factura.emisor',$request->input('emisor'));
                $queryImp->where('factura.emisor',$request->input('emisor'));
            }

            if($request->input('receptor')) {
                $query->where('factura.receptor',$request->input('receptor'));
                $queryImp->where('factura.receptor',$request->input('receptor'));
            }

            if($request->input('usoCFDI')) {
                $query->where('factura.usoCFDI',$request->input('usoCFDI'));
                $queryImp->where('factura.usoCFDI',$request->input('usoCFDI'));
            }

            if($request->input('fecha')) {
                $query->where('factura.fechaTimbrado',$request->input('fecha'));
                $queryImp->where('factura.fechaTimbrado',$request->input('fecha'));
            }

            if($request->input('uuid')) {
                $query->where('factura.uuid',$request->input('uuid'));
                $queryImp->where('factura.uuid',$request->input('uuid'));
            }
            
            $data       = $query->get();
            $dataImp    = $queryImp->get();
            
        }

        return view('admin/factura/edit', ['data'=>$data, 'config'=>$config ,'impuestos' => $dataImp]);
    }

    public function getGeneral(Request $request){

        $factura = new \App\admin\Factura;

        $users = $factura->getAll('factura');

        $config = array();

        $config['titulo'] = "factura";

        $config['cancelar'] = url('/admin/factura');

        $config['breadcrumbs'][] = array(
            'text'     => "Inicio",
            'href'     => url('/'),
            'active'   => false
        );

        $config['breadcrumbs'][] = array(
            'text'     => "Listado de factura",
            'href'     => url('/admin/factura'),
            'active'   => false
        );

        $config['breadcrumbs'][] = array(
            'text'     => "Editar factura",
            'href'     => url('/admin/factura/edit'),
            'active'   => true
        );  

        $data       = array();

        if($request->input('sending') == 1) {
                      
            $query = \App\admin\Factura::select('factura_detalle.*','factura.emisor','factura.UUID','factura.fechaTimbrado')
                                    ->join('factura_detalle','factura_detalle.factura_id','factura.id')
                                    ->where('factura.status',1);

            if($request->input('emisor')) {
                $query->where('factura.emisor',$request->input('emisor'));
            }

            if($request->input('receptor')) {
                $query->where('factura.receptor',$request->input('receptor'));
            }

            if($request->input('usoCFDI')) {
                $query->where('factura.usoCFDI',$request->input('usoCFDI'));
            }

            if($request->input('fecha')) {
                $query->where('factura.fechaTimbrado',$request->input('fecha'));
            }

            if($request->input('uuid')) {
                $query->where('factura.uuid',$request->input('uuid'));
            }
            
            $data       = $query->get();
            
        } 

        return view('admin/factura/general', ['data'=>$data, 'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $factura = new \App\admin\Factura;
        if($factura->updateFactura($request)){
            $request->session()->flash('message', 'factura Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\FacturaController@index');
    }

    public function view($id){

      $factura = new \App\admin\Factura;

      $data = $factura->getFacturaView($id);

      $config = array();

      $config['titulo'] = "factura";

      $config['cancelar'] = url('/admin/factura');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de factura",
          'href' => url('/admin/factura'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de factura",
          'href' => url('/admin/factura/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/factura/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/factura/view');

      }

    }

    public function baja($id){

        $factura = new \App\admin\Factura;
        $flag = $factura->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$factura deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\FacturaController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\FacturaController@index');
        }
    }

    public function alta($id){
        $factura = new \App\admin\Factura;
        $flag = $factura->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$factura habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\FacturaController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\FacturaController@index');
        }
    }

    public function getAjax($id){

      $factura = new \App\admin\Factura;

      $data = $factura->getFacturaView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $factura = new \App\admin\Factura;

      $query = \App\admin\Factura::where('status',1);

            if($request->input('emisor')) {
                $query->where('factura.emisor',$request->input('emisor'));
            }

            if($request->input('receptor')) {
                $query->where('factura.receptor',$request->input('receptor'));
            }

            if($request->input('usoCFDI')) {
                $query->where('factura.usoCFDI',$request->input('usoCFDI'));
            }

            if($request->input('fecha')) {
                $query->where('factura.fechaTimbrado',$request->input('fecha'));
            }

            if($request->input('uuid')) {
                $query->where('factura.uuid',$request->input('uuid'));
            }
            
            $data       = $query->get();
            $data->download('reporte.xlsx');
      /*\Maatwebsite\Excel\Facades\Excel::download('$factura', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');*/

    }

    public function leeXML($route) {

        $xml = simplexml_load_file($route); 
        $ns = $xml->getNamespaces(true);
        $xml->registerXPathNamespace('c', $ns['cfdi']);
        $xml->registerXPathNamespace('t', $ns['tfd']);

        $factura = new \App\admin\Factura;
        
        foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante){
            
            
            $factura->metodoPago                = $cfdiComprobante['MetodoPago'];
            $factura->version                   = $cfdiComprobante['Version'];
            $factura->serie                     = $cfdiComprobante['Serie'];
            $factura->lugarExpedicion           = $cfdiComprobante['LugarExpedicion'];            
            $factura->sello                     = $cfdiComprobante['Sello'];
            $factura->noCertificado             = $cfdiComprobante['NoCertificado'];
            $factura->certificado               = $cfdiComprobante['Certificado'];
            $factura->subTotal                  = $cfdiComprobante['SubTotal'];
            $factura->moneda                    = $cfdiComprobante['Moneda'];
            $factura->descuento                 = $cfdiComprobante['Descuento'];
            $factura->total                     = $cfdiComprobante['Total'];
            $factura->tipoDeComprobante         = $cfdiComprobante['TipoDeComprobante'];            
            $factura->fechaTimbrado             = $cfdiComprobante['Fecha'];
            $factura->selloCFD                  = $cfdiComprobante['Sello'];   
            $factura->folio                     = isset($cfdiComprobante['Folio']) ? $cfdiComprobante['Folio'] : null;
            $factura->serie                     = isset($cfdiComprobante['Serie']) ? $cfdiComprobante['Serie'] : null;
                        
        } 

        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor){ 

            $factura->emisor       = $Emisor['Nombre'];
            $factura->emisorRfc    = $Emisor['Rfc']; 

        } 

        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor){ 

            $factura->receptorRfc               = $Receptor['Rfc'];
            $factura->receptor                  = $Receptor['Nombre'];
            $factura->domicilioReceptor         = $Receptor['DomicilioFiscalReceptor'];
            $factura->regimenFiscalReceptor     = $Receptor['RegimenFiscalReceptor'];
            $factura->usoCFDI                   = $Receptor['UsoCFDI'];
        } 

        foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {


            $factura->UUID                      = $tfd['UUID'];
            $factura->noCertificadoSAT          = $tfd['NoCertificadoSAT'];
            $factura->selloSAT                  = $tfd['SelloSAT'];
        } 

        $factura->status    = 1; 
        $factura->user_id   = Auth::user()->id;
        $factura->save();
        
        $factura_id = $factura->id;

        $total_iva       = 0;
        $total_isr       = 0;
        $total_ieps      = 0;
        $total_local     = 0;

        $iva_retenido    = 0;
        $isr_retenido    = 0;
        $ieps_retenido   = 0;
        $local_retenido  = 0;
        $total_descuento = 0;

        foreach ($xml->xpath('//cfdi:Impuestos//cfdi:Traslados//cfdi:Traslado') as $Traslado){ 

            if($Traslado['Base'] != "") {

                //Buscamos si el impuesto ya fue registrado para no duplicarlo

                $duplicado = \App\admin\Factura_impuestos::where('base',$Traslado['Base'])
                                                        ->where('impuesto',$Traslado['Impuesto'])
                                                        ->where('importe',$Traslado['Importe'])
                                                        ->where('tipo','Traslado')
                                                        ->first();                   

                if(!count($duplicado)) {
                    
                    $impuestos = new \App\admin\Factura_impuestos;

                    $impuestos->factura_id  = $factura_id;
                    $impuestos->tipo        = "Traslado";
                    $impuestos->base        = $Traslado['Base'];
                    $impuestos->impuesto    = $Traslado['Impuesto'];
                    $impuestos->tasacuota   = $Traslado['TasaOCuota'];
                    $impuestos->factor      = $Traslado['TipoFactor'];    
                    $impuestos->importe     = $Traslado['Importe'];
                    $impuestos->status      = 1;
                    $impuestos->save();

                    if($Traslado['Impuesto'] == "002") { $total_iva += $Traslado['Importe']; } 
                    elseif($Traslado['Impuesto'] == "003") { $total_ieps += $Traslado['Importe']; } 
                    else { $total_local += $Traslado['Importe'];  }
                }
                
            }
            
        }           
        
        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Impuestos//cfdi:Retenciones//cfdi:Retencion') as $Retencion){ 

            if($Retencion['Base'] != "") {
                
                $duplicado = \App\admin\Factura_impuestos::where('base',$Retencion['Base'])
                                                        ->where('impuesto',$Retencion['Impuesto'])
                                                        ->where('importe',$Retencion['Importe'])
                                                        ->where('tipo','Retencion')
                                                        ->first();                   

                if(!count($duplicado)) {
                   
                    $impuestos = new \App\admin\Factura_impuestos;

                    $impuestos->factura_id  = $factura_id;
                    $impuestos->tipo        = "Retencion";
                    $impuestos->base        = $Retencion['Base'];
                    $impuestos->impuesto    = $Retencion['Impuesto'];
                    $impuestos->tasacuota   = $Retencion['TasaOCuota'];
                    $impuestos->factor      = $Retencion['TipoFactor'];    
                    $impuestos->importe     = $Retencion['Importe'];
                    $impuestos->status      = 1;
                    $impuestos->save();

                    if($Retencion['Impuesto'] == "001") { $isr_retenido += $Retencion['Importe']; } 
                    elseif($Retencion['Impuesto'] == "002") { $iva_retenido += $Retencion['Importe']; } 
                    elseif($Retencion['Impuesto'] == "003") { $ieps_retenido += $Retencion['Importe']; } 
                    else { $local_retenido += $Retencion['Importe'];  }

                }                

            }
            
        }
        
        
        $factura->iva               = $total_iva;
        $factura->ieps              = $total_ieps;
        $factura->impuesto_local    = $total_local;
        $factura->isr_retenido      = $isr_retenido;        
        $factura->iva_retenido      = $iva_retenido;
        $factura->ieps_retenido     = $ieps_retenido;
        $factura->retencion_local   = $local_retenido;
        $factura->save();    

        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto){ 

            $detalle = new  \App\admin\Factura_detalle;

            $detalle->factura_id        = $factura_id;
            $detalle->ClaveProdServ     = $Concepto['ClaveProdServ'];
            $detalle->NoIdentificacion  = $Concepto['NoIdentificacion']; 
            $detalle->Cantidad          = $Concepto['Cantidad'];     
            $detalle->ClaveUnidad       = $Concepto['ClaveUnidad']; 
            $detalle->Unidad            = $Concepto['Unidad']; 
            $detalle->Descripcion       = $Concepto['Descripcion']; 
            $detalle->ValorUnitario     = $Concepto['ValorUnitario']; 
            $detalle->Importe           = $Concepto['Importe']; 
            $detalle->Descuento         = $Concepto['Descuento']; 
            $detalle->status            = 1; 
            $detalle->save();

            $total_descuento += (float)$Concepto['Descuento'];
        } 
        
        $factura->descuento   = $total_descuento;
        $factura->save(); 

        echo 'OK';
    }

    public function getRptExcel(Request $request) {

        $factura = new \App\admin\Factura;
        $data       = array();

        if($request->input('sending') == 1) {
           
            $query = \App\admin\Factura::where('status',1);

            if($request->input('emisor')) {
                $query->where('factura.emisor',$request->input('emisor'));
            }

            if($request->input('receptor')) {
                $query->where('factura.receptor',$request->input('receptor'));
            }

            if($request->input('usoCFDI')) {
                $query->where('factura.usoCFDI',$request->input('usoCFDI'));
            }

            if($request->input('fecha')) {
                $query->where('factura.fechaTimbrado',$request->input('fecha'));
            }

            if($request->input('uuid')) {
                $query->where('factura.uuid',$request->input('uuid'));
            }
            
            $data       = $query->get();
            
        } 

        return view('admin/factura/rpt', ['data'=>$data ]);

    }

    public function getRptpdf(Request $request) {
        $data       = array();
           
        $query = \App\admin\Factura::select('factura_detalle.*','factura.emisor','factura.UUID','factura.fechaTimbrado')
                                   ->join('factura_detalle','factura_detalle.factura_id','factura.id')
                                   ->where('factura.status',1);

        if($request->input('emisor')) {
            $query->where('factura.emisor',$request->input('emisor'));
        }

        if($request->input('receptor')) {
            $query->where('factura.receptor',$request->input('receptor'));
        }

        if($request->input('usoCFDI')) {
            $query->where('factura.usoCFDI',$request->input('usoCFDI'));
        }

        if($request->input('fecha')) {
            $query->where('factura.fechaTimbrado',$request->input('fecha'));
        }

        if($request->input('uuid')) {
            $query->where('factura.uuid',$request->input('uuid'));
        }
        
        $data       = $query->get();
            
        return view('admin/factura/rpt', ['data'=>$data ]);
    
    }

}
