<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToGym; // <-- 1. Le decimos dónde encontrar la magia

class Client extends Model
{
    use HasFactory, BelongsToGym; // <-- 2. La encendemos aquí adentro

    // <-- 3. Asegúrate de agregar gym_id en los campos permitidos
    protected $fillable = ['name', 'email', 'phone', 'gym_id']; 
}