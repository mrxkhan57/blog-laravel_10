@extends('backend.layouts.app')

@section('style')
@endsection

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-2">

      </div>

      <div class="col-lg-8" style="margin-top:55px;">
        @include('layouts._message')
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Account Setting</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="col-12">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" class="form-control" value='{{$getUser->name}}'  name="name" id="inputName"  required>
              </div>

              <div class="col-12">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" value='{{$getUser->email}}'  name="email" id="inputEmail"  required>
              </div>

              <div class="col-12">
                <label for="inputProfile" class="form-label">Profile</label>
                <input type="file" class="form-control"  name="profile_pic" id="inputProfile">
                <img src="{{$getUser->getProfile()}}" style="margin-top: 10px;">
              </div>


              <div class="text-center">
                <button type="submit" class="btn btn-primary">Update Setting</button>
                <button type="reset" class="btn btn-secondary" onclick="resetForm()">Reset</button>
              </div>
            </form><!-- Vertical Form -->

          </div>
        </div>


      </div>
    </div>
  </section>
@endsection

@section('script')
<script>
    function resetForm() {
  document.getElementById('inputName').value = '';
  document.getElementById('inputEmail').value = '';
  document.getElementById('inputProfile').value = '';
  document.querySelectorAll('.form-control').forEach(element => {
    element.classList.remove('is-invalid');
  });
  document.querySelectorAll('.invalid-feedback').forEach(element => {
    element.style.display = 'none';
  });
  document.querySelectorAll('input, select').forEach(element => {
    element.defaultValue = '';
  });
}
  </script>
@endsection
