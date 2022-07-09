<?php

namespace App\Http\Controllers;

use App\Http\Traits\ExecuteStoredProcedureTrait;
use Illuminate\Http\Request;

class RegistrationFormFieldElementController extends Controller
{
    public function getByID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $registration_form_field_element_id = $request->input('registration_form_field_element_id');

        $params = [$lang, $user_token, $registration_form_field_element_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('registration_form_field_element_get_by_id',$params, $outParams);
    }

    public function getAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $registration_form_field_id = $request->input('registration_form_field_id');

        $params = [$lang, $user_token, $registration_form_field_id];

        $outParams = ['@registration_form_id','@registration_form_name','@registration_form_field_name','@is_locked','@size'];
        return ExecuteStoredProcedureTrait::executeOutParams('registration_form_field_element_get_all',$params, $outParams);
    }

    public function create(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $registration_form_field_id = $request->input('registration_form_field_id');
        $value_ar = $request->input('value_ar');
        $value_en = $request->input('value_en');
        $element_order = $request->input('element_order');

        $params = [$lang, $user_token, $registration_form_field_id, $value_ar, $value_en, $element_order];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('registration_form_field_element_add',$params, $outParams);
    }

    public function update(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $registration_form_field_element_id = $request->input('registration_form_field_element_id');
        $value_ar = $request->input('value_ar');
        $value_en = $request->input('value_en');
        $element_order = $request->input('element_order');

        $params = [$lang, $user_token, $registration_form_field_element_id, $value_ar, $value_en, $element_order];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('registration_form_field_element_update',$params, $outParams);
    }

    public function delete(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $registration_form_field_element_id = $request->input('registration_form_field_element_id');

        $params = [$lang, $user_token, $registration_form_field_element_id];
        $outParams = [];

        return ExecuteStoredProcedureTrait::executeOutParams('registration_form_field_element_delete',$params, $outParams);
    }
}
