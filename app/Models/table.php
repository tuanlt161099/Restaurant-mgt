<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class table extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'number'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
