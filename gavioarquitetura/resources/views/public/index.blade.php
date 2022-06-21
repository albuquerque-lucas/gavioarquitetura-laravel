<x-layout-public title={{$title}}>

<div class="carousel-section">

    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <div class="carousel-inner">

            @foreach($projects as $key => $project)
                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                    <img src="{{$project->img_path_url}}" class="d-block w-100">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{$project->nome}}</h5>
                    </div>
                </div>
            @endforeach

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</div>



</x-layout-public>
