<?php

namespace App\Transformers;

use App\User;

use App\TeamDocuments;

use League\Fractal\TransformerAbstract;

use Illuminate\Support\Facades\DB;

class TeamDocumentTransformer extends TransformerAbstract
{
	public function transform(TeamDocuments $teamDocuments)
	{
		return [
			'Team Name'				=> DB::table('users')
				->where('id', $teamDocuments->team_id)
				->value('team_name'), 
			'Active Student Proof'	=> asset('storage/active-student-proofs/' . $teamDocuments->active_student_proof),
			'Payment Proof'			=> is_null($teamDocuments->payment_proof) ? null : asset('storage/payment-proofs/' . $teamDocuments->payment_proof),
			'Proposal'				=> is_null($teamDocuments->proposal) ? null : asset('storage/proposals/' . $teamDocuments->proposal), 
			'Last File Upload'		=> $teamDocuments->updated_at->diffForHumans(), 
		];
	}
}