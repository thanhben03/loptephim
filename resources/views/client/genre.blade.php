@extends('layouts.master')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="#">Categories</a>
                        <span>{{$genre->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>{{$genre->name}}</h4>
                                </div>
                            </div>

                        </div>
                        <div class="row movie-container">
                            @include('client.genre_load')

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết phim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="detail-movie">
                        <ul style="list-style: none">
                            <li>
                                <span>Tên phim: </span>
                                <span id="movie-name"></span>
                            </li>
                            <li>
                                <div class="alert alert-primary" role="alert">
                                    Thông tin chi tiết:
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    <ul class="wrap-detail-movie">
                                        <li id="movie-genre">Thể loại: 123</li>
                                        <li id="movie-release_day">Ngày phát hành: 12</li>
                                        <li id="movie-country">Quốc gia: VN</li>
                                        <li id="movie-vietsub">Vietsub: Có</li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="alert alert-success" role="alert">
                                    <div class="movie-desc">
                                        <div class="form-group">
                                            <label>Mô tả: </label>
                                            <textarea class="form-control" disabled id="movie-desc-text">

                                            </textarea>
                                        </div>
                                    </div>
                                    <ul id="movie-link">

                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
zzzz
@push('custom-js')
    <script>
        $(document).ready(function () {
            console.log('21312')
            let nextPageUrl = '{{$movies->nextPageUrl()}}';
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    if (nextPageUrl) {
                        loadMore();
                    }
                }
            })

            function loadMore() {
                $.ajax({
                    url: nextPageUrl,
                    type: 'get',
                    beforeSend: function () {
                        nextPageUrl = ''
                    },
                    success: function (data) {
                        nextPageUrl = data.nextPageUrl;
                        $(".movie-container").append(data.view);
                    },
                    error: function (xhr, status, err) {
                        console.log(err)
                    }
                })
            }
        })
    </script>
    <script>
        function showModalDetail(idMovie) {

            $.ajax({
                url: '{{route('api.getMovie')}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': idMovie
                },
                success: function (data) {
                    $("#movie-genre").text(`Thể loại: ${data.movie.genre_name}`)
                    $("#movie-country").text(`Quốc gia: ${data.movie.country_name}`)
                    $("#movie-vietsub").text(`Vietsub: ${data.movie.is_vietsub ? 'Có' : 'Không'}`)
                    $("#movie-release_day").text(`Ngày phát hành: ${data.movie.release_date}` )
                    $("#movie-desc-text").text(data.movie.desc)
                    $("#movie-name").text(data.movie.title)
                    $('#exampleModal').modal('show');
                    let html = '';
                    data.links.forEach(link => {
                        html += `
                            <li>
                                <a target="_blank" href="${link.link}">${link.link}</a>
                            </li>
                        `
                    })
                    $("#movie-link").html(html);
                }
            })
        }
    </script>
@endpush
