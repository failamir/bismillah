<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/contohs.fields.id').':') !!}
    <p>{{ $contoh->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/contohs.fields.name').':') !!}
    <p>{{ $contoh->name }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', __('models/contohs.fields.image').':') !!}
    <p>{{ $contoh->image }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/contohs.fields.created_at').':') !!}
    <p>{{ $contoh->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/contohs.fields.updated_at').':') !!}
    <p>{{ $contoh->updated_at }}</p>
</div>

