<x-layout title="Perfis">
    <style>
        .cards-container{
            min-height: 100vh;
            width: 100%;
            justify-content: space-around;
        }
        .profile-card{
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 80vh;
            padding: 1em;
        }

        .profile-img{
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

        .edit-button{
            height:2.5em;
        }

    </style>
    <div class="d-flex cards-container">

        @foreach($profiles as $profile)

            <div class="profile-card">
                <div class="profile-img">
                    <img src="{{$profile->img_path_url}}" class="image">
                    <form method="post" enctype="multipart/form-data" action="/admin-projects/{{$profile->id}}/editImage">
                        @csrf
                        <input type="file" class="form-control border-secondary" name="img_path_profile">
                        <button class="btn btn-primary edit-button">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>
                </div>

                <div class="content-info">

                    <div class="d-flex">

                        <div id="nome-perfil-{{$profile->id}}" class="caixa-edicao">

                            <p>Nome: <span id="perfil-nome-{{$profile->id}}">{{$profile->name}}</span> </p>

                        </div>
                        <div class="input-group" hidden id="input-nome-perfil-{{$profile->id}}">

                            <input type="text" class="form-control" value="{{$profile->name}}" id="input-nome-{{$profile->id}}">

                            <div class="input-group-append">
                                <button class="btn btn-primary edit-button" onclick="editarNome({{$perfil->id}})">
                                    <i class="fa fa-check"></i>
                                </button>
                                @csrf
                            </div>
                        </div>

                        <button class="btn btn-primary edit-button" onclick="toggleInput({{$profile->id}}, 'nome-perfil-', 'input-nome-perfil-')">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                    </div>

                    <div class="d-flex">
                        <div id="descricao-perfil-{{$profile->id}}" class="descricao-div caixa-edicao">

                            <p>Descrição: <span id="perfil-descricao-{{$profile->id}}">{{$profile->description}}</span></p>

                        </div>

                        <div class="input-group" hidden id="input-descricao-perfil-{{$profile->id}}">

                            <textarea class="form-control" id="input-descricao-{{$profile->id}}">
                                {{$profile->description}}
                            </textarea>

                            <button class="btn btn-primary edit-button" onclick="editarDescricao({{$profile->id}})">
                                <i class="fa fa-check"></i>
                            </button>

                        </div>

                        <button class="btn btn-primary edit-button" onclick="toggleInput({{$profile->id}}, 'descricao-perfil-', 'input-descricao-perfil-')">
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


