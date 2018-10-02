<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informacao extends Model
{

    protected $table = 'informacoes';

    protected $fillable = [
        'nome'
    ];

    public function dados()
    {
        return $this->hasMany(Dado::class,'informacoes_id');
    }
}
