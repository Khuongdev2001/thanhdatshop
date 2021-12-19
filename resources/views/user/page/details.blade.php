@extends("user.master.layout")
@section("title",$page->page_title)
@section("js")
@endsection
@section("content")
<div id="content">
    <div class="container">
        <div class="box-page p-15">
            {!!$page->page_content!!}
        </div>
    </div>
</div>
@endsection