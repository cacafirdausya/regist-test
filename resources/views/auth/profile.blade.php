@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">Profile</h1>
        </div>

        <!-- Overflow Hidden -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 border-right">
                        <div class="row" id="res"></div>
                        <div class="row mt-2">

                            <div class="col-md-4">
                                <label class="labels">Username</label>
                                <input type="text" name="username" class="form-control"
                                    value="{{ auth()->user()->username }}">
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ auth()->user()->name }}">
                            </div>
                            <div class="col-md-4">
                                <label class="labels">Email</label>
                                <input type="text" name="email" class="form-control"
                                    value="{{ auth()->user()->email }}">
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/@flasher/flasher@latest/dist/flasher.min.js"></script>
