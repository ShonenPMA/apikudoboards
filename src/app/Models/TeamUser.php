<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function scopeFilter($query, $filter)
    {
        return $query->when($filter != '', function($query) use ($filter){
            return $query->whereRelation('user','name', "%{$filter}%");
        });
    }
}
