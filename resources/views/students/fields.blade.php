<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    {!! Form::number('id', null, ['class' => 'form-control']) !!}
</div>

<!-- Id User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_user', 'Id User:') !!}
    {!! Form::number('id_user', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Current Adventure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_current_adventure', 'Id Current Adventure:') !!}
    {!! Form::number('id_current_adventure', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Current Module Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_current_module', 'Id Current Module:') !!}
    {!! Form::number('id_current_module', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Current Activity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_current_activity', 'Id Current Activity:') !!}
    {!! Form::number('id_current_activity', null, ['class' => 'form-control']) !!}
</div>

<!-- Adventure Ended Field -->
<div class="form-group col-sm-6">
    {!! Form::label('adventure_ended', 'Adventure Ended:') !!}
    {!! Form::text('adventure_ended', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Weakest Module Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_weakest_module', 'Id Weakest Module:') !!}
    {!! Form::number('id_weakest_module', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Weakest Activity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_weakest_activity', 'Id Weakest Activity:') !!}
    {!! Form::number('id_weakest_activity', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Teacher Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_teacher', 'Id Teacher:') !!}
    {!! Form::number('id_teacher', null, ['class' => 'form-control']) !!}
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    {!! Form::date('created_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    {!! Form::date('updated_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('students.index') !!}" class="btn btn-default">Cancel</a>
</div>
