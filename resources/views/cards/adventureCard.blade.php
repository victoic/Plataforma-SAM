<div class="card libraryCard col-md-3" id="adventure-{!! $adventure->id !!}">
    <div class="libraryHeading libraryAdventures">
        <p>{!! $adventure->name !!}</p>
    </div>
    <div class="libraryBody">
        <div class="libraryCardInfo">
            <p>{!! $adventure->description !!}</p>
            <p>
                Usada por {!! $adventure->teachers->count() !!} 
                @if ($adventure->teachers->count() == 1)
                professor.
                @else
                professores.
                @endif
            </p>
        </div>
        <div class="pull-left">
            <a class="deleteButton" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
        </div>
        <div class="libraryCardCreator pull-right">
            <p>Criada por <a href="">{!! $adventure->creator->user->name !!}</a></p>
        </div>
    </div>
</div>