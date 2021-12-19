@if($paginator->hasPages())
<ul class="paginates">
    @if ($paginator->previousPageUrl())
    <li class="paginate-item">
        <a href="{{$paginator->previousPageUrl()}}" class="paginate-link"><i class="fas fa-chevron-left"></i></a>
    </li>
    @endif
    @foreach($elements  as  $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
                <li class="paginate-item">
                    <a href="{{$url}}" class="paginate-link active">{{$page}}</a>
                </li>
            @else
                <li class="paginate-item">
                    <a href="{{$url}}" class="paginate-link">{{$page}}</a>
                </li>
            @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
    <li class="paginate-item">
        <a href="{{$paginator->nextPageUrl()}}" class="paginate-link"><i class="fas fa-chevron-right"></i></a>
    </li>
    @endif
</ul>
@endif