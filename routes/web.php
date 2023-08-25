<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PrincipalController::class, 'index'])->name('principal.index');
Route::get('/sobre-nos', [SobreNosController::class, 'index'])->name('sobre-nos.index');
Route::get('/contato', [ContatoController::class, 'index'])->name('contato.index');
Route::get('/login', function() {
    return 'login';
});

// agrupando rotas através de um prefixo
Route::prefix('/app')->group(function() {
    Route::get('/clientes', function() {
        return 'clientes';
    });
    Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('fornecedor.index');
    Route::get('/produtos', function() {
        return 'produtos';
    });
});

// ======== ANOTAÇÕES ======= //

// envio de parâmetro.
Route::get('/contato/{nome}', function(string $nome) {
    echo "<h1>seu nome para contato é {$nome}</h1>";
});

// envio de vários parâmetros.
Route::get('/contato/{estado}/{cidade}', function(string $estado, string $cidade) {
    echo "<h1>você nasceu no estado do {$estado}, na cidade de {$cidade}</h1>";
});

// envio de parâmetros opcionais e valores padrões.
// assunto está opcional, e caso não seja enviado, o valor padrão definido será enviado, neste caso, "assunto não informado".
Route::get('/mensagem/{email}/{assunto?}', function (string $email, string $assunto = "assunto não informado") {
    echo "<h1>email do usuário para contato: {$email} - assunto do email: {$assunto}</h1>";
});

// tratando parâmetros da rota com expressões regulares
Route::get('/gerente/{nome}/{nivel_acesso}', function(string $nome, int $nivel_acesso) {
    echo "<h1>nome do gerente: {$nome} - nivel de acesso: {$nivel_acesso}</h1>";
})->where('nome', '[A-Za-z]+')->where('nivel_acesso', '[0-9]+');

// utilizando rotas de contingência (fallback), que são rotas que serão executadas, caso o usuário acesse uma rota que não existe.
Route::fallback(function() {
    echo 'A rota acessada não existe. <a href="'. route('principal.index'). '">Clique aqui</a> para ir para página inicial.';
});

// enviando parâmetros para o controller
Route::get('/param/{p1}/{p2}', [ParametroController::class, 'index'])->name('parametro.index');