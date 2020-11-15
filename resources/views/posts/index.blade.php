
    @extends('layout')

    @section('content')
    <div class="row">{{-- creates a row for div class="col-8" and div class="col-4" --}}
        <div class="col-8">{{-- This bigger column contain the list of blog post,  --}}
        @forelse ($posts as $post){{--we are iterating around the $posts collection similar to @foreach
            de difference is thar @forelse let us use @empty clause to display a message if the
            collection is found to be empty --}}
            <p>
                <h3>
                    @if($post->trashed()){{-- trashed = deleted --}}
                        <del>
                    @endif
                    <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
                       href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ $post->title }}</a>
                    @if($post->trashed())
                        </del>
                    @endif
                    {{--'post.show' is the name of the route as per route:list. Parameter key 'post' 
                    from route:list URI(.../{post}) and $post(var from @forelse clause above)->id(parameter).
                    ['post'=>$post->id]('post' key references object(record)stored in $post which is accessing 
                    it's attribute id). {{ $post->title }}(render's attribute title)--}}
                </h3>{{-- here we are echoing/accessing the model attributes
                    or the columns of the database. --}}
                <p class="text-muted">
                    Added {{ $post->created_at->diffForHumans() }}
                    by {{ $post->user->name }}{{-- FOR THIS TO WORK A RELATION BETWEEN User.php and BlogPost.php 
                        must be established check those classes --}}
                </p>

                @if($post->comments_count){{-- if test true, meaning the property contains a number larger than 0 --}}
                    <p>{{ $post->comments_count }} comments</p>{{-- echoes the number followed by the text comments --}}
                @else
                    <p>No comments yet!</p>{{-- if if test false --}}
                @endif
                
                @can('update', $post){{-- allows diplay of edit button to author of blog post, this 
                    is checking i someone is allowed to edit --}}
                <a href="{{ route('posts.edit', ['post'=>$post->id]) }}"class="btn btn-primary"> Edit</a>{{-- Edit link on index, class="btn btn-primary" colors the link and make it look like a bottom --}}
                @endcan

                {{-- @cannot('delete', $post) SHOWS MESSAGE 
                <p>You can't delete this post</p>
                @endcannot --}}
                @if(!$post->trashed())
                    @can('delete', $post){{-- allows diplay of delete button to author of blog post
                        this is checking i someone is allowed to delete --}}
                    <form method="POST" class="fm-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}">{{--class="fm-inline" defined at app.scss affects only the delete button, 
                        input tags behave as a block meaning they display in a new line,class="fm-inline" make it to display inline with the last displayed tag (<a href="{{ route('posts.edit', ['post'=>$post->id]) }}"class="btn btn-primary"> Edit</a>) --}}
                        @csrf{{-- This is a token to prevent exploits on the form, without it renders an error --}}
                        @method('DELETE'){{-- method spoofing as html only manage method Get or POST, this will 
                            handle the use of method DELETE(Route list) --}}

                        <input type="submit" value="Delete!" class="btn btn-primary" />
                    </form>
                    @endcan
                @endif
            </p>

        @empty{{-- @forelse let us use @empty clause to display a message if the
            collection is found to be empty --}}
                <p>No blog post yet!</p>
        @endforelse
        </div>
        <div class="col-4">{{-- smaller column contain the card element--}}
            <div class="container">
                <div class="row">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                        <h5 class="card-title">Most Commented</h5>
                        <h6 class="card-subtitle mb-2 text-muted">What people is currently talking about</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostCommented as $post){{-- $mostCommented references 'mostCommented' on PostController --}}
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                        {{ $post->title }}
                                    </a>
                                </li>
                        @endforeach
                      </ul>
                  </div>
              </div>

                  <div class="row mt-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                        <h5 class="card-title">Most Active</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Users with most posts written</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostActive as $user){{-- $mostCommented references 'mostCommented' on PostController --}}
                                <li class="list-group-item">
                                        {{ $user->name }}     
                                </li>
                        @endforeach
                      </ul>
                  </div>
              </div>

              <div class="row mt-4">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Most Active Last Month</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Users with most posts written in the last month</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($mostActiveLastMonth as $user){{-- $mostActiveLastMonth references 'mostActiveLastMonth' on PostController --}}
                            <li class="list-group-item">
                                    {{ $user->name }}     
                            </li>
                    @endforeach
                  </ul>
              </div>
          </div> 
          </div>   
      </div>
  </div>

    @endsection('content')

    {{--The link for this view is laravel.test/posts, as i understand it's determined
    by the URI in the route:list--}} 