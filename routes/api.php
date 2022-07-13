<?php

use App\Http\Controllers\BadgeController;
use App\Http\Controllers\eventController;
use App\Http\Controllers\RegistrationFormController;
use App\Http\Controllers\RegistrationFormFieldController;
use App\Http\Controllers\RegistrationFormFieldElementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\userController;
use App\Http\Controllers\CompanyCategoryController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\SecurityCategoryController;
use App\Http\Controllers\AccreditationCategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\FocalPointController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\venueController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'venue','as'=>'venue/'], function(){
    Route::post('getByID', [venueController::class,'getByID']);

    Route::post('create', [venueController::class,'create']);

    Route::post('enable', [venueController::class,'enable']);

    Route::post('disable', [venueController::class,'disable']);

    Route::post('update', [venueController::class,'update']);
});

Route::group(['prefix'=>'user','as'=>'user/'], function(){
    Route::post('getByID', [userController::class,'getByID']);

    Route::post('create', [userController::class,'create']);

    Route::post('enable', [userController::class,'enable']);

    Route::post('disable', [userController::class,'disable']);

    Route::post('login', [userController::class,'login']);

    Route::post('permissions/getAll', [userController::class,'userPermissionsGetAll']);

    Route::post('permissions/update', [userController::class,'userPermissionsUpdate']);
});

Route::group(['prefix'=>'registrationForm','as'=>'registrationForm/'], function(){
    Route::post('getByID', [RegistrationFormController::class,'getByID']);

    Route::post('getAll', [RegistrationFormController::class,'getAll']);

    Route::post('create', [RegistrationFormController::class,'create']);

    Route::post('enable', [RegistrationFormController::class,'enable']);

    Route::post('disable', [RegistrationFormController::class,'disable']);

    Route::post('lock', [RegistrationFormController::class,'lock']);

    Route::post('unlock', [RegistrationFormController::class,'unlock']);

    Route::post('update', [RegistrationFormController::class,'update']);
});

Route::group(['prefix'=>'registrationFormField','as'=>'registrationFormField/'], function(){
    Route::post('getByID', [RegistrationFormFieldController::class,'getByID']);

    Route::post('getAll', [RegistrationFormFieldController::class,'getAll']);

    Route::post('create', [RegistrationFormFieldController::class,'create']);

    Route::post('update', [RegistrationFormFieldController::class,'update']);

    Route::post('delete', [RegistrationFormFieldController::class,'delete']);

    Route::post('fieldTypeGetAll', [RegistrationFormFieldController::class,'fieldTypeGetAll']);
});

Route::group(['prefix'=>'registrationFormFieldElement','as'=>'registrationFormFieldElement/'], function(){
    Route::post('getByID', [RegistrationFormFieldElementController::class,'getByID']);

    Route::post('getAll', [RegistrationFormFieldElementController::class,'getAll']);

    Route::post('create', [RegistrationFormFieldElementController::class,'create']);

    Route::post('update', [RegistrationFormFieldElementController::class,'update']);

    Route::post('delete', [RegistrationFormFieldElementController::class,'delete']);
});

Route::group(['prefix'=>'badge','as'=>'badge/'], function(){
    Route::post('getByID', [BadgeController::class,'getByID']);

    Route::post('getAll', [BadgeController::class,'getAll']);

    Route::post('create', [BadgeController::class,'create']);

    Route::post('lock', [BadgeController::class,'lock']);

    Route::post('unlock', [BadgeController::class,'unlock']);

    Route::post('update', [BadgeController::class,'update']);

    Route::post('getAvailableRegistrationForm', [BadgeController::class,'getAvailableRegistrationForm']);
});

Route::group(['prefix'=>'role','as'=>'role/'], function(){
    Route::post('getByID', [RoleController::class,'getByID']);

    Route::post('getAll', [RoleController::class,'getAll']);

    Route::post('create', [RoleController::class,'create']);

    Route::post('enable', [RoleController::class,'enable']);

    Route::post('disable', [RoleController::class,'disable']);

    Route::post('update', [RoleController::class,'update']);

    Route::post('remove', [RoleController::class,'remove']);

    Route::post('permissions/getAll', [RoleController::class,'permissionsGetAll']);

    Route::post('permissions/update', [RoleController::class,'permissionsUpdate']);
});

Route::group(['prefix'=>'event','as'=>'event/'], function(){
    Route::post('getByID', [EventController::class,'getByID']);

    Route::post('create', [EventController::class,'create']);

    Route::post('enable', [EventController::class,'enable']);

    Route::post('disable', [EventController::class,'disable']);

    Route::post('getList', [EventController::class,'getList']);

    Route::post('getAll', [EventController::class,'getAll']);
    Route::post('getAllWithArchived', [EventController::class,'getAllWithArchived']);
    Route::post('eventAdminEventsGetAll', [EventController::class,'eventAdminEventsGetAll']);

    //Route::get('getAll/{token}/{lang}/{offset}/{size}/{filters}', [eventController::class,'getAll']);

    Route::get('test', [EventController::class,'test']);

    Route::group(['prefix'=>'company','as'=>'company/'], function(){
        // Route::post('getAll', function (Request $request){
        //     return 'test';
        //     });
        //Route::get('getAll/{token}/{lang}/{eventId}/{offset}/{size}/{filters}', [eventController::class,'getAllCompanies']);
        Route::post('getAll', [EventController::class,'getAllCompanies']);

    });

    Route::group(['prefix'=>'participant','as'=>'participant/'], function(){
        // Route::post('getAll', function (Request $request){
        //     return 'test';
        //     });
        //Route::get('getAll/{token}/{lang}/{eventId}/{offset}/{size}/{filters}', [eventController::class,'getAllCompanies']);
        Route::post('getAll', [EventController::class,'getAllParticipants']);
    });
});

Route::group(['prefix'=>'companyCategory','as'=>'companyCategory/'], function(){
    Route::post('getAll', [CompanyCategoryController::class,'getAll']);
    Route::post('create', [CompanyCategoryController::class,'create']);
    Route::post('edit', [CompanyCategoryController::class,'edit']);
    Route::post('enable', [CompanyCategoryController::class,'enable']);
    Route::post('disable', [CompanyCategoryController::class,'disable']);
    Route::post('getByID', [CompanyCategoryController::class,'getByID']);
});

Route::group(['prefix'=>'securityCategory','as'=>'securityCategory/'], function(){
    Route::post('getAll', [SecurityCategoryController::class,'getAll']);
    Route::post('create', [SecurityCategoryController::class,'create']);
    Route::post('edit', [SecurityCategoryController::class,'edit']);
    Route::post('enable', [SecurityCategoryController::class,'enable']);
    Route::post('disable', [SecurityCategoryController::class,'disable']);
    Route::post('getByID', [SecurityCategoryController::class,'getByID']);
});

Route::group(['prefix'=>'eventType','as'=>'eventType/'], function(){
    Route::post('getAll', [EventTypeController::class,'getAll']);
    Route::post('create', [EventTypeController::class,'create']);
    Route::post('edit', [EventTypeController::class,'edit']);
    Route::post('enable', [EventTypeController::class,'enable']);
    Route::post('disable', [EventTypeController::class,'disable']);
    Route::post('getByID', [EventTypeController::class,'getByID']);
});

Route::group(['prefix'=>'accreditationCategory','as'=>'accreditationCategory/'], function(){
    Route::post('getAll', [AccreditationCategoryController::class,'getAll']);
    Route::post('create', [AccreditationCategoryController::class,'create']);
    Route::post('edit', [AccreditationCategoryController::class,'edit']);
    Route::post('enable', [AccreditationCategoryController::class,'enable']);
    Route::post('disable', [AccreditationCategoryController::class,'disable']);
    Route::post('getByID', [AccreditationCategoryController::class,'getByID']);
});

Route::group(['prefix'=>'emailTemplate','as'=>'emailTemplate/'], function(){
    Route::post('getAll', [EmailTemplateController::class,'getAll']);
    // Route::post('create', [SecurityCategoryController::class,'create']);
    Route::post('edit', [EmailTemplateController::class,'edit']);
    // Route::post('enable', [SecurityCategoryController::class,'enable']);
    // Route::post('disable', [SecurityCategoryController::class,'disable']);
    Route::post('getByID', [EmailTemplateController::class,'getByID']);
});

Route::group(['prefix'=>'company','as'=>'company/'], function(){
    Route::post('invite', [CompanyController::class,'invite']);

    Route::post('create', [CompanyController::class,'create']);

    Route::group(['prefix'=>'participant','as'=>'participant/'], function(){
        Route::post('getAll', [CompanyController::class,'getAllParticipants']);
    });

    Route::group(['prefix'=>'city','as'=>'city/'], function(){
        Route::post('getAll', [CompanyController::class,'getAllCity']);
    });

    Route::post('getList', [CompanyController::class,'getList']);
});

Route::group(['prefix'=>'participant','as'=>'participant/'], function(){
    Route::post('rejectByEventAdmin', [ParticipantController::class,'rejectByEventAdmin']);

    Route::post('rejectToCorrectByEventAdmin', [ParticipantController::class,'rejectToCorrectByEventAdmin']);

    Route::post('approveByEventAdmin', [ParticipantController::class,'approveByEventAdmin']);

    
});

Route::group(['prefix'=>'focalPoint','as'=>'focalPoint/'], function(){
    Route::post('create', [FocalPointController::class,'create']);

    Route::post('getByEmail', [FocalPointController::class,'getByEmail']);
});



Route::get('/test', function (Request $request){
    return 'test';
});

Route::middleware('auth:sanctum')->get('/userController', function (Request $request) {
    return $request->user();
});
