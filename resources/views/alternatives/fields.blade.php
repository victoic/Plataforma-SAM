<!-- Text Field -->
<div class="form-group col-sm-6">
    {!! Form::label('text', 'Enunciado:') !!}
    {!! Form::text('text', null, ['class' => 'form-control']) !!}
</div>

<!-- Right Field -->
<div class="form-group col-sm-6">
    {!! Form::label('right', 'Correta:') !!}
    {!! Form::checkbox('right', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Exercise Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_exercise', 'Id do Exercício:') !!}
    {!! Form::number('id_exercise', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('alternatives.index') !!}" class="btn btn-default">Cancelar</a>
</div>
