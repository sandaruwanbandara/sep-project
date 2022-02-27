<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','mt_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
