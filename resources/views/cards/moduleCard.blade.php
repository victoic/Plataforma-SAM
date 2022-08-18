    <div class="libraryHeading libraryModules">
        <p>{!! $module->name !!}</p>
    </div>
    <div class="libraryBody">
        <div class="libraryCardInfo">
            <p>{!! $module->description !!}</p>
            <p>
                Usada em {!! $module->adventures->count() !!} 
                @if ($module->adventures->count() == 1)
                aventura.
                @else
                aventuras.
                @endif
            </p>
            <p>{!! $module->topic->name !!}</p>
        </div>
        <div class="pull-left">
            <a class="deleteButton" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
        </div>
        <div class="libraryCardCreator pull-right">
            <p>Criada por <a href="">{!! $module->creator->user->name !!}</a></p>
        </div>
    </div>
