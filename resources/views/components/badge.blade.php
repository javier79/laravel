    @if(!isset($show) || $show)
        <span class="badge badge-{{ $type ?? 'success' }}">{{-- if a type(another slot variable check notebookII) 
        is specified use the bootstrap class that references $type variable, otherwise
        use default 'success'(bootstrap class) that references the green badge--}}
        {{ $slot }}{{-- references the text to be displyed and that resides on show.blade
            this variable is native to laravel and used like this, there are other 'slot' variables like $type for other 
            uses. --}}
        </span> {{-- we change the tag from <div> to <span> due div sometimes force the use of another an extra paragraph 
            so we change to span to make it more usable sometimes like in this case there is not a great change on display --}}
    @endif