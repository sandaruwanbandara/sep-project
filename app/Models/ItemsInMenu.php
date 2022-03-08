<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsInMenu extends Model
{
    use HasFactory;

    protected $table = 'items_in_menu';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_id',
        'menu_item_id',
    ];

    /**
    * Get the menu type for user.
    */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
    * Get the menu type for user.
    */
    public function menu_item()
    {
        return $this->belongsTo(MenuItem::class);
    }

}
