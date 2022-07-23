<?php

namespace App\Http\Controllers;

use App\Http\Traits\ExecuteStoredProcedureTrait;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        //
    }

    public function login(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $email = $request->input('email');
        $password = $request->input('password');

        $params = [$lang, $email, $password];

        $outParams = ['@token', '@user_name'];
        return ExecuteStoredProcedureTrait::executeOutParams('login',$params, $outParams);
    }

    public function getAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];

        $outParams = ['@size'];
        return ExecuteStoredProcedureTrait::executeOutParams('user_get_all',$params, $outParams);
    }

    public function getByID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $user_id = $request->input('user_id');

        $params = [$lang, $user_token, $user_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('user_get_by_id', $params, $outParams);
    }

    public function create(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $user_name = $request->input('user_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $role_id = $request->input('role_id');

        $params = [$lang, $user_token, $user_name, $email, $password, $role_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('user_add', $params, $outParams);
    }

    public function enable(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $user_id = $request->input('user_id');

        $params = [$lang, $user_token, $user_id, 1];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('user_change_status', $params, $outParams);
    }

    public function disable(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $user_id = $request->input('user_id');

        $params = [$lang, $user_token, $user_id, 0];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('user_change_status',$params, $outParams);
    }

    public function passwordReset(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $user_id = $request->input('user_id');
        $new_password = $request->input('new_password');

        $params = [$lang, $user_token, $user_id, $new_password];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('user_reset_password',$params, $outParams);
    }

    public function update(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $user_id = $request->input('user_id');
        $user_name = $request->input('user_name');
        $email = $request->input('email');
        $role_id = $request->input('role_id');

        $params = [$lang, $user_token, $user_id, $user_name, $email, $role_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('user_update',$params, $outParams);
    }

    public function userPermissionsGetAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $user_id = $request->input('user_id');

        $params = [$lang, $user_token, $user_id];
        $outParams = ['@user_name','@size'];
        return ExecuteStoredProcedureTrait::executeOutParams('user_permissions_get_all',$params, $outParams);
    }

    public function userPermissionsUpdate(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $user_id = $request->input('user_id');
        $permission_ids = $request->input('permission_ids');

        $params = [$lang, $user_token, $user_id, $permission_ids];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('user_permissions_update',$params, $outParams);
    }
}
