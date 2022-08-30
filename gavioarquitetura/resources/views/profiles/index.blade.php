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
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .caixa-edicao{
            border-radius: 5px;
            margin-bottom: 1em;
            margin-right: .1em;
            padding: .7rem;
            width: 30rem;
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
            width: 30rem!important;
        }

        .content-info textarea{
            min-height: 15rem;
        }

        .descricao-div{
            height: 10em;
            text-align: justify;
            width: 20em;
        }

        .edit-button{
            height:2.5em;
        }

        .edit-button:focus{
            box-shadow: none;
        }

    </style>
    <div class="d-flex cards-container mb-5">

        @foreach($profiles as $profile)

            <div class="profile-card">
                <div class="profile-img">
                    <img src="{{$profile->img_path_url}}" class="image">
                    <form method="post" enctype="multipart/form-data" action="{{route('profiles.editImage', $profile->id)}}">
                        @csrf
                        <input type="file" class="form-control border-secondary" name="img_path_profile">
                        <button class="btn btn-dark edit-button">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>
                </div>

                <div class="content-info">

                    <div class="d-flex">

                        <div id="name-box-{{$profile->id}}" onclick="toggleInput({{$profile->id}}, 'name-box-', 'input-profile-name-')">

                            <p class="fw-bold">Nome:</p>
                            <p id="profile-name-{{$profile->id}}" class="caixa-edicao">{{$profile->name}}</p>

                        </div>

                        <div class="input-group" hidden id="input-profile-name-{{$profile->id}}">

                            <input type="text" class="form-control" value="{{$profile->name}}" id="input-name-{{$profile->id}}">
                            <div class="input-group-append">
                                <button class="btn btn-dark edit-button" onclick="editName({{$profile->id}})">
                                    <i class="fa fa-check"></i>
                                </button>
                                @csrf
                            </div>

                        </div>

                    </div>

                    <div class="d-flex">
                        <div id="description-box-{{$profile->id}}" class="descricao-div" onclick="toggleInput({{$profile->id}}, 'description-box-', 'input-profile-description-')">

                            <p class="fw-bold">Descrição:</p>
                            <p id="profile-description-{{$profile->id}}" class="caixa-edicao">{{$profile->description}}</p>

                        </div>

                        <div class="input-group" hidden id="input-profile-description-{{$profile->id}}">

                            <textarea class="form-control w-75" id="input-description-{{$profile->id}}">
                                {{$profile->description}}
                            </textarea>

                            <button class="btn btn-dark edit-button" onclick="editDescription({{$profile->id}})" style="position: relative;top: 2rem">
                                <i class="fa fa-check"></i>
                            </button>

                        </div>

                    </div>
                </div>

            </div>
            <script src="{{asset('js/edit-profile-fields.js')}}">

            </script>
    @endforeach
</x-layout>


