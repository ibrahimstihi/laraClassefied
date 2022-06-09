@extends('admin.admin-dashboard')

@section('title', 'My advertisements')

@section('ads')
<div class="row mx-3">
    @forelse ($ads as $ad)
        @if($ad->is_valide==0)
            
            <div class="card m-2 p-0" id="admin-card">
                <a href="{{ route('advertisement.show', $ad->id) }}">
                    <img src="{{ $ad->image_url }}" class="card-img-top"></a>
                <p class="text-right text-muted p-2 m-0">{{ $ad->price }} dh</p>
                <p class="text-right text-muted p-2 m-0">{{ $ad->titre }}</p>
                <div>
                    <form class="text-center pb-2" method="post" action="{{ route('advertisement.destroy', $ad->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger py-0">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            Delete
                        </button>
                    </form>
                    <form class="text-center pb-2" method="post" action="{{ route('advertisement.valide', $ad->id) }}">
                        @csrf
                        {{ method_field('put') }}
                        <button type="submit" class="btn btn-success py-0">
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            Valide
                        </button>
                    </form>
                </div>
            </div>
        @endif
    @empty
        You have no advertisements.
    @endforelse
</div>

@endsection

