@extends('layouts.app')

@section('content')
<div class="categoria-container">
    <h1>{{ ucfirst($categoria) }}</h1>

    @if($produtos->isEmpty())
        <p>Nenhum produto encontrado nesta categoria.</p>
    @else
        <div class="produtos-grid">
            @foreach($produtos as $produto)
                <div class="produto-container-principal card p-3" style="width: 18rem;">
                    <a href="{{ route('produto.show', $produto->id) }}" aria-label="Ver detalhes do produto {{ $produto->nome }}">
                        <img src="{{ asset('imagens/product_images/' . $produto->imagem) }}" 
                            alt="{{ $produto->nome }}" 
                            class="card-img-top img-fluid" 
                            onerror="this.onerror=null; this.src='{{ asset('imagens/product_images/default-product.jpg') }}';" />
                    </a>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $produto->nome }}</h5>
                        <p class="card-text">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                        <p class="card-text text-muted">{{ $produto->categoria }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
