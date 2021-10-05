<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/zulans.fields.id').':') !!}
    <p>{{ $zulan->id }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', __('models/zulans.fields.image').':') !!}
    <p>{{ $zulan->image }}</p>
</div>

<!-- Photo Field -->
<div class="col-sm-12">
    {!! Form::label('photo', __('models/zulans.fields.photo').':') !!}
    <p>{{ $zulan->photo }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/zulans.fields.created_at').':') !!}
    <p>{{ $zulan->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/zulans.fields.updated_at').':') !!}
    <p>{{ $zulan->updated_at }}</p>
</div>

