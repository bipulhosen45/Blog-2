 <!-- form start -->
 <div class="row justify-content-end">
   <div class="col-md-8">
       {{-- <form action="{{ route('profile.store') }}" method="POST" model="{{ $profile }}"> --}}
         {!! Form::model($profile, ['method' => 'post', 'route' => 'profile.store']) !!}
         @csrf
         <div class="card">
          <div class="card-body">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Input phone">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" placeholder="Input Address"></textarea>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="division_id">Division</label>
                        {!! Form::select('division_id', $divisions, null, ['id' => 'division_id','class' => 'form-control','placeholder' => 'Select Division']) !!}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="district_id">District</label>
                        <select name="district_id" id="district_id" disabled class="form-control">
                            <option value="">Select District</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="thana_id">Upazilla</label>
                        <select name="thana_id" class="form-control" disabled id="thana_id">
                            <option value="">Select Thana</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="d-block" style="margin-right: 20px!important;">Gender: </label>
                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio" name="gender" id="male1" value="male">
                        <label class="form-check-label" for="male1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female2" value="female">
                        <label class="form-check-label" for="female2">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="others2" value="others">
                        <label class="form-check-label" for="others2">Others</label>
                    </div>
                </div>

            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
        </div>
        <div class="card-footer">
          <input type="submit" class="btn btn-primary float-right" value="Submit">
          <a href="{{ route('profile.index') }}" class="btn btn-warning float-right mx-2"><i class="fas fa-arrow-circle-left"> </i> Back</a>
         </div>
        </form>
         </div>
        </div>

    
  <div class="col-md-4">
     <div class="card">
      <div class="card-body">
        <div class="form-group">
            <label for="image">Upload Profile Image <span class="text-danger">*</span></label>
            <p id="error_message" class="text-danger"></p>
            <input type="file" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg webp" class="form-control dropify" id="image_input">
            <button class="btn btn-success mt-2" id="image_upload_button">Upload Image</button>
            <img src="" class="img-thumbnail" id="image_preview" alt="">
        </div>
      </div>
     </div>
  </div>

 </div>

 <!-- /.card-body -->
