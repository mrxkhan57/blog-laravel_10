@extends('backend.layouts.app')

@section('style')
@endsection

@section('content')
    <div class="pagetitle">
      <h1>Blogs</h1>
      <h4 style="font-weight: bold;
                color: #0A64DAFF;
                font-size: 18px ";>Total:{{$getRecord->total()}}</h4>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('panel/dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Blog</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

      <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Add new Blog</h5>
                <a href="{{url('panel/blog/add/')}}" class="btn btn-primary" style="float: right;margin-top: -55px;"> Add new </a>

                <form class="row" accept="get">
                    <div class="col-md-1" style="margin-bottom: 5px;">
                      <label class="form-label">ID</label>
                      <input type="text" name="id" value="{{Request::get('id')}}" class="form-control" >
                    </div>
                    @if(Auth::user()->is_admin == 1)
                    <div class="col-md-2" style="margin-bottom: 5px;">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" value="{{Request::get('username')}}" class="form-control" >
                    </div>
                    @endif
                    <div class="col-md-3" style="margin-bottom: 5px;">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{Request::get('title')}}" class="form-control" >
                    </div>
                    <div class="col-md-2" style="margin-bottom: 5px;">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" value="{{Request::get('category')}}" class="form-control" >
                    </div>
                    @if(Auth::user()->is_admin == 1)
                    <div class="col-md-2" style="margin-bottom: 5px;">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status">
                            <option value="">Select </option>
                            <option {{(Request::get('status') == 1) ? 'selected' : ''}} value="1">Active </option>
                            <option {{(Request::get('status') == 100) ? 'selected' : ''}} value="100">Inactive </option>

                        </select>
                    </div>

                    <div class="col-md-2" style="margin-bottom: 5px;">
                        <label class="form-label">Publish</label>
                        <select class="form-control" name="is_publish">
                            <option value="">Select </option>
                            <option {{(Request::get('is_publish') == 1) ? 'selected' : ''}} value="1">Yes </option>
                            <option {{(Request::get('is_publish') == 100) ? 'selected' : ''}} value="100">No </option>
                        </select>
                    </div>
                    @endif

                    <div class="col-md-2" style="margin-bottom: 5px;">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" value="{{Request::get('start_date')}}" class="form-control" >
                    </div>
                    <div class="col-md-2" style="margin-bottom: 5px;">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" value="{{Request::get('end_date')}}" class="form-control" >
                    </div>

                    <div class="col-md-3" style="margin-left:467px;">
                        <label class="form-label" style="display: flex;">&nbsp;</label>
                        <button type="submit" class="btn btn-primary" style="margin-left: 100px;">Search</button>
                        <a href="{{ url('panel/blog/list') }}" type="reset"
                        class="btn btn-secondary"
                        style="margin-left: 5px;">Reset</a>
                    </div>


                  </form>

                <hr/>
                @include('layouts._message')
                <!-- Table with stripped rows -->
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">№</th>
                      <th scope="col" style="text-align: center">Image</th>
                      @if(Auth::user()->is_admin == 1)
                      <th scope="col">Username</th>
                      @endif
                      {{--<th scope="col">Slug</th>--}}
                      <th scope="col">Title</th>
                      <th scope="col">Category</th>
                      {{--<th scope="col">Description</th>
                      <th scope="col">Tags</th>
                      <th scope="col">Meta Description</th>
                      <th scope="col">Meta Keywords</th>--}}
                      @if(Auth::user()->is_admin == 1)
                      <th scope="col">Status</th>
                      <th scope="col">Publish</th>
                      @endif
                      <th scope="col">Created at</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @forelse($getRecord as $value)
                      <tr>
                        <th scope="row">{{$value->id}}</th>
                        <td align="center">
                            @if(!empty($value->getImage()))
                            <img src="{{$value->getImage()}}" style="height:100px; weight:50px;"
                            @endif >
                        </td>
                        @if(Auth::user()->is_admin == 1)
                        <td>{{$value->user_name}}</td>
                        @endif
                        {{--<td>{{$value->slug}}</td>--}}
                        <td>{{$value->title}}</td>
                        <td>{{$value->category_name}}</td>
                        {{--<td>{{$value->description}}</td>
                        <td>{{$value->tags}}</td>
                        <td>{{$value->meta_description}}</td>
                        <td>{{$value->meta_keywords}}</td>--}}
                        @if(Auth::user()->is_admin == 1)
                        <td>{{$value->status}}</td>
                        <td>{{$value->is_publish}}</td>
                        @endif
                        <td>{{date('H:i A', strtotime($value->created_at))}} <br> {{date('d-m-Y', strtotime($value->created_at))}}</td>
                        {{--<td>{{date('H:i A d-m-Y ', strtotime($value->created_at))}}</td>--}}

                        <td>
                            <a href="{{url('panel/blog/show/'.$value->id)}}" class="btn btn-info btn-sm">Show</a>
                            @if(Auth::user()->is_admin==1)
                            <a href="{{url('panel/blog/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <a onclick="return confirm('Are you sure delete the user?');" href="{{url('panel/blog/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
                            @endif
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
