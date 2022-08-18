<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nome:') !!}
    <p>{!! $topic->name !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em:') !!}
    <p>{!! $topic->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em:') !!}
    <p>{!! $topic->updated_at !!}</p>
</div>

