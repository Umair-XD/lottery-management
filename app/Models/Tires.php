<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tires extends Model
{
    protected $fillable = ['name', 'price', 'draw_date'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'tires_id');
    }
}
