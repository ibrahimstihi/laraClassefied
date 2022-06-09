@extends('layouts.app')
@section('content')	
<div class="row" id="dashboard">
 	<div class="col-md-4">
 	    <ul class="list-group profile-nav">
		    <li class="list-group-item {{(request()->route()->getName()=='new_ads')?'active':''}}"><a href="{{route('new_ads')}}">new Advertisment</a></li>
            <li class="list-group-item {{(request()->route()->getName()=='old_ads')?'active':''}}"><a href="{{route('old_ads')}}">old Advertisment</a></li>
		</ul>
    </div>
    <div class="col-md-11">
        @yield('ads')
    </div>
</div>
@endsection