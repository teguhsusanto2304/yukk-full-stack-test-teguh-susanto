@extends('auth.layouts')

@section('content')

<div class="row mt-12">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">Create a Transaction</div>
            <div class="card-body">
                <form action="{{ route('transaction') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Type</label>
                        <div class="col-md-3">
                          <select class="form-control @error('transaction_type') is-invalid @enderror" id="transaction_type" name="transaction_type" >
                            <option value="">Select a type</option>
                            <option value="topup" {{ (old('transaction_type')=="topup"?'selected':'') }}>Top Up</option>
                          <option value="transaction" {{ (old('transaction_type')=="transaction"?'selected':'') }}>Transaction</option>
                            </select>
                            @if ($errors->has('transaction_type'))
                                <span class="text-danger">{{ $errors->first('transaction_type') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="amount" class="col-md-4 col-form-label text-md-end text-start">Amount</label>
                        <div class="col-md-4">
                          <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}">
                            @if ($errors->has('amount'))
                                <span class="text-danger">{{ $errors->first('amount') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                        <div class="col-md-4">
                          <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class='mb-12 row g-0'>
                        <div class='col-md-12 w-auto ms-auto'>
                        <a href="{{ route('dashboard') }}" class="btn btn-danger">Back</a>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection