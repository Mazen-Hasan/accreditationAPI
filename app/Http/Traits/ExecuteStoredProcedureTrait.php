<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

trait ExecuteStoredProcedureTrait
{

    static public function execute($procedureName, $params)
    {

        $temp_params = $params;

        $query = 'call ' . $procedureName . ' (@errCode,@errMsg,';
        foreach ($temp_params as $param) {
            $query .= "'" . $param . "',";
        }

        $query = rtrim($query, ", ");
        $query .= '); ';

        $data = DB::select($query);

        $results = DB::select('select @errCode as errCode, @errMsg as errMsg ');

        return Response()->json([
            "errCode" => $results[0]->errCode,
            "errMsg" => $results[0]->errMsg,
            "data" => $data
        ]);
    }

    static public function execute1($procedureName, $params)
    {

        $temp_params = $params;

        $query = 'call ' . $procedureName . ' (@errCode,@errMsg,';
        foreach ($temp_params as $param) {
            $query .= "'" . $param . "',";
        }

        $query = rtrim($query, ", ");
        $query .= '); ';

        $data = DB::select($query);

        $results = DB::select('select @errCode as errCode, @errMsg as errMsg ');

        $returnedJson = [];
        $returnedJson["errCode"] = $results[0]->errCode;
        $returnedJson["errMsg"] = $results[0]->errMsg;
        $returnedJson["data"] = json_decode(json_encode($data),true);

        return $returnedJson;

        return Response()->json([
            "errCode" => $results[0]->errCode,
            "errMsg" => $results[0]->errMsg,
            "data" => $data
        ]);
    }

    static public function executeOutParams($procedureName, $params, $outParams)
    {

        //put params in temp_params
        $temp_params = $params;

        //prepare call statement
        $query = 'call ' . $procedureName . ' (@errCode,@errMsg,';

        //loop params
        foreach ($temp_params as $param) {
            $query .= "'" . $param . "',";
        }

        //put outParams in temp_params
        $temp_params = $outParams;

        //loop params
        foreach ($temp_params as $param) {
            $query .= "" . $param . ",";
        }

        //remove last ","
        $query = rtrim($query, ", ");
        $query .= '); ';

        //get cursor result
        $data = DB::select($query);

        //prepare select statement
        $query = 'select @errCode as errCode, @errMsg as errMsg';

        foreach ($temp_params as $param) {
            $query .= "," . $param . " as " . ltrim($param, "@") . ",";
        }

        //remove last ","
        $query = rtrim($query, ", ");

        //get out params from stored procedure
        $results = DB::select($query);

        //convert to json object
        $resultsJson = json_decode(json_encode($results[0]), true);

        $returnJson = [];

        //add result info to returnedJson
        foreach ($resultsJson as $key => $value) {
            if ($key == 'errMsg' || $key == 'errCode') {
                $returnJson[$key] = $value;
            }
        }

        //add out param to outData
        $outData = [];
        foreach ($resultsJson as $key => $value) {
            if ($key != 'errMsg' && $key != 'errCode') {
                $outData[$key] = $value;
            }
        }

        //add cursor result to outData
        $outData['data'] = $data;

        //add outData to returnedJson
        $returnJson['data'] = $outData;
        return Response()->json($returnJson);
    }

    static public function execute2($procedureName, $params) {

        $temp_params = $params;

        $query = 'call ' . $procedureName . ' (@errCode,@errMsg,@gridCount,';
        foreach ($temp_params as $param){
            $query .= "'" . $param . "',";
        }

        $query = rtrim($query, ", ");
        $query .= '); ';

        $data = DB::select($query);

//        DB::select("call venue_add(@errMsg, @errCode,1,'f4b9289d-ec43-11ec-a655-e8d8d1fd9cf6', 'NN')");

        $results = DB::select('select @errCode as errCode, @errMsg as errMsg , @gridCount as gridCount');
//        var_dump($results[0]->errMsg);
//        exit;


        return Response()->json([
            "errCode" => $results[0]->errCode,
            "errMsg" => $results[0]->errMsg,
            "size" =>$results[0]->gridCount,
            "data" => $data
        ]);
    }
}
