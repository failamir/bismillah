<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/plans.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/plans.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Max Sender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_sender', __('models/plans.fields.max_sender').':') !!}
    {!! Form::text('max_sender', null, ['class' => 'form-control']) !!}
</div>

<!-- Max Contact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_contact', __('models/plans.fields.max_contact').':') !!}
    {!! Form::text('max_contact', null, ['class' => 'form-control']) !!}
</div>

<!-- Max Media Size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_media_size', __('models/plans.fields.max_media_size').':') !!}
    {!! Form::text('max_media_size', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', __('models/plans.fields.price').':') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_active', __('models/plans.fields.is_active').':') !!}
    {!! Form::text('is_active', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('plans.index') }}" class="btn btn-light">@lang('crud.cancel')</a>
</div>
