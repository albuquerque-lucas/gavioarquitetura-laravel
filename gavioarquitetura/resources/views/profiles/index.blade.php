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
            height: 80%;
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
            box-shadow: inset 0 0 .5em white;
            transition: .1s ease-in-out;
        }

        .caixa-edicao:hover{
            box-shadow: inset 0 0 1em white;

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

                        <div id="name-box-{{$profile->id}}" class="caixa-edicao" onclick="toggleInput({{$profile->id}}, 'name-box-', 'input-profile-name-')">

                            <p><strong>Nome:</strong> <span id="profile-name-{{$profile->id}}">{{$profile->name}}</span> </p>

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
                        <div id="description-box-{{$profile->id}}" class="descricao-div caixa-edicao" onclick="toggleInput({{$profile->id}}, 'description-box-', 'input-profile-description-')">

                                <strong>Descrição:</strong>
                            <p>
                                <span id="profile-description-{{$profile->id}}">{{$profile->description}}</span>
                            </p>

                        </div>

                        <div class="input-group" hidden id="input-profile-description-{{$profile->id}}">

                            <textarea class="form-control w-75" id="input-description-{{$profile->id}}">
                                {{$profile->description}}
                            </textarea>

                            <button class="btn btn-primary edit-button" onclick="editDescription({{$profile->id}})">
                                <i class="fa fa-check"></i>
                            </button>

                        </div>

                        <button style="position: relative;top: 2rem;" class="btn btn-primary edit-button" onclick="toggleInput({{$profile->id}}, 'description-box-', 'input-profile-description-')">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                    </div>
                </div>

            </div>
            <script src="{{asset('js/edit-profile-fields.js')}}">

            </script>
    @endforeach
</x-layout>


