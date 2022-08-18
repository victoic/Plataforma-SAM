<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nome:') !!}
    <p>{!! $achievement->name !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Descrição:') !!}
    <p>{!! $achievement->description !!}</p>
</div>

<!-- Points Field -->
<div class="form-group">
    {!! Form::label('points', 'Pontos:') !!}
    <p>{!! $achievement->points !!}</p>
</div>

<!-- Icon Field -->
<div class="form-group">
    {!! Form::label('icon', 'Ícone:') !!}
    <p>{!! $achievement->icon !!}</p>
</div>

