<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function funerals() {
        return $this->belongsTo(Funeral::class, 'funeral_id', 'id');
    }

}
