<x-layout-public title={{$title}}>

    <div class="project-div">

        <div class="project-type">
            <ul>
                @foreach($categories as $category)
                    <a
                        href='/projetos/{{$category->nome}}/{{$category->id}}'
                        class="
                        list-item
                        @if($category->nome == $nome)
                            selecionado
                        @endif
                        "
                    >
                        <li>
                            {{$category->nome}}
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>

        <div class="project-list">
            @foreach($projects as $project)
                <a href="/project/{{$project->id}}">
                <div class="project-card">
                    <img src="{{$project->img_path_url}}" alt="">
                    <h3>{{$project->nome}}</h3>
                </div>
                </a>
            @endforeach
        </div>

    </div>

</x-layout-public>
