<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = [
            0 => [
                'nome' => 'wend',
                'status' => 'i',
                'cnpj' => '',
                'ddd' => '11',
                'telefone' => '90000-0000',
            ],
            1 => [
                'nome' => 'chicoria',
                'status' => 'a',
                'cnpj' => '00.000.000/0000-00.',
                'ddd' => '13',
                'telefone' => '90000-0000',
            ],
            2 => [
                'nome' => 'a gato',
                'status' => 'i',
                'cnpj' => null,
                'ddd' => '96',
                'telefone' => '90000-0000',
            ],
            3 => [
                'nome' => 'salem',
                'status' => 'i',
                'cnpj' => null,
                'ddd' => '85',
                'telefone' => '90000-0000',
            ],
        ];

        // operador ternário (condicao ? true : false)
        $msg = isset($fornecedores[1]['cnpj']) ? 'CNPJ informado' : 'CNPJ não informado';

        return view('app.fornecedor.index', compact('fornecedores'));
    }
}
