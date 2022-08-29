<x-layout>
    <style>

        .img-individual{
            max-width: 350px;
            margin-bottom: 3em;

        }

        .painel-descricption{
            height: 100%;
            text-align: justify;
            padding: .5em;
        }

        .edit-button{
            height: 2.5em;
            width: 2.2em;
            border-radius: 5px;
        }

    </style>
<div class="d-flex flex-column align-items-center">
    <h1>{{$project->name}}</h1>
    <a href="/admin-projects/{{$project->category->name}}/{{$project->category->id}}" class="btn btn-sm btn-dark">Voltar</a>
    <div class="d-flex flex-column align-items-center mt-5 itens-projeto col-9">
        <div class="img-individual">
            <img src="{{$project->img_path_url}}" alt="" class="img-fluid my-1">
            <form method="post" enctype="multipart/form-data" action="{{route('image.edit', $project->id)}}">
                @csrf
                <input type="file" class="form-control border-secondary my-1" name="img_path-edit" id="img_path-edit">
                <button class="btn-dark edit-button">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </form>

        </div>

        <div class="mb-5 w-25">

            <form action="/admin-projects/{{$project->id}}/editCarousel" method="post">
                <label for="carrossel" class="fw-bold">Carrossel</label>

                <select name="activate_carousel" id="activate_carousel" class="form-control border-secondary">
                    <option value="1" @if($project->activate_carousel == 1) selected @endif>Ativado</option>
                    <option value="0" @if($project->activate_carousel == 0) selected @endif>Desativado</option>
                </select>

                <div class="input-group-append">
                    <button class="btn btn-dark" onclick="editName({{$project->id}})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>

            </form>

        </div>





        <div class="d-flex justify-content-center">
            <div class="mb-2 mx-1" id="name-box-{{$project->id}}" style="width: 20rem">
                <p class="fw-bold">Nome: </p>
                <p id="project-name-{{$project->id}}">{{$project->name}}</p>
            </div>
            <div class="input-group" hidden id="project-name-inputbox-{{ $project->id }}">

                <input type="text" class="form-control w-100" value="{{ $project->name }}" id="name-input-{{$project->id}}">

                <div class="input-group-append">

                    <button class="btn btn-dark" onclick="editName({{$project->id}})">
                        <i class="fas fa-check"></i>
                    </button>

                    @csrf
                </div>
            </div>

            <button class="btn-dark edit-button" onclick="toggleInput({{$project->id}}, `name-box-`, `project-name-inputbox-`)">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>

        </div>

        <div class="d-flex justify-content-center">
            <div class="mb-2 mx-1" id="area-box-{{$project->id}}" style="width: 20rem">
                <p class="fw-bold">Área: </p>
                <p id="project-area-{{$project->id}}">{{$project->area}}</p>
            </div>
            <div class="input-group w-100" hidden id="project-area-inputbox-{{ $project->id }}">
                <input type="text" class="form-control" value="{{ $project->area }}" id="area-input-{{$project->id}}">
                <div class="input-group-append">

                    <button class="btn btn-dark" onclick="editArea({{$project->id}})">
                        <i class="fas fa-check"></i>
                    </button>

                    @csrf
                </div>
            </div>

            <button class="btn-dark edit-button" onclick="toggleInput({{$project->id}}, `area-box-`, `project-area-inputbox-`)">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>

        </div>

        <div class="d-flex justify-content-center">
            <div class="mb-2 mx-1" id="year-box-{{$project->id}}" style="width: 20rem">
                <p class="fw-bold">Data:</p>
                <p id="project-year-{{$project->id}}">{{$project->year}}</p>
            </div>
            <div class="input-group w-100" hidden id="project-year-inputbox-{{ $project->id }}">
                <input type="text" class="form-control" value="{{ $project->year }}" id="year-input-{{$project->id}}">
                <div class="input-group-append">
                    <button class="btn btn-dark" onclick="editYear({{$project->id}})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>
            <button class="btn-dark edit-button" onclick="toggleInput({{$project->id}}, `year-box-`, `project-year-inputbox-`)">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
        </div>

        <div class="d-flex justify-content-center">
            <div class="mb-2 mx-1" id="address-box-{{$project->id}}" style="width: 20rem">
                <p class="fw-bold">Localização: </p>
                <p id="project-address-{{$project->id}}">{{$project->address}}</p>
            </div>
            <div class="input-group w-100" hidden id="project-address-inputbox-{{ $project->id }}">
                <input type="text" class="form-control" value="{{ $project->address }}" id="address-input-{{$project->id}}">
                <div class="input-group-append">
                    <button class="btn btn-dark" onclick="editAddress({{$project->id}})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>
            <button class="btn-dark edit-button" onclick="toggleInput({{$project->id}}, `address-box-`, `project-address-inputbox-`)">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
        </div>

        <div class="d-flex justify-content-center">
            <div class="mb-5 painel-descricption w-75" id="description-box-{{$project->id}}" style="width: 20rem">
                <p class="fw-bold">Descrição: </p>
                <p id="project-description-{{$project->id}}">{{$project->description}}</p>
            </div>
            <div class="input-group w-100" hidden id="project-description-inputbox-{{ $project->id }}">
                <textarea class="form-control" id="description-input-{{$project->id}}">{{ $project->description }}</textarea>
                <div class="input-group-append">
                    <button class="btn btn-dark" onclick="editDescription({{$project->id}})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>
            <button class="btn-dark edit-button" onclick="toggleInput({{$project->id}}, `description-box-`, `project-description-inputbox-`)">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
        </div>


    </div>
</div>


    <div class="d-flex flex-column align-items-center w-100">
        <form action="{{route('images.store', ['id' => $project->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="campo-adicao-imagens d-flex flex-column">
                <label for="images">Adicionar Imagens</label>

                <input
                    type="file"
                    name="images[]"
                    multiple
                    accept="image/*"
                >

            </div>
            <button type="submit" class="btn btn-sm btn-dark">Enviar</button>
        </form>

        <div class="w-75">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Img</th>
                    <th scope="col" class="text-center">Excluir</th>
                </tr>
                </thead>
                <tbody>
                @foreach($images as $image)
                    <tr>
                        <th scope="row" class="text-center">{{$image->id}}</th>
                        <td class="text-center"><img src="{{$image->img_path_url}}" alt="" style="width:250px;"></td>
                        <td class="text-center">
                            <form method="post" action="{{route('images.destroy', ['id' => $image->id])}}"
                                  onsubmit="return confirm('Tem certeza que deseja remover a imagem?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{asset('js/edit-fields.js')}}">




    </script>

</x-layout>
