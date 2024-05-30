<section class="hero">
    <div class="container">
        <div class="hero__slider owl-carousel">
            @foreach($banners as $banner)
                <div class="hero__items set-bg" data-setbg="{{$banner->thumbnail}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
{{--                                <div class="label">{{$banner->movie_genres}}</div>--}}
                                <h2>{{$banner->title}}</h2>
                                <p>{{$banner->desc}}</p>
                                <a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <div class="container">
        <div class="alert alert-info">Follow <a style="text-decoration: dashed" href="https://www.tiktok.com/@mlopte?_t=8mmgBsl1KS7&_r=1">Tiktok</a> Phim Để Lấy Mã Phim </div>
    </div>
</section>
