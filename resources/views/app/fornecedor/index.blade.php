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
    <h2>usando laço for</h2>
    @for ($i = 0; $i < count($fornecedores); $i++)
        <h3>Dados do fornecedor: {{ $fornecedores[$i]['nome'] }}</h3>
        <p>Status: {{ $fornecedores[$i]['status'] }}</p>
        <p>CNPJ: {{ $fornecedores[$i]['cnpj'] ?? 'Dado não foi preenchido' }}</p>
        <span>Telefone: {{ $fornecedores[$i]['ddd'] ?? '' }} {{ $fornecedores[$i]['telefone'] }}</span>
        <hr>
    @endfor
@endisset


@isset($fornecedores)
    <h2>usando laço while</h2>
    @php $i = 0 @endphp
    @while ($i < count($fornecedores))
        <h3>Dados do fornecedor: {{ $fornecedores[$i]['nome'] }}</h3>
        <p>Status: {{ $fornecedores[$i]['status'] }}</p>
        <p>CNPJ: {{ $fornecedores[$i]['cnpj'] ?? 'Dado não foi preenchido' }}</p>
        <span>Telefone: {{ $fornecedores[$i]['ddd'] ?? '' }} {{ $fornecedores[$i]['telefone'] }}</span>
        <hr>
        @php $i++ @endphp
    @endwhile
@endisset

@isset($fornecedores)
    <h2>usando laço foreach</h2>
    @foreach ($fornecedores as $indice => $fornecedor)
        <h3>Dados do fornecedor: {{ $fornecedor['nome'] }}</h3>
        <p>Status: {{ $fornecedor['status'] }}</p>
        <p>CNPJ: {{ $fornecedor['cnpj'] ?? 'Dado não foi preenchido' }}</p>
        <span>Telefone: {{ $fornecedor['telefone'] ?? '' }} {{ $fornecedor['telefone'] }}</span>
        <hr>
    @endforeach
@endisset

@isset($fornecedores)
    <h2>usando laço forelse</h2>
    {{-- caso o array utilizado esteja vazio, cairá no bloco @empty --}}
    @forelse  ($fornecedores as $indice => $fornecedor)
        <h3>Dados do fornecedor: {{ $fornecedor['nome'] }}</h3>
        <p>Status: {{ $fornecedor['status'] }}</p>
        <p>CNPJ: {{ $fornecedor['cnpj'] ?? 'Dado não foi preenchido' }}</p>
        <span>Telefone: {{ $fornecedor['telefone'] ?? '' }} {{ $fornecedor['telefone'] }}</span>
        <hr>
    @empty
        nao existem fornecedores cadastrados
    @endforelse 
@endisset


@isset($fornecedores)
    <h2>espacando tag de impressão do blade, ou seja, exibindo o codigo como texto</h2>
    @for ($i = 0; $i < count($fornecedores); $i++)
        <h3>Dados do fornecedor: @{{ $fornecedores[$i]['nome'] }}</h3>
        <p>Status: {{ $fornecedores[$i]['status'] }}</p>
        <p>CNPJ: @{{ $fornecedores[$i]['cnpj'] ?? 'Dado não foi preenchido' }}</p>
        <span>Telefone: {{ $fornecedores[$i]['ddd'] ?? '' }} {{ $fornecedores[$i]['telefone'] }}</span>
        <hr>
    @endfor
@endisset

@isset($fornecedores)
    <h2>utilizando a variavel $loop</h2>
    @foreach ($fornecedores as $indice => $fornecedor)
        <h3>Dados do fornecedor: {{ $fornecedor['nome'] }}</h3>
        <h4>iteração atual do loop: {{ $loop->iteration }}</h4>
        <p>Status: {{ $fornecedor['status'] }}</p>
        <p>CNPJ: {{ $fornecedor['cnpj'] ?? 'Dado não foi preenchido' }}</p>
        <span>Telefone: {{ $fornecedor['telefone'] ?? '' }} {{ $fornecedor['telefone'] }}</span>
        @if ($loop->first)
            <p>essa foi a primeira iteração do loop</p>
        @elseif ($loop->last)
            <p>essa foi a ultima iteração do loop</p>
            <p>total de fornecedores exibidos: {{ $loop->count }}</p>
        @endif

        <hr>
    @endforeach
@endisset