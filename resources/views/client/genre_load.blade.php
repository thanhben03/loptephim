@foreach($movies as $item)
    <div  class="col-3" style="padding: 4px">
        <div class="product__item" onclick="showModalDetail({{$item->id}})" >
            <div class="product__item__pic set-bg">
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
