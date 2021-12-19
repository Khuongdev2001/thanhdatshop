@extends("user.master.layout")
@section("title",$post->post_title)
@section("js")
<!-- Module Comment -->
<script src="{{asset("source/js/module/comment.js")}}"></script>
@endsection
@section("content")
<div id="content">
    <div class="container">
        <div class="breadcrumb">
            <a href="" class="breadcrumb-item">
                <span>Trang Chủ</span>
            </a>
            <a href="" class="breadcrumb-icon">
                <i class="fas fa-chevron-right"></i>
            </a>
            <a href="" class="breadcrumb-item">
                <span>{{$post->post_title}}</span>
            </a>
        </div>
        <div class="box-post post-details">
            <h1 class="title pb-10">{{$post->post_title}}</h1>
            <div class="content">
                {!!$post->post_content!!}
            </div>
            <div class="box-bottom my-20">
                <span class="text-red">{{$post->post_title}}</span>
                <div class="box-action">
                    <a href="" class="btn btn-prev">
                        <i class="fas fa-chevron-left"></i>
                        Bài Trước
                    </a>
                    <a href="" class="btn btn-next">
                        Bài Sau
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div  data-module="post" data-id="{{$post->post_id}}" class="tab-penal active box-comment p-20 bg-light">
            <form>
                <div class="form-group my-20 form-group-outline">
                    <label for="comment_content">Nội Dung Bình Luận</label>
                    <input type="text" id="comment_content" class="form-control" data-field="comment_content">
                    <span class="invalid-feedback"></span>
                    <div class="line"></div>
                    <a href="" class="btn-add"><i class="fas fa-paper-plane"></i></a>
                </div>
            </form>
            <div class="wp-comment">
            </div>
        </div>
        <div class="box-post py-50 post-slider">
            <div class="top-post lh-15">
                <h3 class="title">{{$post->cat_title}}</h3>
            </div>
            <div class="posts">
                @foreach($postSames as $post)
                <div class="post">
                    <a href="{{route("post.details",$post->post_slug)}}" class="box-thumbnail img-ratio d-block">
                        <img data-src="{{asset($post->post_thumbnail)}}" alt="{{$post->post_title}}" class="thumbnail w-100 lazy">
                    </a>
                    <h3 class="title">{{$post->post_title}}</h3>
                    <p class="description">
                        {{$post->post_description}}
                    </p>
                    <div class="box-bottom">
                        <span class="date-created">Ngày đăng: {{date("Y-h-d",strtotime($post->created_at))}}</span>
                        <span class="author">{{$post->fullname}}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection