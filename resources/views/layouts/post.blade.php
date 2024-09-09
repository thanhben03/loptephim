
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sociala - Social Network App HTML Template </title>

    <link rel="stylesheet" href="{{asset('post/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('post/css/feather.css')}}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{asset('post/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('post/css/emoji.css')}}">
    <link rel="stylesheet" href="{{asset('post/css/lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('post/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/sweetalert.css')}}">
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">--}}
    <style>
        .hide-content-post > p {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .toggle-hide-post {
            height: 25%;
            overflow: hidden;
        }
        .post-content img {
            width: 100% !important;
            height: 100% !important;
        }
    </style>
    <style>
        /* Style the Image Used to Trigger the Modal */
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content, #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>
    <style>
        /* Style the Image Used to Trigger the Modal */
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content, #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>
    {{--    <link rel="stylesheet" href="{{asset('post/css/bootstrap.min.css')}}">--}}

</head>

<body class="color-theme-blue mont-font">

<div class="preloader"></div>


<div class="main-wrapper">
    <!-- main content -->
    @yield('content')
    <!-- main content -->



</div>







<script src="{{asset('post/js/plugin.js')}}"></script>
<script src="{{asset('user/assets/sweetalert.js')}}"></script>

<script src="{{asset('post/js/lightbox.js')}}"></script>
<script src="{{asset('post/js/scripts.js')}}"></script>
<script src="{{asset('post/js/moment.js')}}"></script>
<script src="{{asset('post/js/moment-with-locales.js')}}"></script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<script src="https://cdn.jsdelivrii.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
{{--<script src="{{asset('post/js/bootstrap.bundle.min.js')}}"></script>--}}
@stack('custom-js')
<script>

    function likePost(idPost) {
        let post = $(`#post-${idPost}`);
        let totalLike = parseInt(post.text());
        let showImage = $(`#show-image-${idPost}`);
        let showLinkDownload = $(`#wrap-link-${idPost}`);
        $.ajax({
            url: "{{route('likePost')}}",
            method: "POST",
            dataType: "JSON",
            data: {
                _token: "{{csrf_token()}}",
                post_id: idPost
            },
            success: function (res) {
                post.text(++totalLike);
                let btnLike = $(`#btn-like-${idPost}`);
                btnLike.attr('style', 'color: chartreuse')
                $("#show-content-"+idPost).css('display', 'block')
                $("#hide-content-"+idPost).css('display', 'none')
                // showLinkDownload.empty().append(
                //     `
                //         Link: <a href="${res.link}}">${res.link}</a>
                //
                //     `
                // );
                // window.location.reload()
            },
            error: function () {
                Swal.fire("Bạn chỉ có thể ấn like 1 lần !");

            }
        })
    }
</script>


</body>

</html>
