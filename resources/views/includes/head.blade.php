

      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title> @yield('title')</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Option 1: Include in HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
      <!-- General CSS Files -->
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/modules/bootstrap/css/bootstrap.min.css')}}">
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/modules/fontawesome/css/all.min.css')}}">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <!-- CSS Libraries -->
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/modules/jqvmap/dist/jqvmap.min.css')}}">
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/modules/summernote/summernote-bs4.css')}}">
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">

            <!-- Template CSS -->
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/css/style.css')}}">
            <link rel="stylesheet" href="{{ URL::asset('/public/assets/css/components.css')}}">

            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-94034622-3');
            </script>
  