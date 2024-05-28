@extends('layouts.master')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="#">Game</a>
{{--                        <span>{{$genre->name}}</span>--}}
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
                                    <h4>Game Mod</h4>
                                </div>
                            </div>

                        </div>
                        <div class="row movie-container">
                            @include('client.game_load')

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết phim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="detail-movie">
                        <ul style="list-style: none">
                            <li>
                                <span>Tên Game: </span>
                                <span id="game-name"></span>
                            </li>
                            <li>
                                <div class="alert alert-primary" role="alert">
                                    Thông tin chi tiết:
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    <ul class="wrap-detail-movie">
                                        <li id="game-genre">Thể loại: 123</li>
                                        <li id="game-version">Phiên bản: 12</li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="alert alert-danger" role="alert">
                                    <div class="movie-desc">
                                        <label>Tính năng mod: </label >

                                        <div class="form-group" id="game-feartured-text" >
                                            <textarea class="form-control" disabled >

                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="alert alert-success" role="alert">
                                    <div class="movie-desc">
                                        <label>Mô tả: </label>
                                        <div class="form-group" id="game-desc-text">
                                            <textarea class="form-control" disabled>

                                            </textarea>
                                        </div>
                                    </div>

                                </div>
                            </li>

{{--                            <li>--}}
{{--                                <div class="alert alert-success">--}}
{{--                                    <ul id="game-link">--}}

{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </li>--}}
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
        $(document).ready(function () {
            let nextPageUrl = '{{$games->nextPageUrl()}}';
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
        function showModalDetail(idGame) {

            $.ajax({
                url: '{{route('api.getGame')}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': idGame
                },
                success: function (data) {
                    console.log(data)

                    $("#game-genre").text(`Thể loại: ${data.game.game_genre}`)
                    $("#game-version").text(`Version: ${data.game.version}`)
                    $("#game-desc-text").html(data.game.desc);

                    $("#game-feartured-text").html(`${data.game.mod_feartured}`)
                    $("#game-name").text(data.game.name)
                    $('#exampleModal').modal('show');

                    // let html = '';
                    // let i = 1;
                    // data.links.forEach(link => {
                    //     html += `
                    //         <li>
                    //             <div class="link-movie">
                    //                 <span>Link tải ${i}:</span>
                    //                 <a target="_blank" href="${link.link}">${link.link}</a>
                    //             </div>
                    //         </li>
                    //     `
                    //     i++;
                    // })
                    // $("#game-link").html(html);
                }
            })
        }
    </script>
@endpush
