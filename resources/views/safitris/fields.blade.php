<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', __('models/safitris.fields.image').':') !!}
    {!! Form::file('image') !!}
</div>
<div class="clearfix"></div>

<!-- File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file', __('models/safitris.fields.file').':') !!}
    {!! Form::file('file') !!}
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('safitris.index') }}" class="btn btn-light">@lang('crud.cancel')</a>
</div>
