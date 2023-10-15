<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestUser extends Model
{
    use HasFactory;
    protected $table = 'guest_users'; // Specify the table name
    protected $fillable = ['token']; // Define fields that can be mass-assigned

}
