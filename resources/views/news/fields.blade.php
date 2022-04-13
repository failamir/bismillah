<!-- Tittle Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tittle', __('models/news.fields.tittle').':') !!}
    {!! Form::text('tittle', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-6">
    {!! Form::label('content', __('models/news.fields.content').':') !!}
    {!! Form::text('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Writer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('writer', __('models/news.fields.writer').':') !!}
    {!! Form::text('writer', null, ['class' => 'form-control']) !!}
</div>

<!-- Published Field -->
<div class="form-group col-sm-6">
    {!! Form::label('published', __('models/news.fields.published').':') !!}
    {!! Form::date('published', null, ['class' => 'form-control','id'=>'published']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#published').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('news.index') }}" class="btn btn-light">@lang('crud.cancel')</a>
</div>
