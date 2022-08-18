    <div class="libraryHeading libraryModules">
        <p>{!! $achievement->name !!}</p>
    </div>
    <div class="libraryBody">
        <div class="libraryCardInfo">
            <div class="col-md-12 text-center">
                <img src="{!! url('/').'/images/achievements/'.$achievement->icon !!}" class="img-fluid m-x-auto d-block" alt="{!! $achievement->description !!}">
            </div>
            <div class="col-md-12 text-center">
                <p>{!! $achievement->description !!}</p>
            </div>
        </div>
    </div>