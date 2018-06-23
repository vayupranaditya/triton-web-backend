<?php

use Illuminate\Http\Request;

Route::get('users', 'UserController@users')->middleware('cors');
Route::get('documents', 'DocumentController@documents');
Route::get('auth/is-team-name-available/{users}', 'AuthController@isTeamNameAvailable');
Route::post('document/payment-proof/{teamDocuments}', 'DocumentController@paymentProof')->middleware('auth:api');
Route::post('document/proposal/{teamDocuments}', 'DocumentController@proposal')->middleware('auth:api');
Route::post('auth/register', ['middleware' => 'cors', 'AuthController@register']);
