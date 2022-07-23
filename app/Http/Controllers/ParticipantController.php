<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ExecuteStoredProcedureTrait;

class ParticipantController extends Controller
{
    public function participantAdd(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');
        $company_id = $request->input('company_id');
        $participant_data = json_encode($request->input('participant_data')) ;

        $params = [$lang, $user_token, $event_id, $company_id, $participant_data];
        $outParams = [];

//        var_dump($params);
//        exit;

        return ExecuteStoredProcedureTrait::executeOutParams('participant_add',$params,$outParams);
    }

    public function rejectByEventAdmin(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $staff_id = $request->input('staff_id');
        $params = [$lang, $user_token, $staff_id];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('participant_reject_by_event_admin',$params,$outParams);
    }

    public function rejectToCorrectByEventAdmin(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $staff_id = $request->input('staff_id');
        $reason = $request->input('reason');
        $params = [$lang, $user_token, $staff_id,$reason];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('participant_reject_to_correct_by_event_admin',$params,$outParams);
    }

    public function approveByEventAdmin(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $staff_id = $request->input('staff_id');
        $params = [$lang, $user_token, $staff_id];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('participant_approve_by_event_admin',$params,$outParams);
    }

    public function sendParticipationRequest(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $staff_id = $request->input('staff_id');
        $params = [$lang, $user_token, $staff_id];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('participant_send_participation_request',$params,$outParams);
    }
}
