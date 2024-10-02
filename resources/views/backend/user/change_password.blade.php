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
            <h5 class="card-title">Change Password</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="" method="post">
                {{ csrf_field() }}
              <div class="col-12">
                <label for="inputOPassword" class="form-label">Old password</label>
                <input type="password" class="form-control"  name="old_password" id="inputOPassword"  required>
              </div>

              <div class="col-12">
                <label for="inputNPassword" class="form-label">New password</label>
                <input type="password" class="form-control"  name="new_password" id="inputNPassword" required>
              </div>

              <div class="col-12">
                <label for="inputCPassword" class="form-label">Confirm password</label>
                <input type="password" class="form-control" name="confirm_password" id="inputCPassword" required>
               </div>
               @if(Auth::user()->is_admin==1)
              <div class="col-12">
                <label for="inputStatus" class="form-label">Status</label>
                    <select class="form-control" name="status">
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive <i class="fas fa-times-circle text-danger"></i></option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active <i class="fas fa-check-circle text-success"></i></option>
                    </select>
              </div>
              @endif
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Update Password</button>
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
  document.getElementById('inputOPassword').value = '';
  document.getElementById('inputNPassword').value = '';
  document.getElementById('inputCPassword').value = '';
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
