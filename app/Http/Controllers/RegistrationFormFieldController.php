<?php

namespace App\Http\Controllers;

use App\Http\Traits\ExecuteStoredProcedureTrait;
use Illuminate\Http\Request;

class RegistrationFormFieldController extends Controller
{
    public function getByID(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $registration_form_field_id = $request->input('registration_form_field_id');

        $params = [$lang, $user_token, $registration_form_field_id];
        return ExecuteStoredProcedureTrait::execute('registration_form_field_get_by_id',$params);
    }

    public function getAll(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $registration_form_id = $request->input('registration_form_id');

        $params = [$lang, $user_token, $registration_form_id];
        return ExecuteStoredProcedureTrait::execute('registration_form_field_get_all',$params);
    }

    public function create(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $registration_form_id = $request->input('registration_form_id');
        $label_ar = $request->input('label_ar');
        $label_en = $request->input('label_en');
        $field_type_id = $request->input('field_type_id');
        $min_char = $request->input('min_char');
        $max_char = $request->input('max_char');
        $order = $request->input('order');
        $is_mandatory = $request->input('is_mandatory');

        $params = [$lang, $user_token, $registration_form_id, $label_ar, $label_en, $field_type_id, $min_char, $max_char, $order, $is_mandatory];
        return ExecuteStoredProcedureTrait::execute('registration_form_field_add',$params);
    }

    public function update(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $registration_form_field_id = $request->input('registration_form_field_id');
        $registration_form_field_name = $request->input('registration_form_field_name');
        $registration_form_field_status = $request->input('status');

        $params = [$lang, $user_token, $registration_form_field_id, $registration_form_field_name, $registration_form_field_status];
        return ExecuteStoredProcedureTrait::execute('registration_form_field_update',$params);
    }

    public function remove(Request $request)
    {
        $lang = $request->header('Accept-Language');
        $user_token = $request->header('user_token');
        $registration_form_field_id = $request->input('registration_form_field_id');

        $params = [$lang, $user_token, $registration_form_field_id, 0];
        return ExecuteStoredProcedureTrait::execute('registration_form_field_remove',$params);
    }
}
