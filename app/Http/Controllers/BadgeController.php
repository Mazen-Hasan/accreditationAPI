<?php

namespace App\Http\Controllers;

use App\Http\Traits\ExecuteStoredProcedureTrait;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function getByID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $badge_id = $request->input('badge_id');

        $params = [$lang, $user_token, $badge_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('badge_get_by_id',$params, $outParams);
    }

    public function getAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];
        $outParams = ['@size'];

        return ExecuteStoredProcedureTrait::executeOutParams('badge_get_all',$params, $outParams);
    }

    public function create(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $template_id = $request->input('template_id');
        $width = $request->input('width');
        $height = $request->input('height');
        $bg_color = $request->input('bg_color');
        $default_bg_image = $request->input('default_bg_image');

        $params = [$lang, $user_token, $template_id, $width, $height, $bg_color, $default_bg_image];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('badge_add',$params, $outParams);
    }

    public function update(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $badge_id = $request->input('badge_id');
        $width = $request->input('width');
        $height = $request->input('height');
        $bg_color = $request->input('bg_color');
        $default_bg_image = $request->input('default_bg_image');
        $badge_data = $request->input('badge_data');
        $badge_size = $request->input('badge_size');

        $params = [$lang, $user_token, $badge_id, $width, $height, $bg_color, $default_bg_image,$badge_data,$badge_size];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('badge_update',$params, $outParams);
    }

    public function lock(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $badge_id = $request->input('badge_id');

        $params = [$lang, $user_token, $badge_id, 1];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('badge_change_lock',$params, $outParams);
    }

    public function unlock(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $badge_id = $request->input('badge_id');

        $params = [$lang, $user_token, $badge_id, 0];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('badge_change_lock',$params, $outParams);
    }

    public function getAvailableRegistrationForm(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');

        $params = [$lang, $user_token];
        $outParams = ['@size'];

        return ExecuteStoredProcedureTrait::executeOutParams('badge_available_registration_form_get_all',$params, $outParams);
    }

    public function createFromDesigner(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $template_id  = $request->input('template_id');
        $badge_data  = $request->input('badge_data');
        $width  = $request->input('width');
        $height = $request->input('height');
        $params = [$lang, $user_token ,$template_id,$badge_data,$width,$height];

        $outParams = [];
        return ExecuteStoredProcedureTrait::executeOutParams('template_badge_add',$params, $outParams);
    }
}
