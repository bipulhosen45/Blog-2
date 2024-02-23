 <!-- form start -->
 <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="title" class="form-control" name="title" id="title" placeholder="Input your slider title">
      </div>
      <div class="form-group">
        <label for="sub_title">Sub Title</label>
        <input type="sub_title" class="form-control" name="sub_title" id="sub_title" placeholder="Input your sub title">
      </div>
      <div class="form-group">
        <label for="image">File input</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="image" name="image">
            <label class="custom-file-label" for="image">Choose file</label>
          </div>
          <div class="input-group-append">
            <button type="submit" class="input-group-text">Upload</button>
          </div>
        </div>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <input type="submit" class="btn btn-primary float-right" value="Create">
      <a href="{{route('slider.index')}}" class="btn btn-warning float-right mx-2"><i class="fas fa-arrow-circle-left"></i></a>
    </div>
  </form>