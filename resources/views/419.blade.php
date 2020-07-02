@extends('layout')

@section('title')
Can Not Process
@endsection

@section('content')
    <h1 class="my-16 p-16 rounded-lg border md:w-1/2 mx-auto text-xl md:text-3xl text-gray-500">
        419 | CAN NOT PROCESS
    </h1>

    @if(isset($message))
    <div class="">
        {{ $message }}
    </div>
    @endif
@endsection
