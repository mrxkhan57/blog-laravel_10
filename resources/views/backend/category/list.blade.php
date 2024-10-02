@extends('backend.layouts.app')

@section('style')
@endsection

@section('content')
    <div class="pagetitle">
      <h1>Categories</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('panel/dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Category</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

      <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Add new Category</h5>
                <a href="{{url('panel/category/add/')}}" class="btn btn-primary" style="float: right;margin-top: -55px;"> Add new </a>
                @include('layouts._message')
                <!-- Table with stripped rows -->
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">№</th>
                      <th scope="col">Name</th>
                      <th scope="col">Slug</th>
                      <th scope="col">Title</th>
                      <th scope="col">Meta Title</th>
                      <th scope="col">Meta Description</th>
                      <th scope="col">Meta Keywords</th>
                      <th scope="col">Status</th>
                      <th scope="col">Created at</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @forelse($getRecord as $value)
                      <tr>
                        <th scope="row">{{$value->id}}</th>
                        <td>{{$value->name}}</td>
                        <td>{{$value->slug}}</td>
                        <td>{{$value->title}}</td>
                        <td>{{$value->meta_title}}</td>
                        <td>{{$value->meta_description}}</td>
                        <td>{{$value->meta_keywords}}</td>
                        <td>{{$value->status}}</td>
                        <td>{{date('T H:i A  D d-m-Y', strtotime($value->created_at))}}</td>
                        <td>
                            <a href="{{url('panel/category/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <a onclick="return confirm('Are you sure delete the user?');" href="{{url('panel/category/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                      </tr>
                    @empty
                        <tr>
                            <td colspan="100%"> Record not found </td>
                        </tr>
                    @endforelse

                  </tbody>
                </table>

                    {!!$getRecord->appends("Illuminate\Support\Facedes\Request::except('page')")->links()!!}

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
