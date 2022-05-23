@extends('profile.profile-layout')
@section('profile')
<?php
    $user = Auth::user();
?>
<div class="card">
	<div class="card-header">Update Profile</div>
	<div class="card-body">
		<form method="post" action="{{route('users.update', $user)}}" >
			{{ csrf_field() }}
			{{ method_field('patch') }}
			<div class="form-group row">
				<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

				<div class="col-md-6">
					<input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
						name="name" value="{{ $user->name}}" required autocomplete="name" autofocus>

					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="email"
					class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

				<div class="col-md-6">
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
						name="email" value="{{ $user->email}}" required autocomplete="email" disabled>

					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="phone"
					class="col-md-4 col-form-label text-md-right">{{ __('telephone') }}</label>

				<div class="col-md-6">
					<input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror"
						name="phone" value="{{ $user->phone}}" required autocomplete="phone">

					@error('phone')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
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
						{{ __('Update') }}
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection