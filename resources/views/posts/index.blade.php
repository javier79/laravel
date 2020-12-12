
    @extends('layout')

    @section('content')
          <div class="row">{{-- creates a row for div class="col-8" and div class="col-4" --}}
                    <div class="col-8">{{-- This bigger column contain the list of blog post,  --}}
                    {{-- {{ $posts }} to peek at $posts value  --}}
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
                        
                            <x-updated :date="$post->created_at"  :name="$post->user->name">{{-- laravel 7 syntax for components, before 
                                this line executed a new query on each iteration, to stop executing another query we pass the user relation to our query definition on PostController ('posts' => BlogPost::latest()->withCount('comments')->with('user'))
                                so that variable $posts contains the properties for the user name for "$post->user->name"(the same syntax could access properties on $post
                                or execute a query as originally) to access it instead of having to execute another query on each iteration
                                so that we can cut down on querys everytime we load our blog posts list on the app  --}}
                            </x-updated>
                            
                            @if($post->comments_count){{-- if test true, meaning the property contains a number larger than 0 --}}
                                <p>{{ $post->comments_count }} comments</p>{{-- echoes the number followed by the text comments --}}
                            @else
                                <p>No comments yet!</p>{{-- if if test false --}}
                            @endif
                            @auth
                                @can('update', $post){{-- allows diplay of edit button to author of blog post, this 
                                    is checking i someone is allowed to edit --}}
                                <a href="{{ route('posts.edit', ['post'=>$post->id]) }}"class="btn btn-primary"> Edit</a>{{-- Edit link on index, class="btn btn-primary" colors the link and make it look like a bottom --}}
                                @endcan
                            @endauth

                            {{-- @cannot('delete', $post) SHOWS MESSAGE 
                            <p>You can't delete this post</p>
                            @endcannot --}}
                            @auth{{-- below code will be considered only if authenticated, this means that this processes
                                won't run if user is a guest(not logged out). This is an optimization as before it was
                                checking for both authenticated and non authenticated users. Now will be checking 
                                only if user is authenticated, eliminating for this users the gate checks
                                that formely required the use of more resources --}}
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
                            @endauth    
                        </p>

                    @empty{{-- @forelse let us use @empty clause to display a message if the
                        collection is found to be empty --}}
                            <p>No blog post yet!</p>
                    @endforelse
                    </div>
                    
                    <div class="col-4">{{-- smaller column contain the card element--}}
                        <div class="container">
                            <div class="row">
                                <x-card : title="Most Commented ">{{-- passing title text to component card.blade --}}
                                    @slot('subtitle'){{-- passing text in slot to be place as subtitle --}}
                                        What people is currently talking about{{--passing subtitle text (outside an array )
                                        to component card.blade--}}
                                    @endslot
                                    @slot('items')
                                        @foreach ($mostCommented as $post){{-- $mostCommented references 'mostCommented' on PostController --}}
                                            <li class="list-group-item">
                                                <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                                    {{ $post->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endslot
                                </x-card>

                      </div>

                            <div class="row mt-4">
                              <x-card : title="Most Active">{{-- passing title text to component card.blade --}}
                                  @slot('subtitle'){{-- passing text in slot to be place as subtitle --}}
                                    Writers with most posts written{{--passing subtitle text (outside an array )
                                        to component card.blade--}}
                                  @endslot
                                  @slot('items', collect($mostActive)->pluck('name')){{-- $mostActive references 'mostActive'
                                  in PostController.php --}}
                              </x-card>

                            </div>

                        <div class="row mt-4">

                            <x-card : title="Most Active Last Month">
                                @slot('subtitle'){{-- passing text in slot to be place as subtitle --}}
                                    Users with most posts written in the month
                                @endslot
                                @slot('items', collect($mostActiveLastMonth)->pluck('name'))
                            </x-card>
                            {{-- the code above is a simpler substitution to code below,
                                applying components. <x-card></x-card> tags references where
                                the rendering will take place in the view and also is the logic
                                that will generate the values that are pass to component card.blade.php
                                where rendering code lives --}}
                                
                           {{-- <div class="row mt-4">    
                                 <div class="card" style="width: 100%;">
                                    <div class="card-body">
                                        <h5 class="card-title">Most Active Last Month</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Users with most posts written in the last month</h6>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        @foreach ($mostActiveLastMonth as $user){{-- $mostActiveLastMonth references 'mostActiveLastMonth' on PostController
                                            <li class="list-group-item">
                                                    {{ $user->name }}     
                                            </li>
                                        @endforeach
                                    </ul>
                                  </div> 
                            </div> --}}

                      </div> 
                  </div>   
              </div>
          </div>
    @endsection('content')

    {{--The link for this view is laravel.test/posts, as i understand it's determined
    by the URI in the route:list--}} 