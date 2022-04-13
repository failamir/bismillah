<!-- Judul Field -->
<div class="form-group col-sm-6">
    {!! Form::label('judul', __('models/beritas.fields.judul').':') !!}
    {!! Form::text('judul', null, ['class' => 'form-control']) !!}
</div>

<!-- Konten Field -->
<div class="form-group col-sm-6">
    {!! Form::label('konten', __('models/beritas.fields.konten').':') !!}
    {!! Form::text('konten', null, ['class' => 'form-control']) !!}
</div>

<!-- Penults Field -->
<div class="form-group col-sm-6">
    {!! Form::label('penults', __('models/beritas.fields.penults').':') !!}
    {!! Form::text('penults', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Terbit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_terbit', __('models/beritas.fields.tanggal_terbit').':') !!}
    {!! Form::date('tanggal_terbit', null, ['class' => 'form-control','id'=>'tanggal_terbit']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#tanggal_terbit').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('beritas.index') }}" class="btn btn-light">@lang('crud.cancel')</a>
</div>
