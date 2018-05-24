<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TeamDocuments extends Model
{
	// protected $table = 'team_documents';
	
    protected $fillable = [
    	'team_id', 
    	'active_student_proof', 
    	'payment_proof', 
    	'proposal',
    ];

    public function team()
    {
    	return $this->belongsTo(User::class);
    }
}
