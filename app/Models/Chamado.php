<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    use HasFactory;

    protected $table='chamados';
    protected $fillable = ['assunto', 'descricao', 'data_criacao_chamado', 'status', 'vendedor_id'];
    public function vendedores(){
        return $this->hasOne(Vendedor::class);
    }
}
