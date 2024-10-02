@extends('layouts.app')

@section('style')
@endsection


@section('content')

<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
    <div
      class="d-flex flex-column align-items-center justify-content-center"
      style="min-height: 150px"
    >
      <h3 class="display-3 font-weight-bold text-white">Our News</h3>
      <div class="d-inline-flex text-white">
        <p class="m-0"><a class="text-white" href="/">Home</a></p>
        <p class="m-0 px-2">/</p>
        <p class="m-0">Our News</p>
      </div>
    </div>
  </div>
  <!-- Header End -->

  <!-- Blog Start -->
  <div class="container-fluid pt-5">
    <div class="container">
      <div class="text-center pb-2">
        <p class="section-title px-5">
          <span class="px-2">Latest News</span>
        </p>
        <h1 class="mb-4">Latest Articles From News</h1>
      </div>
      <div class="row pb-3">
        @foreach($getRecord as $value)
        <div class="col-lg-4 mb-4">
          <div class="card border-0 shadow-sm mb-2">
            <img class="card-img-top mb-2" src="{{$value->getImage()}}" style="height:233px; width:100%; object-fit:cover;"alt="" />
            <div class="card-body bg-light text-center p-4">
              <a href="{{url('news/'.$value->slug)}}">
              <h4 class="">{{$value->title}}</h4>
              </a>
              <div class="d-flex justify-content-center mb-3">
                <small class="mr-3"
                  ><i class="fa fa-user text-primary"></i>{{$value->user_name}}</small
                >
                <small class="mr-3"
                  ><i class="fa fa-folder text-primary"></i> {{$value->category_name}} </small
                >
                <small class="mr-3"
                  ><i class="fa fa-comments text-primary"></i> 0</small
                >
              </div>
              <p>
                {!! strip_tags(Str::substr($value->description,0,150))!!}...
              </p>
              <a href="{{url('news/'.$value->slug)}}" class="btn btn-primary px-4 mx-auto my-2"
                >Read More</a
              >
            </div>
          </div>
        </div>
        @endforeach

        <div class="col-md-12 mb-4">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mb-0">
                {!!$getRecord->appends("Illuminate\Support\Facedes\Request::except('page')")->links()!!}
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- Blog End -->

@section('script')
@endsection
@endsection
