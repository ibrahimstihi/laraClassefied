@extends('admin.admin-dashboard')
@section('ads')
<div class="row mx-3">
    @forelse ($ads as $ad)
        @if($ad->is_valide==1)
            
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
                    <form class="text-center pb-2" method="post" action="{{ route('advertisement.masque', $ad->id) }}">
                        @csrf
                        {{ method_field('put') }}
                        <button type="submit" class="btn btn-warning py-0">
                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            masque
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

