<?php

namespace App\Http\Controllers;

use App\Http\Traits\ExecuteStoredProcedureTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getByID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $role_id = $request->input('role_id');

        $params = [$lang, $user_token, $role_id];
        return ExecuteStoredProcedureTrait::execute('role_get_by_id',$params);
    }

    public function getAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];

        $outParams = ['@size'];
        return ExecuteStoredProcedureTrait::executeOutParams('role_get_all',$params, $outParams);
    }

    public function create(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $name = $request->input('name');
        $status = $request->input('status');

        $params = [$lang, $user_token, $name, $status];
        return ExecuteStoredProcedureTrait::execute('role_add',$params);
    }

    public function update(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $role_id = $request->input('role_id');
        $name = $request->input('name');
        $status = $request->input('status');

        $params = [$lang, $user_token, $role_id, $name, $status];
        return ExecuteStoredProcedureTrait::execute('role_update',$params);
    }

    public function enable(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $role_id = $request->input('role_id');

        $params = [$lang, $user_token, $role_id, 1];
        return ExecuteStoredProcedureTrait::execute('role_change_status',$params);
    }

    public function disable(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $role_id = $request->input('role_id');

        $params = [$lang, $user_token, $role_id, 0];
        return ExecuteStoredProcedureTrait::execute('role_change_status',$params);
    }

    public function remove(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $role_id = $request->input('role_id');

        $params = [$lang, $user_token, $role_id];
        return ExecuteStoredProcedureTrait::execute('role_remove',$params);
    }

    public function permissionsGetAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $role_id = $request->input('role_id');

        $params = [$lang, $user_token, $role_id];

        $outParams = ['@role_name','@size'];
        return ExecuteStoredProcedureTrait::executeOutParams('role_permissions_get_all',$params, $outParams);
    }

    public function permissionsUpdate(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $role_id = $request->input('role_id');
        $permission_ids = $request->input('permission_ids');

        $params = [$lang, $user_token, $role_id, $permission_ids];
        return ExecuteStoredProcedureTrait::execute('role_permissions_update',$params);
    }
}
