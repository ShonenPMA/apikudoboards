<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kudoboards extends Model
{
    use HasFactory;

    public function kudoable()
    {
        return $this->morphTo();
    }

    public function kudos()
    {
        return $this->hasMany(Kudo::class, 'kudoboard_id');
    }
}
