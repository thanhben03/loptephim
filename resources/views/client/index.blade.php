@extends('layouts.master')
@section('banner')
    <!-- Hero Section Begin -->
    @include('components.banner')
@endsection
@section('content')
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>PHIM LẺ</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{route('client.theloai', 'phim-le')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($phimle as $item)
                                <div class="col-3" style="padding: 4px">
                                    <div class="product__item" onclick="showModalDetail({{$item->id}})">
                                        <div class="product__item__pic set-bg">
                                            <img style="height: 100%" src="{{$item->thumbnail}}" alt="">
                                            <div class="ep">{{$item->release_date}}</div>
{{--                                            <div onclick="showModalDetail({{$item->id}})" class="comment">Xem phim</div>--}}
                                        </div>
                                        <div class="product__item__text">

                                            <span class="title-movie-mobile">
                                                <a onclick="showModalDetail({{$item->id}})" class="link-movie-mobile" href="#">{{$item->title}}</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="popular__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>PHIM VIỆT</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{route('client.theloai', 'phim-viet')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($phimviet as $item)
                                <div class="col-3" style="padding: 4px">
                                    <div class="product__item" onclick="showModalDetail({{$item->id}})" >
                                        <div class="product__item__pic">
                                            <img style="height: 100%" src="{{$item->thumbnail}}" alt="">
                                            <div class="ep">{{$item->release_date}}</div>

{{--                                            <div onclick="showModalDetail({{$item->id}})" class="comment">Xem phim</div>--}}
                                        </div>
                                        <div class="product__item__text">

                                            <span class="title-movie-mobile">
                                                <a onclick="showModalDetail({{$item->id}})" class="link-movie-mobile">
                                                    {{$item->title}}
                                                </a>
                                            </span>
                                            <span class="btn btn-success vietsub">{{$item->is_vietsub}}</span>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="popular__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>PHIM CHIẾU RẠP</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{route('client.theloai', 'phim-chieu-rap')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($phimRap as $item)
                                <div class="col-3" style="padding: 4px">
                                    <div class="product__item" onclick="showModalDetail({{$item->id}})" >
                                        <div class="product__item__pic">
                                            <img style="height: 100%" src="{{$item->thumbnail}}" alt="">
                                            <div class="ep">{{$item->release_date}}</div>

                                        </div>
                                        <div class="product__item__text">

                                            <span class="title-movie-mobile">
                                                <a onclick="showModalDetail({{$item->id}})" class="link-movie-mobile">
                                                    {{$item->title}}
                                                </a>
                                            </span>
                                            <span class="btn btn-success vietsub">{{$item->is_vietsub}}</span>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                        <li id="movie-code"></li>
                                        <iframe class="movie-trailer" width="420" height="345" src="">
                                        </iframe>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <div class="alert alert-danger">
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

@push('custom-js')
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
                    let genre_name = '';
                    if (Array.isArray(data.movie.genre_name)) {
                        data.movie.genre_name.forEach((ele) => {
                            genre_name += `${ele.text},`
                        })
                    } else {
                        genre_name = data.movie.genre_name
                    }
                    $("#movie-genre").text(`Thể loại: ${genre_name}`)
                    $("#movie-country").text(`Quốc gia: ${data.movie.country}`)
                    $("#movie-vietsub").text(`Vietsub: ${data.movie.is_vietsub}`)
                    $("#movie-release_day").text(`Ngày phát hành: ${data.movie.release_date}` )

                    $("#movie-vietsub").text(`Vietsub: ${data.movie.is_vietsub}`)
                    $("#movie-code").text(`Mã: #${data.movie.id}`)
                    $("#movie-release_day").text(`Năm: ${data.movie.release_date}` )
                    // $("#movie-desc-text").text(data.movie.desc)
                    $("#movie-name").text(data.movie.title)

                    $(".movie-trailer").attr('src', `https://www.youtube.com/embed/${data.movie.trailer}`)

                    $('#exampleModal').modal('show');
                    let html = '';
                    let i = 1;
                    data.links.forEach(link => {
                        html += `
                            <li>
                                <div class="link-movie">
                                    <a target="_blank" href="${link.link}">Link xem ${i}</a>
                                </div>
                            </li>
                        `
                        i++;
                    })
                    $("#movie-link").html(html);
                }
            })
        }
    </script>
@endpush
