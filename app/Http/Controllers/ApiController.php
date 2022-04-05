<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\ZipCodes;

use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    public function GetZipCode(Request $request)
    {
        $zipcode = $request->zipcode;

        $EntityZipCodes = ZipCodes::where('d_codigo', '=', $zipcode)->first();

        if($EntityZipCodes !== null)
        {
            $settlements = ZipCodes::where('d_codigo', '=', $zipcode)
                                            ->groupBy('id_asenta_cpcons')
                                            ->get();
            
            $array_settlements = array();

            foreach ($settlements as $settlement)
            {
                $array_settlement_type = array(
                                                "name"  => $settlement->d_tipo_asenta
                                            );

                array_push($array_settlements, [
                                                    "key" => (int)$settlement["id_asenta_cpcons"],
                                                    "name" => strtoupper($settlement["d_asenta"]),
                                                    "zone_type" => strtoupper($settlement["d_zona"]),
                                                    "settlement_type" => $array_settlement_type
                                                ]
                );
            }
            $code = $EntityZipCodes->c_CP != "" ? $EntityZipCodes->c_CP : null;
            $federal_entity = array(
                                        "key"  => (int)$EntityZipCodes->c_estado, 
                                        "name" => strtoupper($EntityZipCodes->d_estado), 
                                        "code" => $code  
                                    );

            $municipality = array(
                                        "key"  => (int)$EntityZipCodes->c_mnpio, 
                                        "name" => strtoupper($EntityZipCodes->D_mnpio)
                                    );


            $respuesta = array(
                                "zip_code"       => $EntityZipCodes->d_codigo, 
                                "locality"       => strtoupper($EntityZipCodes->d_ciudad),
                                "federal_entity" => $federal_entity,
                                "settlements"    => $array_settlements,
                                "municipality"   => $municipality
                            );
            return response()->json($respuesta, 200);
        }
        else
        {
            return response()->json(null, 404);
        }
    }
}
