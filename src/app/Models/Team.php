<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teamUsers()
    {
        return $this->hasMany(TeamUser::class);
    }

    public function scopeFilter($query, $filter)
    {
        return $query->when($filter != '', function($query) use ($filter){
            return $query->where('name', "%{$filter}%");
        });
    }
}
