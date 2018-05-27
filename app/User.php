<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'team_name', 
        'email', 
        'institution',
        'team_member_1', 
        'team_member_2', 
        'team_member_3', 
        'team_member_4', 
        'api_token', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function document()
    {
        return $this->hasOne(TeamDocument::class);
    }

    public function ownsDocument(TeamDocument $teamDocument)
    {
        return auth()->id == $teamDocument->user->id;
    }
}
