<div class="list-group">
    @foreach ($map as $key => $value)
        <a href="{{ route('courses.index', array_merge(request()->query(), [$filter_key => $key, 'page' => 1])) }}"
           class="list-group-item {{ request($filter_key) === $key ? 'active' : '' }}">{{ $value }}</a>
    @endforeach

    @if(request($filter_key))
        <a href="{{ route('courses.index', array_except(request()->query(), [$filter_key, 'page'])) }}"
           class="list-group-item list-group-item-info">&times; Clear this filter</a>
    @endif
</div>
