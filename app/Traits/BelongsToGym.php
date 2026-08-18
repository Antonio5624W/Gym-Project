<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * Le decimos a Intelephense explícitamente que estas funciones existen
 * para que quite la línea roja de error.
 * 
 * @method static void addGlobalScope($scope, $implementation)
 * @method static void creating($callback)
 */
trait BelongsToGym
{
    protected static function bootedBelongsToGym()
    {
        // 1. EL FILTRO MÁGICO (SELECT): 
        static::addGlobalScope('gym', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('gym_id', Auth::user()->gym_id);
            }
        });

        // 2. EL AUTO-GUARDADO (INSERT):
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->gym_id = Auth::user()->gym_id;
            }
        });
    }
}