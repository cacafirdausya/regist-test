@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">Fibonacci</h1>
        </div>

        <!-- Overflow Hidden -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Fibonacci</h6>
            </div>
            <div class="card-body">
                <form id="fibonacciForm">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="labels">Rows</label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" name="row" id="row" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="labels">Columns</label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" name="column" id="column" class="form-control" required>
                    </div>
                </div>


                <div class="mt-5 text-right">
                    <button id="btn" class="btn btn-primary" type="submit">
                        Submit</button>
                </div>


                <h5>OUTPUT: </h5>
                <div class="table-responsive" id="table-output"></div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')

    <script>
        document.getElementById('fibonacciForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const rowCount = document.getElementById('row').value;
            const columnCount = document.getElementById('column').value;

            document.getElementById('table-output').innerHTML = '';

            axios.get('/api/getFibonacci', {
                params: {
                    rowCount: rowCount,
                    columnCount: columnCount
                }
            })
                .then(function (response) {
                    // Append the returned table to the div
                    document.getElementById('table-output').innerHTML = response.data.table;
                })
                .catch(function (error) {
                    console.error(error);
                });
        });
    </script>
@endpush

