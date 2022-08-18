<!-- Message Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => '10']) !!}
</div>
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::hidden('id_user', auth()->user()->id, ['class' => 'form-control']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
</div>
