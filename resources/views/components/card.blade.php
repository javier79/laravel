<div class="card" style="width: 100%;">
    <div class="card-body">
        <h5 class="card-title">{{$title}}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $subtitle }}</h6>
    </div>
    <ul class="list-group list-group-flush">
        @if(is_a($items, 'Illuminate\Support\Collection')){{-- if items is a collection render a list of items --}}
            @foreach ($items as $item)
                        <li class="list-group-item">
                            {{ $item }}{{-- as i understand this renders the text of {{ $post->title }}
                            from index.blade --}}
                        </li>
            @endforeach
        {{-- As i understand this will renders items that are not a collection
            like html as per Tutorial --}}
        @else

            {{ $items }}{{-- the function of a link is passed here for  the title text --}}
            {{-- When we pass an HTML it is rendered here for example:
                <a href="{{ route('posts.show', ['post' => $post->id]) }}"> 
                    THIS WE PASS FROM index.blade --}}
        @endif
    </ul>
</div>