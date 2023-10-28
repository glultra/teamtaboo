<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class GuestUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'guest_users'; // Specify the table name
    protected $fillable = ['token']; // Define fields that can be mass-assigned

}
