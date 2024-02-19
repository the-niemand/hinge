<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    use HasFactory;

    protected $table = 'user';

    protected $primaryKey = 'user_id';


    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'Ftype', 'role', 'profile_photo', 'bio', 'hourly_rate', 'experience', 'skills', 'country', 'languages', 'level'
    ];


    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
