<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nome:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Birth Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birth_date', 'Data de Nascimento:') !!}
    {!! Form::date('birth_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Active Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('active_time', 'Tempo ativo:') !!}
    {!! Form::text('active_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Teacher Field -->
<div class="form-group col-sm-6">
    {!! Form::label('teacher', 'É professor:') !!}
    {!! Form::checkbox('teacher', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Senha:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Points Field -->
<div class="form-group col-sm-6">
    {!! Form::label('points', 'Pontos:') !!}
    {!! Form::number('points', null, ['class' => 'form-control']) !!}
</div>

<!-- Remember Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control']) !!}
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Created em:') !!}
    {!! Form::date('created_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Atualizado em:') !!}
    {!! Form::date('updated_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Adventure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_adventure', 'Id da aventura:') !!}
    {!! Form::number('id_adventure', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Unlocked Activity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_unlocked_activity', 'Id da atividade desbloqueada:') !!}
    {!! Form::number('id_unlocked_activity', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
</div>
