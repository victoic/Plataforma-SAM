<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nome:') !!}
    <p>{!! $adventure->name !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Descrição:') !!}
    <p>{!! $adventure->description !!}</p>
</div>

<!-- Story Field -->
<div class="form-group">
    {!! Form::label('story', 'Estória:') !!}
    <p>{!! $adventure->story !!}</p>
</div>

<!-- Id Creator Field -->
<div class="form-group">
    {!! Form::label('id_creator', 'Id do Criador:') !!}
    <p>{!! $adventure->id_creator !!}</p>
</div>

