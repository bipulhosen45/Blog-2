@extends('backend.admin-layouts.app')
@include('backend.includes.topbar')
@include('backend.includes.sidebar')
@section('admin_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-5">
            <div class="card">
                <div class="card-header bg-primary">
                    {{ __('Dashboard') }}
                    <a href="" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                </div>

                <div class="card-body">
                   <strong>Submit your ticket we will reply.</strong><br><br>
                   <div>
                   	  <form action="{{ route('store.ticket') }}" method="post" enctype="multipart/form-data">
                   	  	@csrf
                   	    <div class="form-group">
                   	      <label for="exampleInputEmail1">Subject</label>
                   	      <input type="text" class="form-control" name="subject" required>
                   	    </div>
                   	    <div class="row text-dark">
	                   	    <div class="form-group col-6">
	                   	      <label for="exampleInputEmail1">Priority</label>
	                   	      <select class="form-control" name="priority" style="min-width: 220px;">
								<option value="">Select Priority</option>
	                   	      	<option value="Low">Low</option>
	                   	      	<option value="Medium">Medium</option>
	                   	      	<option value="High">High</option>
	                   	      </select>
	                   	    </div>
	                   	    <div class="form-group col-6">
	                   	      <label for="exampleInputEmail1">Service</label>
	                   	      <select class="form-control" name="service" style="min-width:220px;">
								<option value="">Select Service</option>
	                   	      	<option value="Technical">Technical</option>
	                   	      	<option value="Payment">Payment</option>
	                   	      	<option value="Affiliate">Affiliate</option>
	                   	      	<option value="Return">Return</option>
	                   	      	<option value="Refund">Refund</option>
	                   	      	<option value="others">Others</option>
	                   	      </select>
	                   	    </div>
                   	    </div>
                   	    <div class="form-group">
                   	      <label for="exampleInputPassword1">Message</label>
                   	      <textarea class="form-control" name="message" required=""></textarea>
                   	    </div>
                   	    <div>
                   	    	<label for="exampleInputPassword1">Image</label>
                   	    	<input type="file" class="form-control" name="image" >
                   	    </div><br>
                   	    <button type="submit" class="btn btn-primary">Submit Ticket</button>
                   	  </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
