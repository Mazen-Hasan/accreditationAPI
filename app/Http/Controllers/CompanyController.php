<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ExecuteStoredProcedureTrait;

class CompanyController extends Controller
{
    public function invite(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $event_id = $request->input('event_id');
        $company_id = $request->input('company_id');
        $params = [$lang, $user_token, $event_id, $company_id];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('company_invite',$params,$outParams);
    }
}
