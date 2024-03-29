<x-layout>

    @if(!empty($message))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

        <div class="m-5 w-100 d-flex justify-content-center">


                @foreach($categories as $category)

                    <a
                        class="btn btn-dark category-btn"
                        id="{{$category->name}}"
                        href="/admin-projects/{{$category->name}}/{{$category->id}}"
                        style=
                        "
                        margin-right: 1rem;
                        @if($category->name == $name)
                            color: black;
                            background: white;
                            border: 2px solid black;
                        @endif
                        "
                    >

                        {{$category->name}}

                    </a>

                @endforeach


        </div>


        <a href="{{route('admin_projects.create')}}" class="btn btn-dark mb-2">Adicionar</a>

        <table class="table display" id="project-table">
            <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Nome</th>
                <th scope="col" class="text-center">Carrossel</th>
                <th scope="col" class="text-center">Area</th>
                <th scope="col" class="text-center">Ano</th>
                <th scope="col" class="text-center">Localização</th>
                <th scope="col" class="text-center">Imagem</th>
                <th scope="col" class="text-center">Editar</th>
                <th scope="col" class="text-center">Excluir</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <div id="project-card">
                    <tr>
                        <td class="text-center fw-bold">{{$project->id}}</td>
                        <td class="text-center">{{$project->name}}</td>
                        <td class="text-center fw-bold">@if($project->activate_carousel == 1) Ativo @else Desativado @endif</td>
                        <td class="text-center">{{$project->area}}</td>
                        <td class="text-center">{{$project->year}}</td>
                        <td class="text-center">{{$project->address}}</td>
                        <td class="text-center"><img src="{{$project->img_path_url}}" alt="" class="img-thumbnail" width="250px"></td>
                        <td class="text-center">
                            <a class="link-dark" href="{{route('admin_projects.show', ['id'=>$project->id])}}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <form method="post" action="{{route('admin_projects.destroy', $project->id)}}"
                                  onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($project->name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                </div>
            @endforeach
            </tbody>
        </table>
        <script>
            $(document).ready( function () {
                $('#project-table').DataTable();
            } );
        </script>
</x-layout>
