@extend("app")
@include("layouts/sidebarnav")

@section("content")
    <div class="content">
        <div class="header">
            
            <h1 class="page-title">{{ isset($user->name) ? 'Edit: '. $user->name : 'Add User' }}</h1>

            <a href="{{ URL::to('admin/users') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

        </div>

  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
	 @if(Session::has('flash_message'))
				    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
				        {{ Session::get('flash_message') }}
				    </div>
	@endif
        <div class="main-content">
            

<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
      
      {!! Form::open(array('url' => array('admin/users/adduser'),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'tab','role'=>'form','enctype' => 'multipart/form-data')) !!} 
          <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : null }}">

        <div class="form-group">
        <label>Username</label>
        <input type="text" value="{{ isset($user->username) ? $user->username : null }} class="form-control">
        </div>
        <div class="form-group">
        <label>First Name</label>
        <input type="text" name="first_name" value="{{ isset($user->first_name) ? $user->first_name : null }} class="form-control">
        </div>
        <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="last_name" value="{{ isset($user->last_name) ? $user->last_name : null }} class="form-control">
        </div>
        <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" value="{{ isset($user->email) ? $user->email : null }} class="form-control">
        </div>

        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password" value="" class="form-control">
        </div>

        <div class="form-group">
          <label>Preffered working hours per day </label>
          <input type="text" name="hours" value="{{ isset($user->hours) ? $user->hours : null }} class="form-control">
        </div>  

        

          <div class="form-group">
              <label>User Type</label>
             
                  <select name="usertype" id="basic" class=" form-control" data-live-search="true">
          @if(isset($user->usertype))
          
          <option value="User" @if($user->usertype=='User') selected @endif>User</option>
          <option value="Manager" @if($user->usertype=='Manager') selected @endif>Manager</option>
          <option value="Admin" @if($user->usertype=='Admin') selected @endif>Admin</option>
           
          
          @else
                
              <option value="User">Owner</option>
              <option value="Manager">Supervisor</option>
              <option value="Admin">Contractor</option> 
             
          @endif
           
      </select>
            
          </div>


          <div class="btn-toolbar list-toolbar">
              <button class="btn btn-primary"><i class="fa fa-save"></i> {{ isset($user->name) ? 'Edit User' : 'Add User' }}</button>
              
            </div>
            {!! Form::close() !!} 
      </div>

    
    </div>

    
  </div>
</div>



        </div>
    </div>
    @endsection
