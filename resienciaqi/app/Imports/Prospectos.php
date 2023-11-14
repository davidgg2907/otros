<?php

namespace App\Imports;

use Auth;

use App\admin\Bitacora;
use App\admin\Sectores;
use App\admin\Estados;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Session;

class Prospectos implements ToModel, WithValidation, WithHeadingRow
{

    public function model(array $row) {
        print_r($row);

        $sector = Sectores::where('nombre',$row[1])->first();

        if(count($sector)) { $sector_id = $sector->id; }

        $estado = Estados::where('estado','LIKE','%' . $row[2] . '%')->first();

        if(count($estado)) { $estado_id = $estado->id; }


        $prospectos = new \App\admin\Prospectos;

        $prospectos->estatus_id = "0";
      	$prospectos->sector_id = $sector_id;
      	$prospectos->estado_id = $estado_id;
      	$prospectos->pais = $row[3];
      	$prospectos->nombre = $row['nombre_comercial'];
      	$prospectos->resumen = null;
      	$prospectos->website = $row[4];
      	$prospectos->direccion = $row[5];
      	$prospectos->telefono = null;
      	$prospectos->correo = $row[6];
      	$prospectos->acciones = null;
      	$prospectos->fecha_registro = date('Y-m-d');
      	$prospectos->porcentaje = 0;
      	$prospectos->status = "1";
        $prospectos->save();

        //Validamos porcentaje de captura
        $data = array('prospecto_id'  => $prospectos->id,
                      'cliente_id'    => 0,
                      'comentarios'   => 'Ingreso de prospecto por importacion de archivo',
                      'estatus_id'    => "0");

        Bitacora::addBitacora($data);

    }

    public function rules(): array{
        return [
           // Can also use callback validation rules
           '0' => function($attribute, $value, $onFailure) {
                if ($value !== '# de vta') {
                     $onFailure('Numero de venta erroneo');
                }
            }
        ];
    }

}
