<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nameModule', 'Nome:') !!}
    {!! Form::text('nameModule', null,
    	['class' => 'form-control',
    	'placeholder'=>'Nome do módulo']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descriptionModule', 'Descrição:') !!}
    {!! Form::text('descriptionModule', null, ['class' => 'form-control',
    	'placeholder'=>'Descrição do módulo']) !!}
</div>

<!-- Topic Field -->
<div class="form-group col-sm-6">
    {!! Form::label('topic', 'Tópico:') !!}
    {!! Form::select('topic', $topics, null, ['class' => 'form-control moduleTopic']) !!}
</div>

<!-- Id Creator Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::hidden('id_user', auth()->user()->id, ['class' => 'form-control']) !!}
</div>
