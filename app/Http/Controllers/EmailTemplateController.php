<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ExecuteStoredProcedureTrait;

class EmailTemplateController extends Controller
{
    //
    public function getAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token ];

        $outParams = ['@size'];
        return ExecuteStoredProcedureTrait::executeOutParams('email_template_get_all',$params, $outParams);
    }

    public function getByID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $email_template_id = $request->input('email_template_id');

        $params = [$lang, $user_token, $email_template_id];
        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('email_template_get_by_id',$params, $outParams);
    }

    public function edit(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $email_template_id = $request->input('email_template_id');
        $subject  = $request->input('subject');
        $content  = $request->input('content');
        $params = [$lang, $user_token ,$email_template_id,$subject,$content];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('email_template_update',$params, $outParams);
    }
}
