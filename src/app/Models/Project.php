<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projectUsers()
    {
        return $this->hasMany(ProjectUser::class);
    }

    public function scopeFilter($query, $filter)
    {
        return $query->when($filter != '', function($query) use ($filter){
            return $query->where('name', "%{$filter}%");
        });
    }

    public function kudoboard()
    {
        return $this->morphOne(Kudoboards::class, 'kudoable');
    }
}
