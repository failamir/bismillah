<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/safitris.fields.id').':') !!}
    <p>{{ $safitri->id }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', __('models/safitris.fields.image').':') !!}
    <p>{{ $safitri->image }}</p>
</div>

<!-- File Field -->
<div class="form-group">
    {!! Form::label('file', __('models/safitris.fields.file').':') !!}
    <p>{{ $safitri->file }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/safitris.fields.created_at').':') !!}
    <p>{{ $safitri->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/safitris.fields.updated_at').':') !!}
    <p>{{ $safitri->updated_at }}</p>
</div>

