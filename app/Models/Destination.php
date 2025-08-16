<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Destination extends Model
{
    use HasUuids;

    public function missions() {
        return $this -> hasMany(Mission::class);
    }

}
