<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'sms_verification_code',
        'password_reset_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
        'sms_verification_code',
        'password_reset_code',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'sms_code_expires_at' => 'datetime',
        'password_reset_expires_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setMobileAttribute($value)
    {
        if (! $value) {
            $this->attributes['mobile'] = null;
            return;
        }

        // Strip all non-digits
        $raw = preg_replace('/\D+/', '', $value);

        if ($raw === '') {
            $this->attributes['mobile'] = null;
            return;
        }

        if (str_starts_with($raw, '0')) {
            $this->attributes['mobile'] = '+92' . substr($raw, 1);
        } elseif (str_starts_with($raw, '92') && strlen($raw) >= 11) {
            $this->attributes['mobile'] = '+' . $raw;
        } elseif (str_starts_with($raw, '3') && strlen($raw) === 10) {
            $this->attributes['mobile'] = '+92' . $raw;
        } else {
            $this->attributes['mobile'] = null;
        }
    }
}
