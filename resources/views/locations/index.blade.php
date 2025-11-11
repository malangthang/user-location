@extends('layouts.limitless')
@section('title', 'Locations')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Locations</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('locations.create') }}" class="btn btn-primary">Create</a>
                    <form action="{{ route('locations.import') }}" method="post" enctype="multipart/form-data"
                        class="d-inline-flex align-items-center gap-2">
                        @csrf
                        <input type="file" name="csv" accept=".csv,text/csv" class="form-control"
                            style="width:220px">
                        <button type="submit" class="btn btn-outline-primary">Import CSV</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped" id="locations-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <form action="{{ route('locations.importDefault') }}" method="post" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">Import sample from
                        storage/app/locations.csv</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(function() {
        const table = $('#locations-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('api.locations') }}',
            columns: [{
                    title: 'ID',
                    data: 0
                },
                {
                    title: 'Name',
                    data: 1
                },
                {
                    title: 'Address',
                    data: 2
                },
                {
                    title: 'Latitude',
                    data: 3
                },
                {
                    title: 'Longitude',
                    data: 4
                },
                {
                    title: 'Status',
                    data: 5
                },
                {
                    title: 'Actions',
                    data: 0,
                    orderable: false,
                    searchable: false,
                    render: function(id) {
                        const editUrl = '{{ url('/locations') }}/' + id + '/edit';
                        const deleteUrl = '{{ url('/locations') }}/' + id;
                        return `
                        <a href="${editUrl}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="${deleteUrl}" method="post" style="display:inline-block" onsubmit="return confirm('Delete this location?')">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    `;
                    }
                }
            ]
        });
    });
</script>
@endsection
