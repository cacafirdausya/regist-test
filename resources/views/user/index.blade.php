@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">User Management</h1>
        </div>

        <!-- Overflow Hidden -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List User</h6>
            </div>
            <div class="card-body">
                <div class="row ">
                    <div class="col-md-12 mb-4 text-right">
                        <a type="button" class="btn btn-primary" href="{{ route('users.create') }}">
                            Add New User
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table text-center table-bordered data-table" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:1%;">No</th>
                                <th>Name</th>
                                <th>Password</th>
                                <th>Ctime</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@flasher/flasher@latest/dist/flasher.min.js"></script>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script type="text/javascript">
        var table = $('.data-table').DataTable({
            processing: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: null,
                    sortable: false,
                    searchable: false,
                    width: '5%',
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                }, {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'password',
                    name: 'password'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '1%'
                },
            ]
        });

        function confirmAndDelete(title, route, id, bira = null) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(route, {
                            id: id,
                        })
                        .then(function(response) {
                            Swal.fire('Deleted!', 'Your data has been deleted.', 'success');
                            table.ajax.reload();
                        })
                        .catch(function(error) {
                            console.log('Error:', error);
                            Swal.fire('Error!', 'Something went wrong while deleting data.', 'error');
                        });
                }
            });
        }

        function deleteData(id) {
            confirmAndDelete('Are you sure?', "{{ route('users.destroy') }}", id);
        }
    </script>
@endpush
