@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>     
                @endif 
                <div class="card-body">
                    <div class="input-group mb-3">
                    <div class="input-group-append">
                        <a class="btn btn-primary" href="{{ route('transaction') }}">Create a New Transaction</a>
                      </div>
                    </div>
    
                    <table class="table table-bordered data-table" id="DataTables_Table_0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Balance</th>
                                <th>Description</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
    
                        <tbody>
                        </tbody>
                    </table>
                </div>              
            </div>
        </div>
    </div>    
</div>
<script type="text/javascript">
    $(function() {
        const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'IDR',
        });
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('dashboard') }}"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'transaction_type',
                    name: 'transaction_type'
                },
                {
                    data: 'amount',
                    name: 'amount',
                    render: function(data, type, row) {
                    return '<div style="text-align: right;">' + formatter.format(data) + '</div>';
                    }
                },
                {
                    data: 'balance',
                    name: 'balance',
                    render: function(data, type, row) {
                    return '<div style="text-align: right;">' + formatter.format(data) + '</div>';
                    }
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    
    });
    </script>
    
    
@endsection