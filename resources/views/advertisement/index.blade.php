
@extends('layouts.app')
@section('title', 'Classifieds Board')

@section('content')

    <div class="navbar navbar-expand-md navbar-light bg-white shadow-sm"  id="categories">
        <ul class="navbar-nav">
            <a class="nav-link" href="{{ route('advertisement.index') }}">
                <li class="nav-item  {{ Route::currentRouteName() == 'advertisement.index' ? 'active' : '' }}">
                    <div></div>
                    <span>All</span>
                </li>
            </a>
            
            @php
                $category_id = $category->id ?? '';
            @endphp
            @foreach ($categories as $cat)
            <a class="nav-link"
                href="{{ route('advertisement.adsByCategory', $cat->id) }}">
                <li class="nav-item {{ $category_id === $cat->id ? 'active' : '' }}">
                        <div><i class="{{$cat->url_icon}}"></i></div>      
                        <span>{{ $cat->title }}</span>
                </li>
            </a>
            @endforeach
        </ul>
    </div>

    <div class="row mx-3">
        @foreach ($ads as $ad)
            <article>
                <a href="{{ route('advertisement.show', $ad->id) }}">
                    <div>
                        <img src="{{ $ad->image_url }}" class="card-img-top">
                    </div>
                </a>
                <div>
                    <span>{{ $ad->price }} dh</span>
                    <p>{{$ad->titre}}</p>
                    <p>{{ $ad->category->title }} </p>
                    <div>
                        <span><i class="fa fa-calendar"></i> {{ $ad->created_at }}</span>
                        <span><i class="fa fa-map-marker"></i> {{$ad->ville}}</span>
                    </div>
                </div>
            </article> 
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $ads->links() }}
    </div>

@endsection
