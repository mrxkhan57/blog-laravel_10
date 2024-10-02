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
            <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="col-12">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="inputTitle" placeholder="Enter title" required>
              </div>

              <div class="col-12">
                <label class="form-label">Category</label>
                <select class="form-control" name="category_id" id="selectCategory">
                    <option> Select category </option>
                    @foreach($getCategory as $value)
                    <option value="{{$value->id}}"> {{$value->name}} </option>
                    @endforeach
                </select>
              </div>

              <div class="col-12">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="image_file" id="inputImage" placeholder="Upload image" required>
              </div>

              <div class="col-12">
                <label for="inputDescription" class="form-label">Description</label>
                <textarea class="form-control tinymce-editor" name="description" id="inputDescription" placeholder="Enter description" required> </textarea>
              </div>

              <div class="col-12">
                <label class="form-label">Tags</label>
                <input type="text" class="form-control" name="tags" id="inputTags" placeholder="Enter tags" required>
              </div>

              <hr>

              <div class="col-12" style="margin-top: -3px;">
                <label for="inputMetaDescription" class="form-label">Meta Description</label>
                <textarea class="form-control " name="meta_description" id="inputMetaDescription" placeholder="Enter meta description" required> </textarea>
              </div>

              <div class="col-12">
                <label class="form-label">Meta Keywords</label>
                <input type="text" class="form-control" name="meta_keywords" id="inputMetaKeywords" placeholder="Enter meta keywords" required>
              </div>

              <hr>
            @if(Auth::user()->is_admin == 1)
              <div class="col-12" style="margin-top: -3px;">
                <label for="inputPublish" class="form-label">Publish</label>
                    <select class="form-control" name="is_publish">
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Non published <i class="fas fa-times-circle text-danger"></i></option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Published <i class="fas fa-check-circle text-success"></i></option>
                    </select>
              </div>

              <div class="col-12">
                <label for="inputStatus" class="form-label">Status</label>
                    <select class="form-control" name="status">
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive <i class="fas fa-times-circle text-danger"></i></option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active <i class="fas fa-check-circle text-success"></i></option>
                    </select>
              </div>
              @endif
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
  document.getElementById('inputTitle').value = '';
  document.getElementById('selectCategory').value = '';
  document.getElementById('inputImage').value = '';
  document.getElementById('inputDescription').value = '';
  document.getElementById('inputTags').value = '';
  document.getElementById('inputMetaDescription').value = '';
  document.getElementById('inputMetaKeywords').value = '';
  document.querySelector('select[name="publish"]').value = 0;
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
