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

    public function getByID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $venue_id = $request->input('venue_id');

        $params = [$lang, $user_token, $venue_id];
        //return ExecuteStoredProcedureTrait::execute('venue_get_by_id',$params);
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

    public function userPermissionsGetAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $user_id = $request->input('user_id');

        $params = [$lang, $user_token, $user_id];
        return ExecuteStoredProcedureTrait::execute('user_permissions_get_all',$params);
    }

    public function userPermissionsUpdate(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $user_id = $request->input('user_id');
        $permission_ids = $request->input('permission_ids');

        $params = [$lang, $user_token, $user_id, $permission_ids];
        return ExecuteStoredProcedureTrait::execute('user_permissions_update',$params);
    }
}
