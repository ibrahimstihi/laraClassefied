@extends('profile.profile-layout')
@section('profile')
<div class="card">
    <div class="card-header">
        Change Password
    </div>
    <div class="card-body">
	<?php    
		$user=Auth::user();
	?>
	<form method="post" action="{{route('users.update_password', $user)}}" >
		{{ csrf_field() }}
		{{ method_field('patch') }}
		@foreach ($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
        @endforeach
        <div class="form-group row">
			<label for="password"
				class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
			<div class="col-md-6">
				<input id="new_password" type="password" class="form-control"  name="new_password" required>
			</div>
		</div>

		<div class="form-group row">
			<label for="password-confirm"
				class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

			<div class="col-md-6">
				<input id="password_confirmation" type="password" class="form-control"
					name="password_confirmation" required>
			</div>
		</div>
		<div class="form-group row">
			<label for="current-password"
				class="col-md-4 col-form-label text-md-right">{{ __('Curent Password') }}</label>

			<div class="col-md-6">
				<input id="current-password" type="password" class="form-control"
					name="current-password" required >
			</div>
		</div>                            

		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<button type="submit" class="btn btn-primary">
					{{ __('Change password') }}
				</button>
			</div>
		</div>
	</form>
    </div>
</div>

@endsection