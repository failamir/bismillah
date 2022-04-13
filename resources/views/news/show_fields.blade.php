<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/news.fields.id').':') !!}
    <p>{{ $news->id }}</p>
</div>

<!-- Tittle Field -->
<div class="form-group">
    {!! Form::label('tittle', __('models/news.fields.tittle').':') !!}
    <p>{{ $news->tittle }}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', __('models/news.fields.content').':') !!}
    <p>{{ $news->content }}</p>
</div>

<!-- Writer Field -->
<div class="form-group">
    {!! Form::label('writer', __('models/news.fields.writer').':') !!}
    <p>{{ $news->writer }}</p>
</div>

<!-- Published Field -->
<div class="form-group">
    {!! Form::label('published', __('models/news.fields.published').':') !!}
    <p>{{ $news->published }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/news.fields.created_at').':') !!}
    <p>{{ $news->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/news.fields.updated_at').':') !!}
    <p>{{ $news->updated_at }}</p>
</div>

