@extends('layouts.app')

@push('styles')
<style type="text/css">

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.refresh {
    animation: rotate 1.5s linear infinite ;
}

</style>

@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Game') }}</div>

                <div class="text-center">
                    <img class="refresh" id="circle" src="{{ asset('img/circle.png') }}" height="250" width="250">
                    <p class="display-1 d-none text-primary"></p>
                </div>

                <hr>
                <div class="text-center">
                    <label class="font-weight-bold h5"> your bet</label>
                    <select class="custom-select col-auto">
                        <option selected>Not in</option>

                        @foreach (range(1 , 12) as $number )
                             <option>{{ $number }}</option>
                         @endforeach

                    </select>
                    <hr>
                    <p class="font-weight-bold h5"> Remaining Time</p>
                    <p id="timer" class="h5 text-danger"> Waiting to start</p>
                    <hr>
                    <p id="result" class="h1"></p>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')


@endpush

