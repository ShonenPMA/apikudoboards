<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public  function projectUsers()
    {
        return $this->hasMany(ProjectUser::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function teamUsers()
    {
        return $this->hasMany(TeamUser::class);
    }

    public function kudoboards()
    {
        return $this->morphMany(Kudoboards::class, 'kudoable');
    }

    public function getAllKudoboardsAttribute()
    {
        $own_kudoboards = $this->kudoboards;

        $project_kudoboards =$this->projects->map(function($project){
            return $project->kudoboard;
        });

        $team_kudoboards = $this->teams->map(function($project){
            return $project->kudoboard;
        });

        $total_kudoboards = $own_kudoboards
            ->merge($project_kudoboards)
            ->merge($team_kudoboards);
        
        return $total_kudoboards;
    }
 }
