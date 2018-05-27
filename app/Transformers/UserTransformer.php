<?php

namespace App\Transformers;

use App\User;

use League\Fractal\TransformerAbstract;

use Illuminate\Support\Facades\DB;

class UserTransformer extends TransformerAbstract
{
	public function transform(User $user)
	{
		return [
			'Team ID'				=> $user->id, 
			'Team Name' 			=> $user->team_name,
			'Institution'			=> $user->institution,
			'Email'					=> $user->email,
			'Team Member 1'			=> $user->team_member_1,
			'Team Member 2'			=> $user->team_member_2,
			'Team Member 3'			=> $user->team_member_3,
			'Team Member 4'			=> $user->team_member_4,
			'Active Student Proof'	=> asset('storage/active-student-proofs/' . DB::table('team_documents')
				->where('team_id', $user->id)
				->value('active_student_proof')),
		];
	}
}