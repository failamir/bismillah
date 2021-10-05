<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/apis.fields.id').':') !!}
    <p>{{ $api->id }}</p>
</div>

<!-- Qwerty Field -->
<div class="col-sm-12">
    {!! Form::label('qwerty', __('models/apis.fields.qwerty').':') !!}
    <p>{{ $api->qwerty }}</p>
</div>

<!-- Asdf Field -->
<div class="col-sm-12">
    {!! Form::label('asdf', __('models/apis.fields.asdf').':') !!}
    <p>{{ $api->asdf }}</p>
    <a download href="{{ asset($api->asdf) }}">Download</a>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/apis.fields.created_at').':') !!}
    <p>{{ $api->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/apis.fields.updated_at').':') !!}
    <p>{{ $api->updated_at }}</p>
</div>

<!-- Laila Id Field -->
<div class="col-sm-12">
    {!! Form::label('laila_id', __('models/apis.fields.laila_id').':') !!}
    <p>{{ $api->laila_id }}</p>
</div>

