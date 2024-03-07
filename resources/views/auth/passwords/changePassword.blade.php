
@extends('layouts.app-master')

@section('content')
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
            <section id="dashboard-ecommerce">

            <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">

    <!-- BEGIN: Content-->
    <form id="signupForm" action="{{route('password_reset')}}" method="post">
            @csrf
            <!-- Email input -->

            @if (\Session::has('error'))
            <div class="alert alert-danger">{{ \Session::get('error') }}</div>
            @endif
            @if (\Session::has('success'))
            <div class="alert alert-success">{{ \Session::get('success') }}</div>
            @endif
            
            <div class="form-outline ">
              <label class="form-label"  for="form2Example1">Current Password</label>
              <input type="password" name="old_password" id="old_password" class="form-control" />
              
            </div>

            <!-- Password input -->
            <div class="form-outline ">
              <label class="form-label" for="form2Example2">New Password</label>
              <input type="password" id="new_password" name="new_password"  class="form-control" />
              
            </div>

            <div class="form-outline "  >
              <label class="form-label" for="form2Example2">Confirm Password</label>
              <input type="password" id="cpassword" name="cpassword"  class="form-control" />
              
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-custom btn-block mb-4">Change Password</button>

            <!-- Register buttons -->
            <div class="text-center">
             
            </div>
          </form>

            </div>

            <div class="col-md-3"></div>
            </div>
    <!-- END: Content-->

    </section>
    

    </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection

@section('javascript')

<script src=
"https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js">
	</script>

  <script>

$().ready(function () {
 
 $("#signupForm").validate({
    
     // In 'rules' user have to specify all the
    // constraints for respective fields
     rules: {
       
         old_password: {
             required: true,
             minlength: 5
         },
         new_password: {
             required: true,
             minlength: 5
         },
         
         cpassword: {
                        required: true,
                        minlength: 5,
                       
                        // For checking both passwords are same or not
                        equalTo: "#new_password"
                    },
        
     },
     // In 'messages' user have to specify message as per rules
     messages: {
      
         old_password: {
             required: " Please enter a password",
             minlength:
           " Your password must be consist of at least 5 characters"
         },
         new_password: {
             required: " Please enter a password",
             minlength:
           " Your password must be consist of at least 5 characters"
         },
         cpassword: {
                        required: " Please enter a password",
                        minlength:
                      " Your password must be consist of at least 5 characters",
                        equalTo: " Please enter the same password as above"
                    },
        
      
     }
 });
});

</script>
@stop

