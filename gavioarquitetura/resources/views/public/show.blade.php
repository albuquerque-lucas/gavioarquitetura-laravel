<x-layout-public title={{$title}}>

    <div class='display-project'>

        <div class="project-main-image">
            <img src="{{$project->img_path_url}}" alt="">
        </div>

        <div class="title-content">
            <h1>{{$project->name}}</h1>
        </div>

        <div class="info-project">

            <div class="info-data">
                <h3>Ficha Técnica</h3>
                <table>
                    <tr>
                        <td>
                            <i>Área:</i>
                        </td>
                        <td>{{$project->area}}</td>
                    </tr>
                    <tr>
                        <td>
                            <i>Ano:</i>
                        </td>
                        <td>{{$project->year}}</td>
                    </tr>
                    <tr>
                        <td>
                            <i>Localização:</i>
                        </td>
                        <td>{{$project->address}}</td>
                </table>
            </div>

            <div class="project-description">
                <p>
                    {{$project->description}}
                </p>
            </div>


        </div>


        <div class="project-image-list">
            @foreach($images as $image)
            <img src="{{$image->img_path_url}}" alt="">
            @endforeach
        </div>
    </div>
    <x-footer/>
</x-layout-public>
