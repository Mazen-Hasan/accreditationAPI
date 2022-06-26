<?php

namespace App\Http\Controllers;

use App\Http\Traits\ExecuteStoredProcedureTrait;
use Illuminate\Http\Request;

class CompanyCategoryController extends Controller
{
    public function getAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token ];

        $outParams = ['@size'];
        return ExecuteStoredProcedureTrait::executeOutParams('company_category_get_all',$params, $outParams);
    }

    public function create(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $name  = $request->input('name');
        $status  = $request->input('status');
        $params = [$lang, $user_token ,$name,$status];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('company_category_add',$params, $outParams);
    }

    public function edit(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $company_category_id = $request->input('company_category_id');
        $name  = $request->input('name');
        $status  = $request->input('status');
        $params = [$lang, $user_token ,$company_category_id,$name,$status];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('company_category_update',$params, $outParams);
    }

    public function enable(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $company_category_id = $request->input('company_category_id');

        $params = [$lang, $user_token, $company_category_id, 1];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('company_category_change_status',$params,$outParams);
    }

    public function disable(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $company_category_id = $request->input('company_category_id');

        $params = [$lang, $user_token, $company_category_id, 0];

        $outParams = [];
        return ExecuteStoredProcedureTrait::execute('company_category_change_status',$params,$outParams);
    }
}
