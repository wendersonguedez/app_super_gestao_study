<h1>pagina de fornecedor</h1>

@php
    echo 'bloco de php puro';
@endphp

@if (count($fornecedores) > 0 && count($fornecedores) < 10)
    <h2>existem alguns fornecedores cadastrados</h2>
@elseif (count($fornecedores) > 10)
    <h2>existem muitos fornecedores cadastrados</h2>
@else
    <h2>ainda não existem fornecedores cadastrados</h2>
@endif

{{-- verifica se a variável $fornecedores existe/está declarada. também verifica a existência de indices, como na linha 26. --}}
@isset($fornecedores)
    <h3>Dados do Fornecedor 1:</h3>
    <span>Fornecedor: {{ $fornecedores[0]['nome'] }}</span><br>

    <span>Status: {{ $fornecedores[0]['status'] }}</span>
    {{-- @unless executa se o retorno for false. neste caso, o usuário em questão está inativo, logo, entrará no bloco de código. --}}
    @unless ($fornecedores[0]['status'] == 'a')
        <span> - fornecedor inativo</span>
    @endunless
    <br>

    @isset($fornecedores[0]['cnpj'])
        <span>CNPJ: {{ $fornecedores[0]['cnpj'] }}</span>
        {{-- verifica se variáveis ou indices de arrays estão ou não vazios. valores considerados vazios: '', 0, 0.0, '0', null, false, array(), $var --}}
        @empty($fornecedores[0]['cnpj'])
            - Vazio
        @endempty
    @endisset

@endisset

<hr>

@isset($fornecedores)
    <h3>Dados do Fornecedor 2:</h3>
    <p>Fornecedor: {{ $fornecedores[1]['nome'] }}</p>
    <p>Status: {{ $fornecedores[1]['status'] }}</p>
    @isset($fornecedores[1]['cnpj'])
        <span>CNPJ: {{ $fornecedores[1]['cnpj'] }}</span>
        @empty($fornecedores[1]['cnpj'])
            - Vazio
        @endempty
    @endisset
@endisset

<hr>

@isset($fornecedores)
    <h3>Dados do Fornecedor 3:</h3>
    <p>Fornecedor: {{ $fornecedores[2]['nome'] }}</p>
    <p>Status: {{ $fornecedores[2]['status'] }}</p>
    <!-- 
        ?? ==> operador condicional de valor default. nas duas condições abaixo, caso alguma seja true, o valor default será utilizado no lugar da variável em questão.
        $var testada não estiver definida (isset)
        ou
        $var testada possuir o valor null (somente null)
    -->
    <span>CNPJ: {{ $fornecedores[2]['cnpj'] ?? 'Dado não foi preenchido' }}</span>
@endisset

<hr>

@isset($fornecedores)
    <h3>Dados do Fornecedor 4:</h3>
    <p>Fornecedor: {{ $fornecedores[3]['nome'] }}</p>
    <p>Status: {{ $fornecedores[3]['status'] }}</p>
    <p>CNPJ: {{ $fornecedores[3]['cnpj'] ?? 'Dado não foi preenchido' }}</p>
    <span>Telefone: {{ $fornecedores[3]['ddd'] ?? '' }} {{ $fornecedores[3]['telefone'] }}</span>
    @switch($fornecedores[3]["ddd"])
        @case('11')
            São Paulo - SP
            @break
        @case('21')
            Rio de Janeiro - RJ
            @break
        @case('85')
            Fortaleza - CE
            @break
        @case('96')
            Macapá - AP
            @break
        @default
            Estado não identificado
    @endswitch
@endisset

