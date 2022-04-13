<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/beritas.fields.id').':') !!}
    <p>{{ $berita->id }}</p>
</div>

<!-- Judul Field -->
<div class="form-group">
    {!! Form::label('judul', __('models/beritas.fields.judul').':') !!}
    <p>{{ $berita->judul }}</p>
</div>

<!-- Konten Field -->
<div class="form-group">
    {!! Form::label('konten', __('models/beritas.fields.konten').':') !!}
    <p>{{ $berita->konten }}</p>
</div>

<!-- Penults Field -->
<div class="form-group">
    {!! Form::label('penults', __('models/beritas.fields.penults').':') !!}
    <p>{{ $berita->penults }}</p>
</div>

<!-- Tanggal Terbit Field -->
<div class="form-group">
    {!! Form::label('tanggal_terbit', __('models/beritas.fields.tanggal_terbit').':') !!}
    <p>{{ $berita->tanggal_terbit }}</p>
</div>

