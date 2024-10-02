@extends('backend.layouts.app')

@section('style')
@endsection

@section('content')
    <div class="pagetitle">
      <h1>Dashboard</div></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    {{--@if(session()->has('welcome') && !session()->has('welcome_shown'))
    <div class="alert alert-success" id="welcome-message">{{ session()->get('welcome') }}</div>
    {{ session()->put('welcome_shown', true) }}
    <script>
        setTimeout(function(){
            document.getElementById("welcome-message").remove();
        }, 2000); // remove the message after 2 seconds
    </script>
    @endif--}}

    
@endsection

@section('script')
@endsection
