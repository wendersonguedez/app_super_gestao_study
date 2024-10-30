<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Models\SiteContato;
use Illuminate\Support\Facades\Route;

Route::get('/', [PrincipalController::class, 'index'])->name('principal.index');
Route::get('/sobre-nos', [SobreNosController::class, 'index'])->name('sobre-nos.index');
Route::get('/contato', [ContatoController::class, 'index'])->name('contato.index');
Route::post('/contato', [ContatoController::class, 'index'])->name('contato.index');
Route::get('/login', function () {
    return 'login';
});

/**
 * Agrupamento de rotas com o prefixo "/app"
 * Todas as rotas dentro desse grupo terão o prefixo "/app" adicionado automaticamente ao caminho.
 */
Route::prefix('/app')->group(function () {

    /**
     * Rota para a listagem de clientes.
     * Caminho resultante: "/app/clientes"
     */
    Route::get('/clientes', function () {
        return 'clientes';
    });

    /**
     * Rota para acessar a página de fornecedores.
     * Utiliza o método index do FornecedorController.
     * Nome da rota: "fornecedor.index" para facilitar referências no código.
     */
    Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('fornecedor.index');

    /**
     * Rota para a listagem de produtos.
     * Caminho resultante: "/app/produtos"
     */
    Route::get('/produtos', function () {
        return 'produtos';
    });
});

/**
 * Envio de um parâmetro dinâmico na rota.
 * Esta rota recebe o nome do contato e exibe uma mensagem personalizada com ele.
 */
Route::get('/contato/{nome}', function (string $nome) {
    echo "<h1>Seu nome para contato é {$nome}</h1>";
});

/**
 * Envio de múltiplos parâmetros na rota.
 * Recebe o estado e a cidade de nascimento e exibe uma mensagem com ambos os dados.
 */
Route::get('/contato/{estado}/{cidade}', function (string $estado, string $cidade) {
    echo "<h1>Você nasceu no estado do {$estado}, na cidade de {$cidade}</h1>";
});

/**
 * Envio de parâmetros opcionais e valores padrões.
 * O parâmetro "assunto" é opcional; caso não seja enviado, o valor padrão "assunto não informado" será usado.
 */
Route::get('/mensagem/{email}/{assunto?}', function (string $email, string $assunto = "assunto não informado") {
    echo "<h1>Email do usuário para contato: {$email} - Assunto do email: {$assunto}</h1>";
});

/**
 * Tratamento de parâmetros com expressões regulares.
 * Define restrições nos parâmetros:
 * - "nome" deve conter apenas letras (A-Z, a-z).
 * - "nivel_acesso" deve conter apenas números (0-9).
 */
Route::get('/gerente/{nome}/{nivel_acesso}', function (string $nome, int $nivel_acesso) {
    echo "<h1>Nome do gerente: {$nome} - Nível de acesso: {$nivel_acesso}</h1>";
})->where('nome', '[A-Za-z]+')->where('nivel_acesso', '[0-9]+');

/**
 * Rota de contingência (fallback).
 * Executada quando o usuário acessa uma rota inexistente, exibindo uma mensagem com link para a página inicial.
 */
Route::fallback(function () {
    echo 'A rota acessada não existe. <a href="' . route('principal.index') . '">Clique aqui</a> para ir para a página inicial.';
});

/**
 * Envio de parâmetros para o controller.
 * Direciona para o ParametroController, passando dois parâmetros (p1 e p2) para o método index.
 * Nome da rota: "parametro.index" para facilitar referências no código.
 */
Route::get('/param/{p1}/{p2}', [ParametroController::class, 'index'])->name('parametro.index');

/**
 * Grupo de rotas para o módulo de eloquent ORM.
 */
Route::prefix('eloquent')->group(function () {
    /**
     * Retorna todos os registros que possuem o motivo de contato 1.
     */
    Route::get('/where-in', function () {
        return SiteContato::whereIn('motivo_contato', [1, 3])->get();
    });

    /**
     * Retorna todos os registros que não possuem o motivo de contato 1.
     */
    Route::get('/where-not-in', function () {
        return SiteContato::whereNotIn('motivo_contato', [1])->get();
    });

    /**
     * Retorna todos os registros que possuem o motivo de contato entre os valores 1 e 3.
     * 
     * A diferença entre o whereIn e whereBetween é que o whereIn realiza uma comparação de igualdade dos valores passados,
     * enquanto o whereBetween realiza uma comparação com base em um intervalo. 
     * Ou seja, no whereIn, o retorno será de registros cujo campo esteja igual a qualquer valor passado, enquanto no whereBetween, 
     * o retorno será de registros cujo campo esteja entre os valores passados.
     * 
     * Exemplo: Irá retornar os registros 3, 4, 5 e 6.
     */
    Route::get('where-between', function () {
        return SiteContato::whereBetween('motivo_contato', [1, 3])
            ->orderBy('id')
            ->get();
    });

    /**
     * Retornar todos os registros que não estiverem entre os valores 3 e 6.
     * 
     * Exemplo: Irá retornar os registros 1, 2. Registros 3, 4, 5 e 6 não serão retornados.
     */
    Route::get('/where-not-between', function () {
        return SiteContato::whereNotBetween('id', [3, 6])
            ->orderBy('id')
            ->get();
    });

    /**
     * Retorna todos os registros que possuem o nome diferente de Fernando, o motivo de contato entre os valores 1 e 2 
     * e a data de criação entre 2024-01-01 e 2024-10-31.
     */
    Route::get('/multiple-wheres', function () {
        return SiteContato::where('nome', '<>', 'Fernando')
            ->whereIn('motivo_contato', [1, 2])
            ->whereBetween('created_at', ['2024-01-01', '2024-10-31'])
            ->get();
    });

    /**
     * Retorna todos os registros que possuem o nome diferente de Fernando 
     * ou o motivo de contato seja maior que 2 ou que a data de criação seja anterior a 2024-10-31.
     * 
     * 'Fernando' será excluído da consulta, porque a primeira clásula 'where('nome', '<>', 'Fernando')' é um condição
     * obrigatória.
     */
    Route::get('/or-where', function () {
        return SiteContato::where('nome', '<>', 'Fernando')
        ->orWhere('motivo_contato', '>', 2)
        ->orWhere('created_at', '<', '2024-10-31')
        ->get();
    });

    /**
     * Retorna apenas registros que possuem o nome diferente de Helena, o motivo de contato seja 2 e a data de criação seja nula.
     */
    Route::get('/where-null', function () {
        return SiteContato::where('nome', '<>', 'Helena')
        ->whereIn('motivo_contato', [2])
        ->whereNull('created_at')
        ->get();
    });

    /**
     * Retorna apenas registros que possuem o nome diferente de Helena, o motivo de contato seja 2 e a data de criação náo seja nula.
     */
    Route::get('/where-not-null', function () {
        return SiteContato::where('nome', '<>', 'Helena')
        ->whereIn('motivo_contato', [1, 2])
        ->whereNotNull('created_at')
        ->get();
    });
});