<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/andris.fields.id').':') !!}
    <p>{{ $andri->id }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', __('models/andris.fields.image').':') !!}
    <p>{{ $andri->image }}</p>
</div>

<!-- File Field -->
<div class="col-sm-12">
    {!! Form::label('file', __('models/andris.fields.file').':') !!}
    <p>{{ $andri->file }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/andris.fields.created_at').':') !!}
    <p>{{ $andri->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/andris.fields.updated_at').':') !!}
    <p>{{ $andri->updated_at }}</p>
</div>

