<?php
namespace App\Http\Traits;
use Illuminate\Support\Facades\DB;

trait ExecuteStoredProcedureTrait {

    static public function execute($procedureName, $params) {

        $temp_params = $params;

        $query = 'call ' . $procedureName . ' (@errCode,@errMsg,';
        foreach ($temp_params as $param){
            $query .= "'" . $param . "',";
        }

        $query = rtrim($query, ", ");
        $query .= '); ';

//        var_dump($query);
//        exit;

        $data = DB::select($query);

//        DB::select("call venue_add(@errMsg, @errCode,1,'f4b9289d-ec43-11ec-a655-e8d8d1fd9cf6', 'NN')");

        $results = DB::select('select @errCode as errCode, @errMsg as errMsg ');
//        var_dump($results[0]->errMsg);
//        exit;


        return Response()->json([
            "errCode" => $results[0]->errCode,
            "errMsg" => $results[0]->errMsg,
            "data" => $data
        ]);
    }
}
