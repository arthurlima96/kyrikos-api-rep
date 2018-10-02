<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dado extends Model
{
    protected $table = 'dados';

    protected $fillable = [
        'chave','valor'
    ];
    public function informacao()
    {
        return $this->belongsTo(Informacao::class,'informacoes_id');
    }
}
