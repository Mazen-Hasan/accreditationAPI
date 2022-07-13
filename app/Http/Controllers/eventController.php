<?php

namespace App\Http\Controllers;

use App\Http\Traits\ExecuteStoredProcedureTrait;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getList(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];
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

            $typeItem = ['id'=> $t[$idKey], 'name' => $t[$nameKey]];


            array_push($listType[$listTypeName] , $typeItem);
        }

        $returnedJson['errCode'] = $data['errCode'];
        $returnedJson['errMsg'] = $data['errMsg'];
        $returnedJson['data']['data'] = $listType;

        return $returnedJson;
    }

    // public function getAll2($token,$lang,$offset,$size,$filters)
    // {
    //     $lang = $lang;
    //     $user_token = $token;
    //     $offset = $offset;
    //     $size = $size;
    //     $filters = $filters;

    //     $params = [$lang, $user_token, $offset,$size,$filters];
    //     return ExecuteStoredProcedureTrait::execute2('event_get_all',$params);
    // }

    public function getAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $offset = $request->input('offset');
        $size = $request->input('size');
        $filters = $request->input('filters');
        //$lang = $lang;
        //$user_token = $token;
        // $offset = $offset;
        // $size = $size;
        // $filters = $filters;
        $outParams = ['@gridcount'];
        $params = [$lang, $user_token, $offset,$size,$filters];
        return ExecuteStoredProcedureTrait::executeOutParams('event_get_all',$params,$outParams);
    }

    public function getAllWithArchived(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $offset = $request->input('offset');
        $size = $request->input('size');
        $filters = $request->input('filters');
        //$lang = $lang;
        //$user_token = $token;
        // $offset = $offset;
        // $size = $size;
        // $filters = $filters;
        $outParams = ['@gridcount'];
        $params = [$lang, $user_token, $offset,$size,$filters];
        return ExecuteStoredProcedureTrait::executeOutParams('event_get_all_with_archived',$params,$outParams);
    }

    // public function getAllCompanies2($token,$lang,$eventId,$offset,$size,$filters)
    // {
    //     $lang = $lang;
    //     $user_token = $token;
    //     $eventID = $eventId;
    //     $offset = $offset;
    //     $size = $size;
    //     $filters = $filters;

    //     $params = [$lang, $user_token, $eventID, $offset,$size,$filters];
    //     return ExecuteStoredProcedureTrait::execute2('event_company_get_all',$params);
    // }

    public function getAllCompanies(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $eventID = $request->input('eventID');
        $offset = $request->input('offset');
        $size = $request->input('size');
        $filters = $request->input('filters');
        // $lang = $lang;
        // $user_token = $token;
        // $eventID = $eventId;
        // $offset = $offset;
        // $size = $size;
        // $filters = $filters;

        $params = [$lang, $user_token, $eventID, $offset,$size,$filters];
        $outParams = ['@gridcount'];
        return ExecuteStoredProcedureTrait::executeOutParams('event_company_get_all',$params,$outParams);
    }

    public function eventInfoGetByID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');

        $params = [$lang, $user_token, $event_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('event_info_get_by_id',$params, $outParams);
    }

    public function eventAdminEventsGetAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];

        $outParams = ['@size'];
        return ExecuteStoredProcedureTrait::executeOutParams('event_admin_events_get_all',$params, $outParams);
    }

    public function getAllParticipants(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $eventID = $request->input('eventID');
        $offset = $request->input('offset');
        $size = $request->input('size');
        $filters = $request->input('filters');
        // $lang = $lang;
        // $user_token = $token;
        // $eventID = $eventId;
        // $offset = $offset;
        // $size = $size;
        // $filters = $filters;

        $params = [$lang, $user_token, $eventID, $offset,$size,$filters];
        $outParams = ['@gridcount'];
        return ExecuteStoredProcedureTrait::executeOutParams('event_participant_get_all',$params,$outParams);
    }

    public function eventAdminGetAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];
        $outParams = ['@size'];

        return ExecuteStoredProcedureTrait::executeOutParams('event_admin_get_all',$params, $outParams);
    }

    public function eventAdminGetByEventID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');

        $params = [$lang, $user_token, $event_id];
        $outParams = ['@can_edit','@size'];

        return ExecuteStoredProcedureTrait::executeOutParams('event_admin_get_by_event_id',$params, $outParams);
    }

    public function eventAdminAdd(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');
        $event_admin_id = $request->input('event_admin_id');

        $params = [$lang, $user_token, $event_id, $event_admin_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('event_admin_add',$params, $outParams);
    }

    public function eventAdminRemove(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');
        $event_admin_id = $request->input('event_admin_id');

        $params = [$lang, $user_token, $event_id, $event_admin_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('event_admin_remove',$params, $outParams);
    }

    public function securityOfficerGetAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];
        $outParams = ['@size'];

        return ExecuteStoredProcedureTrait::executeOutParams('security_officer_get_all',$params, $outParams);
    }

    public function securityOfficerGetByEventID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');

        $params = [$lang, $user_token, $event_id];
        $outParams = ['@can_edit','@size'];

        return ExecuteStoredProcedureTrait::executeOutParams('security_officer_get_by_event_id',$params, $outParams);
    }

    public function securityOfficerAdd(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');
        $security_officer_id = $request->input('security_officer_id');

        $params = [$lang, $user_token, $event_id, $security_officer_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('security_officer_add',$params, $outParams);
    }

    public function securityOfficerRemove(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');
        $security_officer_id = $request->input('security_officer_id');

        $params = [$lang, $user_token, $event_id, $security_officer_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('security_officer_remove',$params, $outParams);
    }

    public function accreditationCategoryGetAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];
        $outParams = ['@size'];

        return ExecuteStoredProcedureTrait::executeOutParams('event_accreditation_category_get_all',$params, $outParams);
    }

    public function accreditationCategoryGetByEventID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');

        $params = [$lang, $user_token, $event_id];
        $outParams = ['@can_edit','@size'];

        return ExecuteStoredProcedureTrait::executeOutParams('event_accreditation_category_get_by_event_id',$params, $outParams);
    }

    public function accreditationCategoryAdd(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');
        $accreditation_category_id = $request->input('accreditation_category_id');

        $params = [$lang, $user_token, $event_id, $accreditation_category_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('event_accreditation_category_add',$params, $outParams);
    }

    public function accreditationCategoryRemove(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');
        $accreditation_category_id = $request->input('accreditation_category_id');

        $params = [$lang, $user_token, $event_id, $accreditation_category_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('event_accreditation_category_remove',$params, $outParams);
    }

    public function securityCategoryGetAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];
        $outParams = ['@size'];

        return ExecuteStoredProcedureTrait::executeOutParams('event_security_category_get_all',$params, $outParams);
    }

    public function securityCategoryGetByEventID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');

        $params = [$lang, $user_token, $event_id];
        $outParams = ['@can_edit','@size'];

        return ExecuteStoredProcedureTrait::executeOutParams('event_security_category_get_by_event_id',$params, $outParams);
    }

    public function securityCategoryAdd(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');
        $security_category_id = $request->input('security_category_id');

        $params = [$lang, $user_token, $event_id, $security_category_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('event_security_category_add',$params, $outParams);
    }

    public function securityCategoryRemove(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');
        $security_category_id = $request->input('security_category_id');

        $params = [$lang, $user_token, $event_id, $security_category_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('event_security_category_remove',$params, $outParams);
    }
}
