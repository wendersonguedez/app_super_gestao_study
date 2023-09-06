<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produto_detalhes', function (Blueprint $table) {
            $table->id();
            // necessario colocar o nome da tabela pai no singular + chave primaria da mesma. neste caso, id. se atentar para ser o mesmo tipo tb.
            $table->unsignedBigInteger('produto_id');
            $table->float('comprimento', 8, 2);
            $table->float('largura', 8, 2);
            $table->float('altura', 8, 2);
            $table->timestamps();

            // criando a constraint (chave estrangeira). a coluna 'produto_id' faz referencia a coluna 'id' da tabela 'produtos'
            $table->foreign('produto_id')->references('id')->on('produtos');
            // garantindo que o relacionamento será 1:1. unique() não permite valores repetidos.
            $table->unique('produto_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_detalhes');
    }
};
