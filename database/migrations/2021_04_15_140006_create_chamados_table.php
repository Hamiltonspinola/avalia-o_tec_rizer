<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendedores_id');
            $table->foreign('vendedores_id')->references('id')->on('vendedores');
            $table->text('assunto');
            $table->longText('descricao');
            $table->dateTime('data_criacao_chamado');
            $table->enum('status', ['aberto', 'andamento', 'resolvido', 'atrasado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chamados');
    }
}
