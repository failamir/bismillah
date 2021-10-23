@section('css')
    @include('layouts.datatables_css')
@endsection
@dump($dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']))

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

@push('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush