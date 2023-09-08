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
        // alterando a posição das colunas na tabela fornecedores e adicionando novas constraints.
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->string('uf', 2)->nullable()->after('nome')->change();
            $table->string('email', 150)->after('uf')->change();
            $table->char('status', 1)->after('site')->default('I')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // volta para posição que estava antes do método up. é necessário saber exatamente como estava, para poder realizar um rollback corretamente.
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->string('uf', 2)->after('updated_at')->change();
            $table->string('email', 150)->after('uf')->change();
            $table->char('status', 1)->after('email')->change();
        });
    }
};
