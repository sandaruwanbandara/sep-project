<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'about',
        'logo',
        'contact'
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
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Get the menu type for user.
     */
    public function menu_type()
    {
        return $this->hasMany(MenuType::class);
    }

    /**
     * Get the menu type for user.
     */
    public function menu_item()
    {
        return $this->hasMany(MenuItem::class);
    }

    /**
     * Get the menu type for user.
     */
    public function menu()
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Get the menu type for user.
     */
    public function items_in_menu()
    {
        return $this->hasMany(ItemsInMenu::class);
    }
}
