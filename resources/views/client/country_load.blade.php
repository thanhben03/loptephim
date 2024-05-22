@foreach($movies as $item)
    <div class="col-3" style="padding: 4px">
        <div class="product__item">
            <div class="product__item__pic set-bg">
                <img style="height: 100%" src="{{$item->movie->thumbnail}}" alt="">
                <div class="ep">{{$item->movie->release_date}}</div>
                <div onclick="showModalDetail({{$item->movie->id}})" class="comment">Xem phim</div>
            </div>
            <div class="product__item__text">

                <span class="title-movie-mobile">
                    <a onclick="showModalDetail({{$item->movie->id}})" class="link-movie-mobile">
                        {{$item->movie->title}}
                    </a>
                </span>
            </div>
        </div>
    </div>
@endforeach
