<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type_id',
        'name',
        'description',
        'price',
        'availability',
        'display',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Get the user that owns the menu type.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that owns the menu type.
     */
    public function type()
    {
        return $this->belongsTo(MenuType::class);
    }
    
    public function getPriceAttribute($value)
    {
        return number_format($value,2);
    }

    public function getAvailabilityAttribute($value)
    {
        return $value ? 'Yes' : 'No';
    }

    public function getDisplayAttribute($value)
    {
        return $value ? 'Yes' : 'No';
    }

    public function scopeDisplay($query)
    {
        return $query->where('display', '=', 1);
    }
}
