<!-- Description Field -->
<!-- Topic Field -->
<div class="form-group">
    {!! Form::label('topic', 'Tópico:') !!}
    <p>{!! $activity->topic !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Descrição:') !!}
    <p>{!! $adventure->description !!}</p>
</div>

<!-- Story Field -->
<div class="form-group">
    {!! Form::label('story', 'Estória:') !!}
    <p>{!! $activity->story !!}</p>
</div>

<!-- Id Creator Field -->
<div class="form-group">
    {!! Form::label('id_creator', 'Id do Criadoor:') !!}
    <p>{!! $activity->id_creator !!}</p>
</div>

