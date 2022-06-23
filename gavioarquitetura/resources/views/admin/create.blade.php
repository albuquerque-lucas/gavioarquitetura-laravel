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
    <form method="post" enctype="multipart/form-data" action="{{route('admin_projects.store')}}">
        @csrf
        <div class="form-group mb-4 w-50">
            <label for="carrossel">Carrossel</label>
            <select name="activate_carousel" id="activate_carousel" class="form-control border-secondary">
                <option value="true">Ativado</option>
                <option value="false">Desativado</option>
            </select>
            <label for="categoria">Categoria</label>
            <select name="category_id" id="category_id" class="form-control border-secondary">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <label for="nome">Nome</label>
            <input type="text" class="form-control border-secondary" name="name" id="name">
            <label for="area">Área</label>
            <input type="text" class="form-control border-secondary" name="area" id="area">
            <label for="ano">Ano</label>
            <input type="text" class="form-control border-secondary" name="year" id="year">
            <label for="localizacao">Localização</label>
            <input type="text" class="form-control border-secondary" name="address" id="address">
            <label for="descricao">Descrição</label>
            <textarea name="description" id="description" class="form-control border-secondary"></textarea>
            <label for="img_path">Imagem</label>
            <input type="file" class="form-control border-secondary" name="img_path" id="img_path">

        </div>
        <button class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>

