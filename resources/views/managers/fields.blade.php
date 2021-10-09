<!-- Qwerty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qwerty', __('models/managers.fields.qwerty').':') !!}
    {!! Form::text('qwerty', null, ['class' => 'form-control']) !!}
</div>

<!-- Asdf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('asdf', __('models/managers.fields.asdf').':') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('asdf', ['class' => 'custom-file-input']) !!}
            {!! Form::label('asdf', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>


<!-- Laila Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('laila_id', __('models/managers.fields.laila_id').':') !!}
    {!! Form::number('laila_id', null, ['class' => 'form-control']) !!}
</div>