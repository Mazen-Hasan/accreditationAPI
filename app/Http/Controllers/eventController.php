<?php

namespace App\Http\Controllers;

use App\Http\Traits\ExecuteStoredProcedureTrait;
use Illuminate\Http\Request;

class eventController extends Controller
{
    public function getList(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];
//        return ExecuteStoredProcedureTrait::execute('event_get_list',$params);
        //hi
        $dataJson = ExecuteStoredProcedureTrait::execute1('event_get_list',$params);

        return $this->parsData($dataJson);
    }

    public function create(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $venue_name = $request->input('venue_name');

        $params = [$lang, $user_token, $venue_name];
        //return ExecuteStoredProcedureTrait::execute('venue_add',$params);
    }

    public function enable(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $venue_id = $request->input('venue_id');

        $params = [$lang, $user_token, $venue_id, 1];
        //return ExecuteStoredProcedureTrait::execute('venue_change_status',$params);
    }

    public function disable(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $venue_id = $request->input('venue_id');

        $params = [$lang, $user_token, $venue_id, 0];
        //return ExecuteStoredProcedureTrait::execute('venue_change_status',$params);
    }

    public function update(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $venue_id = $request->input('venue_id');
        $venue_name = $request->input('venue_name');
        $venue_status = $request->input('venue_status');

        $params = [$lang, $user_token, $venue_id, $venue_name, $venue_status];
        // return ExecuteStoredProcedureTrait::execute('venue_update',$params);
    }

    private function parsData($data){
        $outData = [];
        $tempData = $data["data"];
        $listType = [];
        $listTypeData = [];

        $tempListData = [];
        $typeDataItem = [];
        $typeItem = [];

        $listTypeName = '';
        $listTypeKey = 'listType';
        $idKey = 'id';
        $nameKey = 'name';

        $eventTypes = [];
        $securityCategories = [];
        $eventTemplates = [];

        $eventList = [];


        for($i = 0; $i < count($tempData);$i++) {
            $t = $tempData[$i];

            $typeDataItem = [];

            $listTypeName = $t[$listTypeKey];

            $typeDataItem['id'] = $t[$idKey];
            $typeDataItem['name'] = $t[$nameKey];

            $typeItem[] = $typeDataItem;


            $listType[$listTypeName] = $listTypeData;
        }

//        for($i = 0; $i < count($tempData);$i++) {
//            $t = $tempData[$i];
////            var_dump($t);
//            foreach ($t as $key => $value) {
//                $typeDataItem = [];
//                if($key == 'listType'){
//                    $listTypeName = $value;
//                    if (!array_key_exists($listTypeName, $listType)){
//                        $listType[$listTypeName] = [];
//                    }
//                }
//                else{
//                    $typeDataItem[$key] = $value;
//                    $typeItem[] = $typeDataItem;
//                }
//
//                $listType[$listTypeName] = $listTypeData;
//            }
//        }

        var_dump($listType);
        exit;

        var_dump(json_encode($listType));
        exit;

    }

    public function getAll($token,$lang,$offset,$size,$filters)
    {
        $lang = $lang;
        $user_token = $token;
        $offset = $offset;
        $size = $size;
        $filters = $filters;

        $params = [$lang, $user_token, $offset,$size,$filters];
        return ExecuteStoredProcedureTrait::execute2('event_get_all',$params);
    }

    public function getAllCompanies($token,$lang,$eventId,$offset,$size,$filters)
    {
        $lang = $lang;
        $user_token = $token;
        $eventID = $eventId;
        $offset = $offset;
        $size = $size;
        $filters = $filters;

        $params = [$lang, $user_token, $eventID, $offset,$size,$filters];
        return ExecuteStoredProcedureTrait::execute2('event_company_get_all',$params);
    }
}