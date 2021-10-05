<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/pembiayaans.fields.id').':') !!}
    <p>{{ $pembiayaan->id }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', __('models/pembiayaans.fields.image').':') !!}
    <p>{{ $pembiayaan->image }}</p>
</div>

<!-- Photo Field -->
<div class="col-sm-12">
    {!! Form::label('photo', __('models/pembiayaans.fields.photo').':') !!}
    <p>{{ $pembiayaan->photo }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/pembiayaans.fields.created_at').':') !!}
    <p>{{ $pembiayaan->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/pembiayaans.fields.updated_at').':') !!}
    <p>{{ $pembiayaan->updated_at }}</p>
</div>

