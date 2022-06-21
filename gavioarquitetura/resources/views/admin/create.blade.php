<x-layout title="Adicionar Projeto">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" enctype="multipart/form-data" action="{{route('admin_projetos.store')}}">
        @csrf
        <div class="form-group mb-4 w-50">
            <label for="carrossel">Carrossel</label>
            <select name="carrossel" id="carrossel" class="form-control border-secondary">
                <option value="true">Ativado</option>
                <option value="0">Desativado</option>
            </select>
            <label for="categoria">Categoria</label>
            <select name="categoriaId" id="categoriaId" class="form-control border-secondary">
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
            </select>
            <label for="nome">Nome</label>
            <input type="text" class="form-control border-secondary" name="nome" id="nome">
            <label for="area">Área</label>
            <input type="text" class="form-control border-secondary" name="area" id="area">
            <label for="ano">Ano</label>
            <input type="text" class="form-control border-secondary" name="ano" id="ano">
            <label for="localizacao">Localização</label>
            <input type="text" class="form-control border-secondary" name="localizacao" id="localizacao">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control border-secondary"></textarea>
            <label for="img_path">Imagem</label>
            <input type="file" class="form-control border-secondary" name="img_path" id="img_path">

        </div>
        <button class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>

