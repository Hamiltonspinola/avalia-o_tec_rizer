<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    protected $table='vendedores';
    protected $fillable = ['nome', 'email', 'telefone', 'status', 'qtd_chamados_aberto', 'qtd_chamados_andamento', 'qtd_chamados_resolvido'];

    public function chamados(){
        return $this->belongsTo(Chamado::class);
    }
}
