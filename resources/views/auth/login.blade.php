@extends("layouts/app")
    

@section("content")
   <div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">Sign In</p>
        <div class="panel-body">
            <form method="POST" action="{{ route('login') }}">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control span12" name="username" value="{{ old('password') }}" required autofocus>

                    @if ($errors->has('username'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif

                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-controlspan12 form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary pull-right">Sign In</button>
                <label class="remember-me"><input type="checkbox" {{ old('remember') ? 'checked' : '' }}> Remember me</label>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
    
    <p><a href="{{route('password.request')}}">Forgot your password?</a></p>
</div>


@endsection