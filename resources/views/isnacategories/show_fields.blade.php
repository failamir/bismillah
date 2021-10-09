<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/isnacategories.fields.id').':') !!}
    <p>{{ $isnacategory->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/isnacategories.fields.name').':') !!}
    <p>{{ $isnacategory->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/isnacategories.fields.created_at').':') !!}
    <p>{{ $isnacategory->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/isnacategories.fields.updated_at').':') !!}
    <p>{{ $isnacategory->updated_at }}</p>
</div>

