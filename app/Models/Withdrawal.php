<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;
    protected $fillable = [
        "balance",
        "amount_withdrawn",
        "user_id"
    
    ];

    
    public function Withdrawal()
    {
        return $this->belongsTo(User::class,'id','user_id');
    }
}
