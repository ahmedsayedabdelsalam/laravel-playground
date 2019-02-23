@if(array_intersect(array_keys(request()->query()), array_keys($mappings)))
    <p>
        <a href="{{ route('courses.index') }}">Clear all Filers</a>
    </p>
@endif

@foreach($mappings as $filter_key => $map)
    @include('courses.partials._filters_list', compact('filter_key', 'map'))
    <br>
@endforeach
