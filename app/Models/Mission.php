<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Mission extends Model
{
    use HasUuids;

    protected $fillable = ["captain", "destination_id"];

    public function destination() {
        return $this -> belongsTo(Destination::class);
    }
}
