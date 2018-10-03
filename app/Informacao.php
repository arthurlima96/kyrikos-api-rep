<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informacao extends Model
{

    protected $table = 'informacoes';

    protected $fillable = [
        'nome'
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];
    public function dados()
    {
        return $this->hasMany(Dado::class,'informacoes_id');
    }
}
