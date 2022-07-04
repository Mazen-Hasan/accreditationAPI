<?php

namespace App\Http\Controllers;

use App\Http\Traits\ExecuteStoredProcedureTrait;
use Illuminate\Http\Request;

class RegistrationFormController extends Controller
{
    public function getByID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $id = $request->input('id');

        $params = [$lang, $user_token, $id];
        return ExecuteStoredProcedureTrait::execute('registration_form_get_by_id',$params);
    }

    public function getAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];

        $outParams = ['@size'];
        return ExecuteStoredProcedureTrait::executeOutParams('registration_form_get_all',$params, $outParams);
    }

    public function create(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $registration_form_name = $request->input('name');
        $status = $request->input('status');

        $params = [$lang, $user_token, $registration_form_name, $status];
        return ExecuteStoredProcedureTrait::execute('registration_form_add',$params);
    }

    public function enable(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $id = $request->input('id');

        $params = [$lang, $user_token, $id, 1];
        return ExecuteStoredProcedureTrait::execute('registration_form_change_status',$params);
    }

    public function disable(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $id = $request->input('id');

        $params = [$lang, $user_token, $id, 0];
        return ExecuteStoredProcedureTrait::execute('registration_form_change_status',$params);
    }

    public function update(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $id = $request->input('id');
        $name = $request->input('name');
        $status = $request->input('status');

        $params = [$lang, $user_token, $id, $name, $status];
        return ExecuteStoredProcedureTrait::execute('registration_form_update',$params);
    }

    public function lock(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $id = $request->input('id');

        $params = [$lang, $user_token, $id, 1];
        return ExecuteStoredProcedureTrait::execute('registration_form_change_lock',$params);
    }

    public function unlock(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $id = $request->input('id');

        $params = [$lang, $user_token, $id, 0];
        return ExecuteStoredProcedureTrait::execute('registration_form_change_lock',$params);
    }
}
