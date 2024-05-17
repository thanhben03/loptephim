@foreach($movies as $item)
    <div class="col-3" style="padding: 2px">
        <div class="product__item">
            <div  class="product__item__pic set-bg">
                <img src="{{$item->movie->thumbnail}}">
                <div class="ep">18 / 18</div>
                <div onclick="showModalDetail({{$item->movie->id}})" class="comment">Xem phim</div>
            </div>
            <div class="product__item__text">
                <ul>
                    <li>Active</li>
                    <li>Movie</li>
                </ul>
                <h5><a href="#">{{$item->movie->title}}</a></h5>
            </div>
        </div>
    </div>
@endforeach
