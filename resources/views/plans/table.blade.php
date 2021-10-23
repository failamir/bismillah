@section('css')
    @include('layouts.datatables_css')
@endsection
<<<<<<< HEAD

=======
@dump($dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']))
>>>>>>> fix
{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

@push('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush