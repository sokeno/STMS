@extends("layouts/app")

    

@section("content")
    <div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">Sign Up</p>
        <div class="panel-body">
            <form method="POST" action="{{ route('register') }}">
                    @csrf
                <div class="form-group">
                    <label>First Name</label>
                    <input id="first_name" type="text" class="form-control span12 {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input id="last_name" type="text" class="form-control span12{{$errors->has('last_name')? ' is-invalid' : '' }}" name="first_name" value="{{ old('last_name') }}" required autofocus>
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    {{--  <input type="text" class="form-control span12">  --}}

                    <input id="email" type="email" class="form-control span12 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input id="username" type="text" class="form-control span12 {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group ">
                        <label>Password</label>

                       <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                   
                    </div>

                    <div class="form-group ">
                        <label>Confirm Password</label>

                        
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        
                    </div>


                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Sign Up!</button>
                    <label class="remember-me"><input type="checkbox" required> I agree with the <a href="{{route('terms')}}">Terms and Conditions</a></label>
                </div>
                    <div class="clearfix"></div>
            </form>
        </div>
    </div>
    <p><a href="{{route('policy')}}" style="font-size: .75em; margin-top: .25em;">Privacy Policy</a></p>
</div>



@endsection