@foreach($movies as $item)
    <div class="col-3" style="padding: 2px">
        <div class="product__item">
            <div  class="product__item__pic ">
                <img style="height: 100%" src="{{$item->thumbnail}}" alt="">

                <div class="ep">18 / 18</div>
                <div onclick="showModalDetail({{$item->id}})" class="comment">Xem phim</div>
            </div>
            <div class="product__item__text">
                <ul>
                    <li>Active</li>
                    <li>Movie</li>
                </ul>
                <span class="title-movie-mobile">
                    <a href="#" onclick="showModalDetail($item->id)" class="link-movie-mobile">{{$item->title}}</a>
                </span>
            </div>
        </div>
    </div>
@endforeach
