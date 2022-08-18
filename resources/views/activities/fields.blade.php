<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descrição:') !!}
    {!! Form::text('description', null,
        ['class' => 'form-control',
        'placeholder'=>'Descrição da Atividade']) !!}
</div>
<!-- Id Creator Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::hidden('id_user', auth()->user()->id, ['class' => 'form-control']) !!}
</div>