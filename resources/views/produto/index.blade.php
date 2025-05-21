@extends('layouts.main')

@section('content')
<div class="container produto-container">

  <h1 class="mb-4">Meus Produtos</h1>

  {{-- Mensagem de sucesso --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- === Seção de Adicionar Produto ==== --}}
  <div class="produto-section mb-5 p-4 border rounded shadow-sm bg-light">
    <h2 class="mb-3">Adicionar Produto</h2>
    <form action="{{ route('produto.add') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- Nome --}}
      <div class="form-group mb-3">
        <label for="nome" class="form-label">Nome do Produto:</label>
        <input type="text" id="nome" name="nome"
               value="{{ old('nome') }}" required
               class="form-control @error('nome') is-invalid @enderror">
        @error('nome')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Preço --}}
      <div class="form-group mb-3">
        <label for="preco" class="form-label">Preço:</label>
        <input type="number" step="0.01" id="preco" name="preco"
               value="{{ old('preco') }}" required
               class="form-control @error('preco') is-invalid @enderror">
        @error('preco')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Categoria --}}
      <div class="form-group mb-3">
        <label for="categoria" class="form-label">Categoria:</label>
        <select id="categoria" name="categoria" required
                class="form-control @error('categoria') is-invalid @enderror">
          <option value="">Selecione uma categoria</option>
          @foreach(['Frutas','Verduras','Hortaliças','Legumes','Outros'] as $cat)
            <option value="{{ $cat }}" {{ old('categoria')==$cat?'selected':'' }}>
              {{ $cat }}
            </option>
          @endforeach
        </select>
        @error('categoria')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Imagem --}}
      <div class="form-group mb-3">
        <label for="imagem" class="form-label">Imagem do Produto:</label>
        <input type="file" id="imagem" name="imagem"
               accept="image/*"
               class="form-control @error('imagem') is-invalid @enderror">
        @error('imagem')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-success">Adicionar Produto</button>
    </form>
  </div>
  <hr>
  {{-- === Fim seção de adicionar ==== --}}

  {{-- Lista de produtos (mantém o que você já tinha) --}}
  @if($produtos->isEmpty())
    <p>Você não possui produtos cadastrados.</p>
  @else
    <div class="list-group">
      @foreach($produtos as $produto)
        <div class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <h5>{{ $produto->nome }}</h5>
            <small>R$ {{ number_format($produto->preco,2,',','.') }} — {{ $produto->categoria }}</small>
          </div>
          <div>
            <a href="{{ route('produto.edit', $produto->id) }}" class="btn btn-primary btn-sm me-2">Editar</a>
            <form action="{{ route('produto.delete', $produto->id) }}" method="POST" style="display:inline-block;"
                  onsubmit="return confirm('Tem certeza?')">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm">Deletar</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  @endif

</div>
@endsection
