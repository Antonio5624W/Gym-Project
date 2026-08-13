<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['client_id', 'plan_id', 'start_date', 'end_date', 'price'];

    //relacion: una suscripcion pertenece a un cliente
    public function client(){
        return $this->belongsTo(Client::class); 
    }
    
}
