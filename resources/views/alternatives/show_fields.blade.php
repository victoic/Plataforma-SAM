<!-- Text Field -->
<div class="form-group">
    {!! Form::label('text', 'Enunciado:') !!}
    <p>{!! $alternative->text !!}</p>
</div>

<!-- Right Field -->
<div class="form-group">
    {!! Form::label('right', 'Correta:') !!}
    @if ($alternative->right)
    <p>Sim</p>
    @else
    <p>Não</p>
    @endif
</div>

<!-- Id Exercise Field -->
<div class="form-group">
    {!! Form::label('id_exercise', 'Id do Exercício:') !!}
    <p>{!! $alternative->id_exercise !!}</p>
</div>

