@extends('backend.layouts.app')

@section('style')
@endsection

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-2">

      </div>

      <div class="col-lg-8" style="margin-top:55px;">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add new User</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="" method="post">
                {{ csrf_field() }}
              <div class="col-12">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" class="form-control" value="{{old('name')}}" name="name" id="inputName" placeholder="Enter full name" required>
                <div style="color:red">{{$errors->first('name')}}</div>
              </div>

              <div class="col-12">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" value="{{old('email')}}" name="email" id="inputEmail" placeholder="Enter email" required>
                <div style="color:red">{{$errors->first('email')}}</div>
              </div>

              <div class="col-12">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Enter password" required>
               </div>

              <div class="col-12">
                <label for="inputStatus" class="form-label">Status</label>
                    <select class="form-control" name="status">
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive <i class="fas fa-times-circle text-danger"></i></option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active <i class="fas fa-check-circle text-success"></i></option>
                    </select>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
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
  document.getElementById('inputPassword').value = '';
  document.querySelector('select[name="status"]').value = 0;
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
