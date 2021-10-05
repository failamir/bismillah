<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/lailas.fields.id').':') !!}
    <p>{{ $laila->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/lailas.fields.name').':') !!}
    <p>{{ $laila->name }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', __('models/lailas.fields.image').':') !!}
    <p>{{ $laila->image }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/lailas.fields.created_at').':') !!}
    <p>{{ $laila->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/lailas.fields.updated_at').':') !!}
    <p>{{ $laila->updated_at }}</p>
</div>

