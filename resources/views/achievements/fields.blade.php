<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nome:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descrição:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Points Field -->
<div class="form-group col-sm-2">
    {!! Form::label('points', 'Pontos:') !!}
    {!! Form::number('points', null, ['class' => 'form-control']) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-12">
    {!! Form::file('icon') !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('achievements.index') !!}" class="btn btn-default">Cancelar</a>
</div>
