<p class="text-muted">
    {{ empty(trim($slot)) ? 'Added ' : $slot  }} {{ $date->diffForHumans() }}{{-- if empty is true
        display 'Added' otherwise display $slog. (trim() takes out white spaces)--}} 
    @if(isset($name)){{-- if name var is set, render $name value --}}
        by {{ $name }}
    @endif
</p>