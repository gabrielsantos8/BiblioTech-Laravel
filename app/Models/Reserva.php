<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = ['aluno_id', 'livro_id', 'datainicio', 'datafim', 'observacao'];

    use HasFactory;

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }
}
