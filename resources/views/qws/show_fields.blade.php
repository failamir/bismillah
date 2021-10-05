<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/qws.fields.id').':') !!}
    <p>{{ $qw->id }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', __('models/qws.fields.image').':') !!}
    <p>{{ $qw->image }}</p>
</div>

<!-- File Field -->
<div class="col-sm-12">
    {!! Form::label('file', __('models/qws.fields.file').':') !!}
    <p>{{ $qw->file }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/qws.fields.created_at').':') !!}
    <p>{{ $qw->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/qws.fields.updated_at').':') !!}
    <p>{{ $qw->updated_at }}</p>
</div>

