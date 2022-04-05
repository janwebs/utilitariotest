<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class ZipCodes extends Model
{
    // custom table
    protected $table = 'zipcodes';
    // custom primary key
    protected $primaryKey = 'id';
    
    public $timestamps = false;

    public function GetZipCodes($zipcode)
    {
        /*
        $Lista       = array();
        $Cantidad    = 0;
        $Registros   = DB::select("SELECT MARCA AS marca, MODELO AS modelo, ANO AS ano, TIPO_VEHICULO AS tipo_vehiculo FROM marca_modelo_ano WHERE MARCA = '$Marca' AND MODELO = '$Modelo'");
        if(count($Registros) >= 1)
        {
            $Cantidad = count($Registros);
            foreach($Registros as $Registro)
            {
                array_push($Lista, [
                                        'marca'           => $Registro->marca,
                                        'modelo'          => $Registro->modelo,
                                        'ano'             => $Registro->ano,
                                        'tipo_vehiculo'   => $Registro->tipo_vehiculo
                                    ]);
            }
        }
        $respuesta = array("Cantidad" => $Cantidad, "Lista" => $Lista);
        return $respuesta;
        */
    }

}
