<!-- Stem Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stem', 'Enunciado:') !!}
    {!! Form::text('stem', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Tipo:') !!}
    {!! Form::number('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('exercises.index') !!}" class="btn btn-default">Cancelar</a>
</div>
