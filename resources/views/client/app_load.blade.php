@foreach($games as $item)
    <div class="col-6" style="padding: 4px">
        <div class="product__item" onclick="showModalDetail({{$item->id}})">
            <div class="game__item__pic set-bg">
                <img style="height: 100%" src="{{$item->thumbnail}}" alt="">
                <div class="ep">{{$item->version}}</div>
            </div>
            <div class="product__item__text">
                <span class="title-movie-mobile">
                    <a onclick="showModalDetail({{$item->id}})" class="link-movie-mobile">
                        {{$item->name}}
                    </a>
                </span>
            </div>
        </div>
    </div>
@endforeach
