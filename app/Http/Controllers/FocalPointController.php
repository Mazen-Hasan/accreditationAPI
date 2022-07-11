<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ExecuteStoredProcedureTrait;
use Illuminate\Support\Facades\Hash;

class FocalPointController extends Controller
{
    public function create(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $entry_type  = $request->input('entry_type');
        $focal_point_id  = $request->input('focal_point_id');
        $account_email  = $request->input('account_email');
        $account_name  = $request->input('account_name');
        $password  = $request->input('password');
        $name  = $request->input('name');
        $last_name  = $request->input('last_name');
        $telephone  = $request->input('telephone');
        $mobile  = $request->input('mobile');
        $hashed_password  = Hash::make($request->input('password'));
        $status  = $request->input('status');
        $params = [$lang, $user_token ,$entry_type,$focal_point_id,$account_email,$account_name,$password,$name,$last_name,$telephone,$mobile,$hashed_password,$status];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('focal_point_add',$params, $outParams);
    }
}
