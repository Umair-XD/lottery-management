<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'ticket_number',
        'tires_id',
        'status',
    ];

    /**
     * A ticket belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A ticket belongs to a tire tier.
     */
    public function tire()
    {
        return $this->belongsTo(\App\Models\Tires::class, 'tires_id');
    }
}
