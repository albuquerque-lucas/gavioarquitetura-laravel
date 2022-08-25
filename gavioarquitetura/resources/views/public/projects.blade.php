<x-layout-public title={{$title}}>

    <div class="project-div">

        <div class="project-type">
            <ul>
                @foreach($categories as $category)
                    <a
                        href='/projetos/{{$category->name}}/{{$category->id}}'
                        class="
                        list-item
                        @if($category->name == $name)
                            selecionado
                        @endif
                        "
                    >
                        <li>
                            {{$category->name}}
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>

        <div class="project-list">
            @foreach($projects as $project)
                <a href="{{route('public.show', $project->id)}}">
                <div class="project-card">
                    <img src="{{$project->img_path_url}}" alt="">
                    <h3>{{$project->name}}</h3>
                </div>
                </a>
            @endforeach
        </div>

    </div>
    <x-footer/>
</x-layout-public>
