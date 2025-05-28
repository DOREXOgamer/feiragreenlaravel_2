@extends('layouts.main')

@section('head')
<link rel="stylesheet" href="{{ asset('css/produto-edit.css') }}">
@endsection

@section('content')
<div class="container produto-create-container">
    <h1>Criar Produto</h1>

    <form action="{{ route('produto.add') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nome" class="form-label">Nome do Produto</label>
            <input type="text" id="nome" name="nome" required maxlength="50"
                   pattern="[A-Za-zÀ-ÿ\s]+"
                   title="Apenas letras são permitidas"
                   class="form-control @error('nome') is-invalid @enderror"
                   value="{{ old('nome') }}">
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="preco" class="form-label">Preço (R$)</label>
            <input type="number" step="0.01" id="preco" name="preco" required
                   class="form-control @error('preco') is-invalid @enderror"
                   value="{{ old('preco') }}">
            @error('preco')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="categoria" class="form-label">Categoria</label>
            <select id="categoria" name="categoria" required
                    class="form-control @error('categoria') is-invalid @enderror">
                <option value="">Selecione uma categoria</option>
                @foreach(['Frutas','Verduras','Hortaliças','Legumes','Outros'] as $cat)
                    <option value="{{ $cat }}" {{ old('categoria') == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
            @error('categoria')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Imagem do Produto</label>
            <div class="imagem-upload-section">
                <div class="upload-area">
                    <label for="imagem" class="upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        Escolher Imagem
                    </label>
                    <input type="file" id="imagem" name="imagem" accept="image/jpeg,image/png,image/jpg,image"
                           class="upload-input @error('imagem') is-invalid @enderror">
                    <div class="upload-info">
                        Formatos aceitos: JPG, PNG (máx. 2MB)
                    </div>
                </div>
                @error('imagem')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="btn-container-primary">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Adicionar Produto
            </button>
        </div>
    </form>
</div>
@endsection
