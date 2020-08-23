{{-- _form view does not live on it's own, meaning we are using it to render the code for our 
two current forms(create and edit) which share some of the same code, both share the
two input fields as well as the part displaying validation errors --}}
<p>   
    <label>Title</label>
    <input type="text" name="title" value="{{ old('title', $post->title ?? null)}}"/>{{-- value="old()" if the data does not pass
    the validation, when the form reloads the data is kept in the input boxes to
    faccilitate the correction of it by user. $post->title this second parameter is a default value. REMEMBER THAT THE KEY'S AT public function rules() (for validation) at StorePost.php MUST MATCH INPUT NAME.
    Also ALTHOUGH old() parameter key and public function rules() key names are the same, they are not related.
    Due we are sharing the code in this view for creating and editing it rises a problem: If i try to CRATE a new model with title and content will
    return an error due for creating i don't need to fetch an already existing model so as a result $post variable({{ old('title', $post->title)}})
    will be empty or undefined to resolve this issue we use operator ?? and null, what it does is 
    that it verifies $post->title if no value it assigns null --}}
 </p>

 <p>   
    <label>Content</label>
    <input type="text" name="content" value="{{old('content', $post->content ?? null)}}"/>
 </p>

 @if($errors->any()){{-- Check notebook notes, $errors is a session variable(available to all views)
  this variable 'errors'live in function handle() from Middleware\ShareErrorsFromSession) --}}
  <div>
     <ul>
        @foreach($errors->all() as $error)
           <li>{{ $error }}</li>
        @endforeach
     </ul>
  </div>
  @endif