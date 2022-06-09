@extends('layouts.app')

@section('title', 'Advertisement: ' . $ad->id)

@section('content')

    <div class="container  p-3" id="ads_detail">
        {{--@auth
            @if (auth()->user()->id === $ad->user_id)
                <form class="text-right" method="post" action="{{ route('advertisement.destroy', $ad->id) }}">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-primary mr-2" href="{{ route('advertisement.edit', $ad->id) }}">Edit</a>
                    <button type="submit" class="btn btn-secondary">Delete</button>
                </form>
            @endif
        @endauth--}}

        <div class="row">
            <div>
                <img src="{{ $ad->image_url }}">
            </div>
            
            <div class="col">
                <span>{{ $ad->price }} dh</span>
                <p>{{$ad->titre}}</p>
                <p>{{ $ad->category->title }} </p>
                <span><i class="fa fa-map-marker"></i> {{$ad->ville}}</span>
                <span>description :</span>
                <p>
                    {{$ad->description}}
                </p>
                <span><i class="fa fa-calendar"></i> {{ $ad->created_at }}</span>
            </div>
        </div>
        <div>
            <?php
                $default_profil = "/images/users/default.png";
            ?>
            <img src="{{$ad->user->photo}}">
            <span>{{$ad->user->name}}</span>
            <a>
                <i class="fa fa-phone"></i>
                {{$ad->user->phone}}
            </a>
            <span>member depuis: {{$ad->user->created_at->format('y M')}}</span>
        </div>
    </div>

@endsection
