<?php

namespace App\Http\Controllers;

use App\Http\Traits\ExecuteStoredProcedureTrait;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getByID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');

        $params = [$lang, $user_token, $event_id];

        $event_details = ExecuteStoredProcedureTrait::execute1('event_get_by_id',$params);

//        var_dump($event_details['data'][0]);
//        exit;
        if ($event_details['errCode'] == 1 ){
            $event_id = $request->input('event_id');

            $params = [ $event_id];

            $event_ea_so_sc = ExecuteStoredProcedureTrait::execute1('event_ea_so_sc_get_all',$params);

//            var_dump(json_encode($event_ea_so_sc));
//            exit();

            $returnedJson['errCode'] = $event_details['errCode'];
            $returnedJson['errMsg'] = $event_details['errMsg'];
            $returnedJson['data']['data']['details'] = $event_details['data'][0];
            $returnedJson['data']['data']['event_list'] = $this->parsEventDetailsData($event_ea_so_sc);

            return $returnedJson;

        }
        else{
            return $event_details;
        }

    }

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

        $event_name = $request->input('event_name');
        $size = $request->input('size');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $acc_start_date = $request->input('acc_start_date');
        $acc_end_date = $request->input('acc_end_date');
        $organizer = $request->input('organizer');
        $owner = $request->input('owner');
        $event_type = $request->input('event_type');
        $registration_form = $request->input('registration_form');
        $location = $request->input('location');
        $status = $request->input('status');
        $event_admin = $request->input('event_admin');
        $security_officer = $request->input('security_officer');
        $security_category = $request->input('security_category');
        $approval_option = $request->input('approval_option');

        $params = [$lang, $user_token, $event_name, $size,  $start_date, $end_date, $acc_start_date,
            $acc_end_date, $organizer, $owner, $event_type,
            $registration_form, $location, $status, $event_admin,
            $security_officer, $security_category, $approval_option];
        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('event_add',$params, $outParams);
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

    private function parsEventDetailsData($data){
        $returnedJson = [];
        $tempData = $data["data"];
        $listType = [];

        $listTypeKey = 'listType';
        $idKey = 'id';
        $nameKey = 'name';


        for($i = 0; $i < count($tempData);$i++) {
            $t = $tempData[$i];

            $listTypeName = $t[$listTypeKey];

            if (!array_key_exists($listTypeName, $listType)){
                $listType[$listTypeName] = [];
            }

            $typeItem = ['name' => $t[$nameKey]];


            array_push($listType[$listTypeName] , $typeItem);
        }

        $returnedJson = $listType;

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

    public function infoGetByID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');

        $params = [$lang, $user_token, $event_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('event_info_get_by_id',$params, $outParams);
    }

    public function complete(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');

        $params = [$lang, $user_token, $event_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('event_complete',$params, $outParams);
    }

    public function changeLogo(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');
        $logo_name = $request->input('logo_name');

        $params = [$lang, $user_token, $event_id, $logo_name];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('event_change_logo',$params, $outParams);
    }

    public function eventAdminEventsGetAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];

        $outParams = ['@size'];
        return ExecuteStoredProcedureTrait::executeOutParams('event_admin_events_get_all',$params, $outParams);
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

    public function getAllParticipants(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $eventID = $request->input('eventID');
        $offset = $request->input('offset');
        $size = $request->input('size');
        $filters = $request->input('filters');

        $params = [$lang, $user_token, $eventID, $offset,$size,$filters];
        $outParams = ['@gridcount'];
        return ExecuteStoredProcedureTrait::executeOutParams('event_participant_get_all',$params,$outParams);
    }
}
