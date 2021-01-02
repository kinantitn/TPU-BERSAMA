<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funeral extends Model
{
    protected $guarded = [];

    public function ratings() {
        return $this->hasMany(RatingFuneral::class, 'funeral_id', 'id');
    }

}
