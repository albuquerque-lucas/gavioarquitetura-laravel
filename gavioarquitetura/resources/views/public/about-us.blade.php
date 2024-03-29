<x-layout-public title={{$title}}>

    <div class="profile-section">

        @foreach($profiles as $profile)

            <div class="profile-card" id='{{$profile->id}}'>
                <div class="profile-img">
                    <img src="{{$profile->img_path_url}}" alt="">
                </div>
                <div class="profile-title">
                    <h3>{{$profile->name}}</h3>
                </div>
                <div class="profile-text">
                    <p>
                        {{$profile->description}}
                    </p>
                </div>

            </div>

        @endforeach

    </div>
    <x-footer/>
</x-layout-public>
