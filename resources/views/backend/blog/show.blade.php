@extends('backend.layouts.app')

@section('style')
@endsection

@section('content')
    <div class="pagetitle">
      <h1>Blogs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('panel/dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Blog</li>
        </ol>
      </nav>
    </div>

      <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">



                @include('layouts._message')

                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">№</th>
                      <th scope="col" style="text-align: center">Image</th>
                      <th scope="col">Username</th>
                      <th scope="col">Title</th>
                      <th scope="col">Category</th>
                      <th scope="col">Description</th>
                      <th scope="col">Created at</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                      <tr>
                        <th scope="row">{{$getRecord->id}}</th>
                        <td align="center">
                            @if(!empty($getRecord->getImage()))
                            <img src="{{$getRecord->getImage()}}" style="height:100px; weight:50px;"
                            @endif >
                        </td>
                        <td>{{$user_name}}</td>
                        <td>{{$getRecord->title}}</td>
                        <td>{{$category_name}}</td>
                        <td>{!! strip_tags($getRecord->description) !!}</td>
                        <td>{{date('H:i A', strtotime($getRecord->created_at))}} <br> {{date('d-m-Y', strtotime($getRecord->created_at))}}</td>

                        <td>
                            <a href="{{url('panel/blog/list/')}}" class="btn btn-primary btn-sm">Back</a>
                        </td>
                      </tr>

                  </tbody>
                </table>



              </div>
            </div>

          </div>
        </div>
      </section>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);
    });
</script>
@endsection
