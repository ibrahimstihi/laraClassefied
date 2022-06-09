@extends('layouts.app')

@section('title', 'Post new advertisement')

@section('content')
    <div class="container bg-white p-4">

        <h1>Post advertisement</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="pl-4 m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" enctype="multipart/form-data" action="{{ route('advertisement.index') }}">
            @csrf
            <label for="category_id" class="mt-2 mb-1">Category:</label>
            <select class="form-control col-sm-8" id="category_id" name="category_id">
                <option>Select category</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? ' selected' : '' }}>
                        {{ $cat->title }}</option>
                @endforeach
            </select>
            
            <label for="titre" class="mt-2 mb-1">Titre d'annone :</label>
            <input class="form-control col-sm-8" id="titre" name="titre" value="{{ old('titre') }} ">

            <label for="ville" class="mt-2 mb-1">La ville :</label>
            <input class="form-control col-sm-8" id="ville" name="ville" value="{{ old('ville') }} ">

            <label for="description" class="mt-2 mb-1">Description:</label>
            <textarea class="form-control col-sm-8" id="description" name="description" rows="4"
                cols="50">{{ old('description') }}</textarea>

            <label for="price" class="mt-2 mb-1">Price:</label>
            <input type="number" class="form-control col-sm-2" id="price" name="price" min="0.00" step="0.01"
                value="{{ old('price') ?? 0 }}" /><br>
            
            <label for="image" class="mt-2 mb-1">Image 1:</label>
            <input type="file" class="form-control col-sm-8" id="image" name="image">

            {{-- for multi image --}}
            <label for="image1" class="mt-2 mb-1">Image 2:</label>
            <input type="file" class="form-control col-sm-8" id="image1" name="image1">
            <label for="image2" class="mt-2 mb-1">Image 3:</label>
            <input type="file" class="form-control col-sm-8" id="image2" name="image2">
            <label for="image3" class="mt-2 mb-1">Image 4:</label>
            <input type="file" class="form-control col-sm-8" id="image3" name="image3">
            {{-- end --}}

            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
@endsection
