@extends('layouts.app')

@section('title', 'Profile - E-Books')

@section('content')
{{-- Side Menu --}}
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 ">

            <div class="text-center">
                <img src="{{ asset('image/warentbuff.png') }}" class="rounded-circle" style="width: 150px; height:150px" />
                <h2 class="text-center mt-3">{{ $user['name'] }}</h2>
                <h4 class="text-center mt-3">alamat : {{ $user['alamat'] }}</h4>
                <h4 class="text-center mt-3">Join : {{ $user['created_at'] }}</h4>
                <a class="btn btn-primary text-center mt-2">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
{{-- End Side Menu --}}
@endsection