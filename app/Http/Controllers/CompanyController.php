<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ExecuteStoredProcedureTrait;

class CompanyController extends Controller
{
    public function invite(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');
        $company_id = $request->input('company_id');
        $params = [$lang, $user_token, $event_id, $company_id];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('company_invite',$params,$outParams);
    }

    public function getAllParticipants(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $eventID = $request->input('eventID');
        $companyID = $request->input('companyID');
        $offset = $request->input('offset');
        $size = $request->input('size');
        $filters = $request->input('filters');
        // $lang = $lang;
        // $user_token = $token;
        // $eventID = $eventId;
        // $offset = $offset;
        // $size = $size;
        // $filters = $filters;

        $params = [$lang, $user_token, $eventID, $companyID, $offset,$size,$filters];
        $outParams = ['@gridcount'];
        return ExecuteStoredProcedureTrait::executeOutParams('company_participant_get_all',$params,$outParams);
    }

    public function getList(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];
        $dataJson = ExecuteStoredProcedureTrait::execute1('company_get_list',$params);

        return $this->parsData($dataJson);
    }

    private function parsData($data){
        $returnedJson = [];
        $tempData = $data["data"];
        $listType = [];

        $typeItem = [];

        $listTypeName = '';
        $listTypeKey = 'listType';
        $idKey = 'id';
        $nameKey = 'name';


        for($i = 0; $i < count($tempData);$i++) {
            $t = $tempData[$i];

            $listTypeName = $t[$listTypeKey];

            if (!array_key_exists($listTypeName, $listType)){
                $listType[$listTypeName] = [];
            }

            $typeItem = ['key'=> $t[$idKey], 'value' => $t[$nameKey]];


            array_push($listType[$listTypeName] , $typeItem);
        }

        $returnedJson['errCode'] = $data['errCode'];
        $returnedJson['errMsg'] = $data['errMsg'];
        $returnedJson['data']['data'] = $listType;

        return $returnedJson;
    }

    public function getAllCity(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $country_id = $request->input('country_id');
        $params = [$lang, $user_token, $country_id ];

        $outParams = ['@size'];
        return ExecuteStoredProcedureTrait::executeOutParams('city_get_all',$params, $outParams);
    }

    public function create(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $name  = $request->input('name');
        $address  = $request->input('address');
        $telephone  = $request->input('telephone');
        $website  = $request->input('website');
        $country_id  = $request->input('country_id');
        $city_id  = $request->input('city_id');
        $category_id = $request->input('category_id');
        $status  = $request->input('status');
        $focal_point_id  = $request->input('focal_point_id');
        $event_id  = $request->input('event_id');
        $size  = $request->input('size');
        $need_management  = $request->input('need_management');
        $params = [$lang, $user_token ,$name,$address,$telephone,$website,$country_id,$city_id,$category_id, $status,$focal_point_id,$event_id,$size,$need_management];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('company_add',$params, $outParams);
    }
}
