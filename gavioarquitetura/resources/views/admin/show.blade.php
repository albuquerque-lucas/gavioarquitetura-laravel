<x-layout title="{{$project->name}}">
    <style>
        .header-indivitual{
            text-align: center;
        }
        .img-individual{
            max-width: 350px;
            margin-bottom: 3em;

        }
        .project-items{
            position: relative;
            top: 2em;
            margin:0 0 3em 5em;
        }

        .painel-descricption{
            height: 10em;
            text-align: justify;
            padding: .5em;
        }

        .edit-button{
            height: 2.5em;
            width: 2.2em;
            border-radius: 5px;
        }
    </style>

    <div class="d-flex flex-column mt-5 itens-projeto col-9">
        <div class="img-individual">
            <img src="{{$project->img_path_url}}" alt="" class="img-fluid">
            <form method="post" enctype="multipart/form-data" action="/admin-projects/{{$project->id}}/editImageCover">
                @csrf
                <input type="file" class="form-control border-secondary" name="img_path-edit" id="img_path-edit">
                <button class="btn-primary edit-button">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </form>

        </div>





        <div class="d-flex">
            <div class="mb-2" id="name-box-{{$project->id}}" style="width: 20rem">
                <p>Nome: <span id="project-name-{{$project->id}}">{{$project->name}}</span></p>
            </div>
            <div class="input-group w-50" hidden id="project-name-inputbox-{{ $project->id }}">
                <input type="text" class="form-control" value="{{ $project->name }}" id="name-input-{{$project->id}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="editName({{$project->id}})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>
            <button class="btn-primary edit-button" onclick="toggleInput({{$project->id}}, `name-box-`, `project-name-inputbox-`)">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="mb-2" id="area-box-{{$project->id}}" style="width: 20rem">
                <p>Área: <span id="project-area-{{$project->id}}">{{$project->area}}</span></p>
            </div>
            <div class="input-group w-50" hidden id="project-area-inputbox-{{ $project->id }}">
                <input type="text" class="form-control" value="{{ $project->area }}" id="area-input-{{$project->id}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="editArea({{$project->id}})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>
            <button class="btn-primary edit-button" onclick="toggleInput({{$project->id}}, `area-box-`, `project-area-inputbox-`)">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="mb-2" id="year-box-{{$project->id}}" style="width: 20rem">
                <p>Data: <span id="projeto-ano-{{$project->id}}">{{$project->year}}</span></p>
            </div>
            <div class="input-group w-50" hidden id="project-year-inputbox-{{ $project->id }}">
                <input type="text" class="form-control" value="{{ $project->year }}" id="year-input-{{$project->id}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="editYear({{$project->id}})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>
            <button class="btn-primary edit-button" onclick="toggleInput({{$project->id}}, `year-box-`, `project-year-inputbox-`)">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="mb-2" id="address-box-{{$project->id}}" style="width: 20rem">
                <p>Localização: <span id="projeto-localizacao-{{$project->id}}">{{$project->address}}</span></p>
            </div>
            <div class="input-group w-50" hidden id="project-address-inputbox-{{ $project->id }}">
                <input type="text" class="form-control" value="{{ $project->address }}" id="address-input-{{$project->id}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="editAddress({{$project->id}})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>
            <button class="btn-primary edit-button" onclick="toggleInput({{$project->id}}, `address-box-`, `project-address-inputbox-`)">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="mb-2 painel-descricao" id="description-box-{{$project->id}}" style="width: 20rem">
                <p>Descrição: <span id="projeto-descricao-{{$project->id}}">{{$project->description}}</span></p>
            </div>
            <div class="input-group w-50" hidden id="project-description-inputbox-{{ $project->id }}">
                <textarea class="form-control" id="description-input-{{$project->id}}">{{ $project->description }}</textarea>
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="editDescription({{$project->id}})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>
            <button class="btn-primary edit-button" onclick="toggleInput({{$project->id}}, `description-box-`, `project-description-inputbox-`)">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
        </div>


    </div>

    <div class="container itens-projeto col-5 w-100">
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
            <button type="submit" class="btn btn-sm btn-primary">Enviar</button>
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
    <script>

        function toggleInput(projectId, element, inputElement){
            const item = document.getElementById(element+projectId);
            const input = document.getElementById(inputElement+projectId);

            if(item.hasAttribute('hidden')){
                item.removeAttribute('hidden');
                input.hidden = true;
            } else{
                input.removeAttribute('hidden');
                item.hidden = true;
            }
        }

        function editName(project_id){
            let formData = new FormData();
            const name = document.querySelector(`#input-nome-${project_id}`).value;
            const token = document.querySelector(`input[name="_token"]`).value;
            formData.append('nome', name);
            formData.append('_token', token);
            const url = `/admin-projects/${project_id}/editName`;

            fetch(url, {
                body:formData,
                method:'POST'
            }).then(()=>{
                toggleInput(project_id, `nome-projeto-`, `input-nome-projeto-`);
                document.getElementById(`projeto-nome-${project_id}`).textContent = name;
            })
        }

        function editArea(project_id){
            let formData = new FormData();
            const area = document.querySelector(`#input-area-${project_id}`).value;
            const token = document.querySelector(`input[name="_token"]`).value;
            formData.append('area', area);
            formData.append('_token', token);
            const url = `/admin-projects/${project_id}/editArea`;

            fetch(url, {
                body:formData,
                method:'POST'
            }).then(()=>{
                toggleInput(project_id, `area-projeto-`, `input-area-projeto-`);
                document.getElementById(`projeto-area-${project_id}`).textContent = area;
            })
        }

        function editYear(project_id){
            let formData = new FormData();
            const year = document.querySelector(`#input-ano-${project_id}`).value;
            const token = document.querySelector(`input[name="_token"]`).value;
            formData.append('ano', year);
            formData.append('_token', token);
            const url = `/admin-projects/${project_id}/editYear`;

            fetch(url, {
                body:formData,
                method:'POST'
            }).then(()=>{
                toggleInput(project_id, `ano-projeto-`, `input-ano-projeto-`);
                document.getElementById(`projeto-ano-${project_id}`).textContent = year;
            })
        }

        function editAddress(project_id){
            let formData = new FormData();
            const address = document.querySelector(`#input-localizacao-${project_id}`).value;
            const token = document.querySelector(`input[name="_token"]`).value;
            formData.append('localizacao', address);
            formData.append('_token', token);
            const url = `/admin-projects/${project_id}/editAddress`;

            fetch(url, {
                body:formData,
                method:'POST'
            }).then(()=>{
                toggleInput(project_id, `localizacao-projeto-`, `input-localizacao-projeto-`);
                document.getElementById(`projeto-localizacao-${project_id}`).textContent = address;
            })
        }

        function editDescription(project_id){
            let formData = new FormData();
            const description = document.querySelector(`#input-descricao-${project_id}`).value;
            const token = document.querySelector(`input[name="_token"]`).value;
            formData.append('descricao', description);
            formData.append('_token', token);
            const url = `/admin-projects/${project_id}/editDescription`;

            fetch(url, {
                body:formData,
                method:'POST'
            }).then(()=>{
                toggleInput(project_id, `descricao-projeto-`, `input-descricao-projeto-`);
                document.getElementById(`projeto-descricao-${project_id}`).textContent = description;
            })
        }


    </script>

</x-layout>
