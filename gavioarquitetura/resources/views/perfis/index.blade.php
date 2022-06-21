<x-layout title="Perfis">
    <style>
        .cards-container{
            min-height: 100vh;
            width: 100%;
            justify-content: space-around;
        }
        .card-perfil{
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 80vh;
            padding: 1em;
        }

        .img-perfil{
            margin-bottom: 2em;
        }

        .image{
            margin:3em 3em 0;
            width: 250px;
            height: 17em;
        }

        .content-info{
            height: 50%;
            display: flex;
            flex-direction: column;
        }

        .caixa-edicao{
            border-radius: 5px;
            margin-bottom: 1em;
            margin-right: .1em;
            width: 20rem;
        }

        .content-info p,
        .content-info input,
        .content-info textarea{
            padding: .5em;
            margin-bottom: 1em;
        }

        .descricao-div{
            height: 10em;
            text-align: justify;
            width: 20em;
        }

        .botao-editar{
            height:2.5em;
        }

    </style>
    <div class="d-flex cards-container">
        @foreach($perfis as $perfil)
            <div class="card-perfil">
                <div class="img-perfil">
                    <img src="{{$perfil->img_path_url}}" class="image">
                    <form method="post" enctype="multipart/form-data" action="/admin-projetos/{{$perfil->id}}/editaImagemProfile">
                        @csrf
                        <input type="file" class="form-control border-secondary" name="img_path_profile">
                        <button class="btn btn-primary botao-editar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>
                </div>



                <div class="content-info">

                    <div class="d-flex">

                        <div id="nome-perfil-{{$perfil->id}}" class="caixa-edicao">

                            <p>Nome: <span id="perfil-nome-{{$perfil->id}}">{{$perfil->nome}}</span> </p>

                        </div>
                        <div class="input-group" hidden id="input-nome-perfil-{{$perfil->id}}">

                            <input type="text" class="form-control" value="{{$perfil->nome}}" id="input-nome-{{$perfil->id}}">

                            <div class="input-group-append">
                                <button class="btn btn-primary botao-editar" onclick="editarNome({{$perfil->id}})">
                                    <i class="fa fa-check"></i>
                                </button>
                                @csrf
                            </div>
                        </div>

                        <button class="btn btn-primary botao-editar" onclick="toggleInput({{$perfil->id}}, 'nome-perfil-', 'input-nome-perfil-')">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                    </div>

                    <div class="d-flex">
                        <div id="descricao-perfil-{{$perfil->id}}" class="descricao-div caixa-edicao">

                            <p>Descrição: <span id="perfil-descricao-{{$perfil->id}}">{{$perfil->descricao}}</span></p>

                        </div>

                        <div class="input-group" hidden id="input-descricao-perfil-{{$perfil->id}}">

                            <textarea class="form-control" id="input-descricao-{{$perfil->id}}">
                                {{$perfil->descricao}}
                            </textarea>

                            <button class="btn btn-primary botao-editar" onclick="editarDescricao({{$perfil->id}})">
                                <i class="fa fa-check"></i>
                            </button>

                        </div>

                        <button class="btn btn-primary botao-editar" onclick="toggleInput({{$perfil->id}}, 'descricao-perfil-', 'input-descricao-perfil-')">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                    </div>
                </div>

            </div>
            <script>
                function toggleInput(perfilId, elemento, inputElemento){
                    const item = document.getElementById(elemento+perfilId);
                    const input = document.getElementById(inputElemento+perfilId);

                    if(item.hasAttribute('hidden')){
                        item.removeAttribute('hidden');
                        input.hidden = true;
                    } else{
                        input.removeAttribute('hidden');
                        item.hidden = true;
                    }
                }

                function editName(perfilId){
                    let formData = new FormData();
                    const nome = document.querySelector(`#input-nome-${perfilId}`).value;
                    const token = document.querySelector(`input[name="_token"]`).value;
                    formData.append('nome', nome);
                    formData.append('_token', token);
                    const url = `/admin-projetos/${perfilId}/editaNomePerfil`;

                    fetch(url, {
                        body:formData,
                        method:'POST'
                    }).then(()=>{
                        toggleInput(perfilId, 'nome-perfil-', 'input-nome-perfil-');
                        document.getElementById(`perfil-nome-${perfilId}`).textContent = nome;
                    })
                }

                function editDescription(perfilId){
                    let formData = new FormData();
                    const descricao = document.querySelector(`#input-descricao-${perfilId}`).value;
                    const token = document.querySelector(`input[name="_token"]`).value;
                    formData.append('descricao', descricao);
                    formData.append('_token', token);
                    const url = `/admin-projetos/${perfilId}/editaDescricaoPerfil`;

                    fetch(url, {
                        body:formData,
                        method: 'POST'
                    }).then(()=>{
                        toggleInput(perfilId, 'descricao-perfil-', 'input-descricao-perfil-');
                        document.getElementById(`perfil-descricao-${perfilId}`).textContent = descricao;
                    })
                }
            </script>
    @endforeach
</x-layout>


