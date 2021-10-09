<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/anis.fields.id').':') !!}
    <p>{{ $anis->id }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', __('models/anis.fields.image').':') !!}
    <p>{{ $anis->image }}</p>
</div>

<!-- File Field -->
<div class="col-sm-12">
    {!! Form::label('file', __('models/anis.fields.file').':') !!}
    <p>{{ $anis->file }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/anis.fields.created_at').':') !!}
    <p>{{ $anis->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/anis.fields.updated_at').':') !!}
    <p>{{ $anis->updated_at }}</p>
</div>

