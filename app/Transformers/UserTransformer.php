<?php

namespace App\Transformers;

use App\User;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	public function transform(User $user)
	{
		return [
			'Team Name' 	=> $user->team_name,
			'Institution'	=> $user->institution,
			'Email'			=> $user->email,
			'Team Member 1'	=> $user->team_member_1,
			'Team Member 2'	=> $user->team_member_2,
			'Team Member 3'	=> $user->team_member_3,
			'Team Member 4'	=> $user->team_member_4,
		];
	}
}