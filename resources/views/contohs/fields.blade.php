<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/contohs.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', __('models/contohs.fields.image').':') !!}
    {!! Form::file('image') !!}
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('contohs.index') }}" class="btn btn-light">@lang('crud.cancel')</a>
</div>
