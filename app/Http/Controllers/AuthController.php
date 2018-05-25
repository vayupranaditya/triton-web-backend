<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\TeamDocuments;

use App\Transformers\UserTransformer;

use Illuminate\Support\Facades\DB;

use Auth;

class AuthController extends Controller
{
    public function register(Request $request, User $user, TeamDocuments $teamDocuments)
    {
    	$this->validate($request, [
    		'team_name'		        => 'required|unique:users|max:50',
    		'email'			        => 'required|email|unique:users',
    		'institution'	        => 'required',
    		'team_member_1'	        => 'required',
    		'team_member_2'	        => 'required',
    		'team_member_3'	        => 'required',
    		'team_member_4'         => 'nullable',
            'active_student_proof'  => 'required|file|mimes:rar,zip',
    	]);

    	$user = $user->create([
    		'team_name'		        => $request->team_name,
    		'email'			        => $request->email,
    		'institution'	        => $request->institution,
    		'team_member_1'	        => $request->team_member_1,
    		'team_member_2'	        => $request->team_member_2,
    		'team_member_3'	        => $request->team_member_3,
    		'team_member_4'	        => $request->team_member_4,
    	]);

        $active_student_proof_file_name = bcrypt($request->team_name) . 
            '.' . 
            $request->active_student_proof->getClientOriginalExtension();

        $request->active_student_proof->storeAs('active_student_proof', $active_student_proof_file_name);

        $teamDocument = $teamDocuments->create([
            'team_id'               => DB::table('users')
                ->where('team_name',$request->team_name)
                ->pluck('id')
                [0],
            'active_student_proof'  => $active_student_proof_file_name,
        ]);

    	$response = fractal()
    		->item($user)
    		->transformWith(new UserTransformer)
    		->toArray();

    	return response()->json($response, 201);
    }
}
