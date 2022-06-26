<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ExecuteStoredProcedureTrait;

class AccreditationCategoryController extends Controller
{
    //
    public function getAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token ];

        $outParams = ['@size'];
        return ExecuteStoredProcedureTrait::executeOutParams('accreditation_category_get_all',$params, $outParams);
    }

    public function create(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $name  = $request->input('name');
        $status  = $request->input('status');
        $params = [$lang, $user_token ,$name,$status];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('accreditation_category_add',$params, $outParams);
    }

    public function edit(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $accreditation_category_id = $request->input('accreditation_category_id');
        $name  = $request->input('name');
        $status  = $request->input('status');
        $params = [$lang, $user_token ,$accreditation_category_id,$name,$status];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('accreditation_category_update',$params, $outParams);
    }

    public function enable(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $accreditation_category_id = $request->input('accreditation_category_id');

        $params = [$lang, $user_token, $accreditation_category_id, 1];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('accreditation_category_change_status',$params,$outParams);
    }

    public function disable(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $accreditation_category_id = $request->input('accreditation_category_id');

        $params = [$lang, $user_token, $accreditation_category_id, 0];

        $outParams = [];
        return ExecuteStoredProcedureTrait::execute('accreditation_category_change_status',$params,$outParams);
    }
}
