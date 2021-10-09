<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/pegawais.fields.id').':') !!}
    <p>{{ $pegawai->id }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', __('models/pegawais.fields.image').':') !!}
    <p>{{ $pegawai->image }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/pegawais.fields.created_at').':') !!}
    <p>{{ $pegawai->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/pegawais.fields.updated_at').':') !!}
    <p>{{ $pegawai->updated_at }}</p>
</div>

