<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield("title")</title>
<!-- token laravel 
    ============================================ -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- app Css
		============================================ -->
<link rel="stylesheet" href="{{asset("source/scss/app.css")}}">
<!-- fontawsome Css
		============================================ -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- google font Css
		============================================ -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link   href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
    rel="stylesheet">
<!-- notification Css
	============================================ -->
    <link rel="stylesheet" href="{{asset("source/admin/css/notifications/style.css")}}">
