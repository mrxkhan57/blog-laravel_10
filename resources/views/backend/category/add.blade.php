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
            <h5 class="card-title">Add new Category</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="" method="post">
                {{ csrf_field() }}
              <div class="col-12">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" class="form-control" value="{{old('name')}}" name="name" id="inputName" placeholder="Enter name" required>
                <div style="color:red">{{$errors->first('name')}}</div>
              </div>

              {{--<div class="col-12">
                <label for="inputSlug" class="form-label">Slug</label>
                <input type="text" class="form-control" value="{{old('slug')}}" name="slug" id="inputSlug" placeholder="Enter slug" required>
                <div style="color:red">{{$errors->first('name')}}</div>
              </div>--}}

              <div class="col-12">
                <label for="inputTitle" class="form-label">Title</label>
                <input type="text" class="form-control" value="{{old('title')}}" name="title" id="inputTitle" placeholder="Enter title" required>
                <div style="color:red">{{$errors->first('title')}}</div>
              </div>

              <hr>

              <div class="col-12">
                <label for="inputMetaTitle" class="form-label">Meta Title</label>
                <input type="text" class="form-control" value="{{old('meta_title')}}" name="meta_title" id="inputMetaTitle" placeholder="Enter meta title" required>
                <div style="color:red">{{$errors->first('meta_title')}}</div>
              </div>

              <div class="col-12">
                <label for="inputMetaDescription" class="form-label">Meta Description</label>
                <textarea class="form-control" name="meta_description" id="inputMetaDescription" placeholder="Enter meta description" required> </textarea>
                <div style="color:red">{{$errors->first('meta_description')}}</div>
              </div>

              <div class="col-12">
                <label for="inputMetaKeyword" class="form-label">Meta Keyword</label>
                <input type="text" class="form-control" value="{{old('meta_keywords')}}" name="meta_keywords" id="inputMetaKeyword" placeholder="Enter meta keywords" required>
                <div style="color:red">{{$errors->first('meta_keywords')}}</div>
              </div>

              <hr>

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
  document.getElementById('inputSlug').value = '';
  document.getElementById('inputTitle').value = '';
  document.getElementById('inputMetaTitle').value = '';
  document.getElementById('inputMetaDescription').value = '';
  document.getElementById('inputMetaKeyword').value = '';
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
