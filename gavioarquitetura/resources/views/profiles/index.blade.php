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

                        <div id="name-box-{{$profile->id}}" class="caixa-edicao">

                            <p>Nome: <span id="profile-name-{{$profile->id}}">{{$profile->name}}</span> </p>

                        </div>

                        <div class="input-group" hidden id="input-profile-name-{{$profile->id}}">

                            <input type="text" class="form-control" value="{{$profile->name}}" id="input-name-{{$profile->id}}">

                            <div class="input-group-append">
                                <button class="btn btn-primary edit-button" onclick="editName({{$profile->id}})">
                                    <i class="fa fa-check"></i>
                                </button>
                                @csrf
                            </div>
                        </div>

                        <button class="btn btn-primary edit-button" onclick="toggleInput({{$profile->id}}, 'name-box-', 'input-profile-name-')">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                    </div>

                    <div class="d-flex">
                        <div id="description-box-{{$profile->id}}" class="descricao-div caixa-edicao">

                            <p>Descrição: <span id="profile-description-{{$profile->id}}">{{$profile->description}}</span></p>

                        </div>

                        <div class="input-group" hidden id="input-profile-description-{{$profile->id}}">

                            <textarea class="form-control" id="input-description-{{$profile->id}}">
                                {{$profile->description}}
                            </textarea>

                            <button class="btn btn-primary edit-button" onclick="editDescription({{$profile->id}})">
                                <i class="fa fa-check"></i>
                            </button>

                        </div>

                        <button class="btn btn-primary edit-button" onclick="toggleInput({{$profile->id}}, 'description-box-', 'input-profile-description-')">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                    </div>
                </div>

            </div>
            <script>
                function toggleInput(profileId, element, inputElement){
                    const item = document.getElementById(element+profileId);
                    const input = document.getElementById(inputElement+profileId);

                    if(item.hasAttribute('hidden')){
                        item.removeAttribute('hidden');
                        input.hidden = true;
                    } else{
                        input.removeAttribute('hidden');
                        item.hidden = true;
                    }
                }

                function editName(profileId){
                    let formData = new FormData();
                    const name = document.querySelector(`#input-name-${profileId}`).value;
                    const token = document.querySelector(`input[name="_token"]`).value;
                    formData.append('name', name);
                    formData.append('_token', token);
                    const url = `/profiles/${profileId}/editName`;

                    fetch(url, {
                        body:formData,
                        method:'POST'
                    }).then(()=>{
                        toggleInput(profileId, 'name-box-', 'input-profile-name-');
                        document.getElementById(`profile-name-${profileId}`).textContent = name;
                    })
                }

                function editDescription(profileId){
                    let formData = new FormData();
                    const description = document.querySelector(`#input-description-${profileId}`).value;
                    const token = document.querySelector(`input[name="_token"]`).value;
                    formData.append('description', description);
                    formData.append('_token', token);
                    const url = `/profiles/${profileId}/editDescription`;

                    fetch(url, {
                        body:formData,
                        method: 'POST'
                    }).then(()=>{
                        toggleInput(profileId, 'description-box-', 'input-profile-description-');
                        document.getElementById(`profile-description-${profileId}`).textContent = description;
                    })
                }
            </script>
    @endforeach
</x-layout>


