@extends('backend.layouts.app')
@section('contents')
    <div class="h-screen flex flex-col items-center justify-center pb-[10rem]">
        <img class="!h-[4rem]" src="{{ asset('assets/images/frontend.png') }}" alt="">
        <h1
            class="flex flex-col !my-18 font-extrabold !text-6xl text-center !bg-gradient-to-r !from-[#247CAF] !to-[#09AA8E] !text-transparent !bg-clip-text">
            <span>Welcome to</span>
            <span>Electrifying Australia</span>
        </h1>
    </div>
@endsection
