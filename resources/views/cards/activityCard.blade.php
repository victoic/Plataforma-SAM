
    <div class="libraryHeading libraryActivities">
        <p>{!! $activity->topic->name !!}</p>
    </div>
    <div class="libraryBody">
        <div class="libraryCardInfo">
            <p>{!! $activity->description !!}</p>
            <p>
                @if (!empty($activity->modules))
                Usada em {!! $activity->modules->count() !!} 
                @if ($activity->modules->count() == 1)
                módulo.
                @else
                módulos.
                @endif
                @else
                Usada em 0 módulos.
                @endif
            </p>
        </div>
        <div class="pull-left">
            <a class="deleteButton" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
        </div>
        <div class="libraryCardCreator pull-right">
            <p>Criada por <a href="">{!! $activity->creator->user->name !!}</a></p>
        </div>
    </div>