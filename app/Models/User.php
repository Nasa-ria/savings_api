<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Deposit;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'contact',
        'address',
        'contact',
        'next_of_kin_fullname',
        'next_of_kin_address',
        'next_of_kin_contact',
        'subscription',
        "balance",
    
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

            public function User()
        {
          $deposit= $this->hasMany(Deposit::class,'user_id','id');
            $admin  =$this->hasOne(Admin::class,'id');
            return [$deposit ,$admin];
        }

        // public function Users()
        // {
        //     return $this->hasOne(Admin::class,'id');
        // }


}
