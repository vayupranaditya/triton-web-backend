<?php

use Illuminate\Http\Request;

Route::get('users', 'UserController@users');
Route::post('auth/register', 'AuthController@register');