@extends('layouts.custom')

@section('content')
    <div class="row bg-info text-light">
        <div class="col">
            <section class="py-4 py-xl-5">
                <div class="text-center p-4 p-lg-5">
                    {{-- <p class="fw-bold text-primary mb-2">Proud to introduce</p> --}}
                    <h1 class="fw-bold mb-4">SMK BISA!<br />SMK HEBAT!</h1>



                    @auth
                        <a class="btn btn-primary fs-5 py-2 px-4" href="{{ route('admin.home') }}" role="button">Dashboard</a>
                    @else
                        <a class="btn btn-primary fs-5 me-2 py-2 px-4" href="{{ route('login') }}" role="button">Login</a>
                        <a class="btn btn-light fs-5 py-2 px-4" href="{{ route('register') }}" role="button">Register</a>
                    @endauth
                </div>
            </section>
        </div>
    </div>




    <div class="row mb-5 mt-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>Sekolah</h2>
            <p class="w-lg-50">List sekolah pilihan Anda</p>
        </div>
    </div>




    <livewire:home />
@endsection
