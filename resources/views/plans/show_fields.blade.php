<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/plans.fields.id').':') !!}
    <p>{{ $plan->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/plans.fields.name').':') !!}
    <p>{{ $plan->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/plans.fields.description').':') !!}
    <p>{{ $plan->description }}</p>
</div>

<!-- Max Sender Field -->
<div class="form-group">
    {!! Form::label('max_sender', __('models/plans.fields.max_sender').':') !!}
    <p>{{ $plan->max_sender }}</p>
</div>

<!-- Max Contact Field -->
<div class="form-group">
    {!! Form::label('max_contact', __('models/plans.fields.max_contact').':') !!}
    <p>{{ $plan->max_contact }}</p>
</div>

<!-- Max Media Size Field -->
<div class="form-group">
    {!! Form::label('max_media_size', __('models/plans.fields.max_media_size').':') !!}
    <p>{{ $plan->max_media_size }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', __('models/plans.fields.price').':') !!}
    <p>{{ $plan->price }}</p>
</div>

<!-- Is Active Field -->
<div class="form-group">
    {!! Form::label('is_active', __('models/plans.fields.is_active').':') !!}
    <p>{{ $plan->is_active }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/plans.fields.created_at').':') !!}
    <p>{{ $plan->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/plans.fields.updated_at').':') !!}
    <p>{{ $plan->updated_at }}</p>
</div>

