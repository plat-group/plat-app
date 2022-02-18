<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use UuidTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'role',
        'username',
        'email',
        'name',
        'gender',
        'birthday',
        'avatar',
        'wallet_address',
        'balance',
        'blocked_balance',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
    ];

    /**
     * Role of user is Creator
     *
     * @return boolean
     */
    public function isCreator()
    {
        return $this->role == CREATOR_ROLE;
    }

    /**
     * Role of user is Client
     *
     * @return boolean
     */
    public function isClient()
    {
        return $this->role == CLIENT_ROLE;
    }

    /**
     * Role of user is Referral
     *
     * @return bool
     */
    public function isReferraler()
    {
        return $this->role == REFERRAL_ROLE;
    }
}
