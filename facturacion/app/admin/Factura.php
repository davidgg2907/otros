<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'factura';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    const IMPUESTOS = array(      
      '001' => 'ISR',
      '002' => 'IVA',
      '003' => 'IEPS',      
    );

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getFactura($id){
      $data =  Factura::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getFacturaView($id){
      $factura = Factura::select(array('factura.*'));
      $factura->where('factura.id', $id);
      
      return $factura->get()[0];

    }

    public function updateStatus($id, $num){
      $factura = $this->getFactura($id);
      if(count($factura)){
        $factura->status = $num;
        $factura->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $factura = $this->getFactura($id);
      if(count($factura)){
        $img = public_path().'/uploads/'.$factura->featured_img;
            if($factura->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $factura->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getFacturaData($per_page, $request, $sortBy, $order){
      $factura = Factura::select(array('factura.*'));

      //join
        

        // sort option
        $factura->orderBy('factura.id', 'desc');

        $factura->where('factura.status', '1');

        return $factura->paginate($per_page);
    }

    public function updateFactura($request){
      $id = $request->input('id');
      $factura = Factura::getFactura($id);
      if(count($factura)){

          $factura->id = $request->input('id')!="" ? $request->input('id') : "";
	$factura->emisor = $request->input('emisor')!="" ? $request->input('emisor') : "";
	$factura->metodoPago = $request->input('metodoPago')!="" ? $request->input('metodoPago') : "";
	$factura->lugarExpedicion = $request->input('lugarExpedicion')!="" ? $request->input('lugarExpedicion') : "";
	$factura->degimenFiscal = $request->input('degimenFiscal')!="" ? $request->input('degimenFiscal') : "";
	$factura->deceptor = $request->input('deceptor')!="" ? $request->input('deceptor') : "";
	$factura->domicilioReceptor = $request->input('domicilioReceptor')!="" ? $request->input('domicilioReceptor') : "";
	$factura->regimenFiscalReceptor = $request->input('regimenFiscalReceptor')!="" ? $request->input('regimenFiscalReceptor') : "";
	$factura->usoCFDI = $request->input('usoCFDI')!="" ? $request->input('usoCFDI') : "";
	$factura->sello = $request->input('sello')!="" ? $request->input('sello') : "";
	$factura->noCertificado = $request->input('noCertificado')!="" ? $request->input('noCertificado') : "";
	$factura->certificado = $request->input('certificado')!="" ? $request->input('certificado') : "";
	$factura->subTotal = $request->input('subTotal')!="" ? $request->input('subTotal') : "";
	$factura->moneda = $request->input('moneda')!="" ? $request->input('moneda') : "";
	$factura->total = $request->input('total')!="" ? $request->input('total') : "";
	$factura->tipoDeComprobante = $request->input('tipoDeComprobante')!="" ? $request->input('tipoDeComprobante') : "";
	$factura->UUID = $request->input('UUID')!="" ? $request->input('UUID') : "";
	$factura->fechaTimbrado = $request->input('fechaTimbrado')!="" ? $request->input('fechaTimbrado') : "";
	$factura->rfcProvCertif = $request->input('rfcProvCertif')!="" ? $request->input('rfcProvCertif') : "";
	$factura->selloCFD = $request->input('selloCFD')!="" ? $request->input('selloCFD') : "";
	$factura->noCertificadoSAT = $request->input('noCertificadoSAT')!="" ? $request->input('noCertificadoSAT') : "";
	$factura->selloSAT = $request->input('selloSAT')!="" ? $request->input('selloSAT') : "";
	$factura->status = $request->input('status')!="" ? $request->input('status') : "";

          $factura->save();
          return true;
      } else{
        return false;
      }
    }

    public function addFactura($request){
      $factura = new Factura;

        
	$factura->emisor = $request->input('emisor')!="" ? $request->input('emisor') : "";
	$factura->metodoPago = $request->input('metodoPago')!="" ? $request->input('metodoPago') : "";
	$factura->lugarExpedicion = $request->input('lugarExpedicion')!="" ? $request->input('lugarExpedicion') : "";
	$factura->degimenFiscal = $request->input('degimenFiscal')!="" ? $request->input('degimenFiscal') : "";
	$factura->deceptor = $request->input('deceptor')!="" ? $request->input('deceptor') : "";
	$factura->domicilioReceptor = $request->input('domicilioReceptor')!="" ? $request->input('domicilioReceptor') : "";
	$factura->regimenFiscalReceptor = $request->input('regimenFiscalReceptor')!="" ? $request->input('regimenFiscalReceptor') : "";
	$factura->usoCFDI = $request->input('usoCFDI')!="" ? $request->input('usoCFDI') : "";
	$factura->sello = $request->input('sello')!="" ? $request->input('sello') : "";
	$factura->noCertificado = $request->input('noCertificado')!="" ? $request->input('noCertificado') : "";
	$factura->certificado = $request->input('certificado')!="" ? $request->input('certificado') : "";
	$factura->subTotal = $request->input('subTotal')!="" ? $request->input('subTotal') : "";
	$factura->moneda = $request->input('moneda')!="" ? $request->input('moneda') : "";
	$factura->total = $request->input('total')!="" ? $request->input('total') : "";
	$factura->tipoDeComprobante = $request->input('tipoDeComprobante')!="" ? $request->input('tipoDeComprobante') : "";
	$factura->UUID = $request->input('UUID')!="" ? $request->input('UUID') : "";
	$factura->fechaTimbrado = $request->input('fechaTimbrado')!="" ? $request->input('fechaTimbrado') : "";
	$factura->rfcProvCertif = $request->input('rfcProvCertif')!="" ? $request->input('rfcProvCertif') : "";
	$factura->selloCFD = $request->input('selloCFD')!="" ? $request->input('selloCFD') : "";
	$factura->noCertificadoSAT = $request->input('noCertificadoSAT')!="" ? $request->input('noCertificadoSAT') : "";
	$factura->selloSAT = $request->input('selloSAT')!="" ? $request->input('selloSAT') : "";
	$factura->status = $request->input('status')!="" ? $request->input('status') : "";

        $factura->save();
        return true;
    }

    public function totalImpuestos() {

      $total = \App\admin\Factura_impuestos::where('factura_id',$this->id)->sum('importe');
      return $total;

    }

    public function user(){
      return $this->hasOne('\App\admin\Users', 'id', 'user_id');
    }
}
