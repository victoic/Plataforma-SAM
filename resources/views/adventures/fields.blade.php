<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nome da Aventura') !!}
    {!! Form::text('name', null, 
    	['class' => 'form-control',
    	'placeholder'=>'Dê um nome a sua aventura']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descrição da Aventura') !!}
    {!! Form::text('description', null,
    	['class' => 'form-control',
    	'placeholder'=>'Descreva o que será ensinado nessa aventura']) !!}
</div>

<!-- Story Field -->
<div class="form-group col-md-12">
    {!! Form::label('story', 'Estória') !!}
    {!! Form::textarea('message', null, 
        ['class'=>'form-control', 
        'id'=>'message',
        'placeholder'=>'Agora crie uma pequena estória legal para sua aventura!',
    	'rows'=>'3']) !!}
</div>



<!-- Id Creator Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::hidden('id_user', auth()->user()->id, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->

