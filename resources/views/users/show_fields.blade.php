<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nome:') !!}
    <p>{!! $user->name !!}</p>
</div>

<!-- Birth Date Field -->
<div class="form-group">
    {!! Form::label('birth_date', 'Data de Nascimento:') !!}
    <p>{!! $user->birth_date->format('d/m/Y') !!}</p>
</div>

<!-- Active Time Field -->
<div class="form-group">
    {!! Form::label('active_time', 'Tempo se aventurando:') !!}
    <p>{!! $user->active_time !!} Horas</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $user->email !!}</p> {!! Form::button('Alterar email') !!}
</div>

<!-- Teacher Field -->
<div class="form-group">
    {!! Form::label('teacher', 'Professor?') !!}
    @if ($user->teacher)
    <p>Sim</p>
    @else
    <p>Não</p>
    @endif
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::button('Alterar Senha') !!}
</div>

<!-- Points Field -->
<div class="form-group">
    {!! Form::label('points', 'Pontos:') !!}
    <p>{!! $user->points !!}</p>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Aventureiro desde:') !!}
    <p>{!! $user->created_at !!}</p>
</div>


@if ($user->teacher == false)
<!-- Id Adventure Field -->
<div class="form-group">
    {!! Form::label('id_adventure', 'Aventura Atual:') !!}
    <p>{!! $user->id_adventure !!}</p>
</div>

<!-- Id Unlocked Activity Field -->
<div class="form-group">
    {!! Form::label('id_unlocked_activity', 'Missão Atual:') !!}
    <p>{!! $user->id_unlocked_activity !!}</p>
</div>
@endif

