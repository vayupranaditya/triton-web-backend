<?php

use Illuminate\Http\Request;

Route::get('users', 'UserController@users');
ROute::get('documents', 'DocumentController@documents');
Route::post('document/payment-proof/{teamDocuments}', 'DocumentController@paymentProof')->middleware('auth:api');
Route::post('document/proposal/{teamDocuments}', 'DocumentController@proposal')->middleware('auth:api');
Route::post('auth/register', 'AuthController@register');