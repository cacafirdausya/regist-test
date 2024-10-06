@extends('layouts.app')


@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">User Management</h1>
        </div>

        <!-- Overflow Hidden -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New User</h6>
            </div>
            <div class="card-body">

                <form method="POST" enctype="multipart/form-data" action="{{ route('users.store') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="labels">Username</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="username" id="username" class="form-control uppercase"
                                        value="{{ old('username') }}" required>
                                    @if ($errors->has('username'))
                                        <span class="text-danger">
                                            {{ $errors->first('username') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="labels">Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" class="form-control uppercase"
                                        value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">
                                            {{ $errors->first('name') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="labels">Email</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" name="email" id="email" class="form-control uppercase"
                                        value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="labels">Password</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control"
                                            value="{{ old('password') }}" required>
                                        <button type="button" id="togglePassword" class="btn">
                                            <i class="ri-eye-fill" id="passwordIcon"></i>
                                        </button>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="mt-5 text-right">
                                <a id="btn" class="btn btn-danger" href="{{ route('users.index') }}">
                                    Cancel</a>
                                <button id="btn" class="btn btn-primary" type="submit">
                                    Submit</button>
                            </div>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection


<script src="https://cdn.jsdelivr.net/npm/@flasher/flasher@latest/dist/flasher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@push('js')
    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
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
                        data: 'email',
                        name: 'email'
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

        });
    </script>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const passwordIcon = document.querySelector('#passwordIcon');

        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            if (type === 'password') {
                passwordIcon.classList.remove('ri-eye-fill');
                passwordIcon.classList.add('ri-eye-off-fill');
            } else {
                passwordIcon.classList.remove('ri-eye-off-fill');
                passwordIcon.classList.add('ri-eye-fill');
            }
        });
    </script>
@endpush
