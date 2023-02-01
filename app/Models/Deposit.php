<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deposit extends Model
{
    use HasFactory;
    protected $fillable = [
        "balance",
        "amount_deposited",
        "user_id"
    
    ];

    
    public function Deposit()
    {
        return $this->belongsTo(User::class,'id','user_id');
    }
}
