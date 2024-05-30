@foreach($games as $item)
    <div class="col-6" style="padding: 4px">
        <div class="product__item" onclick="showModalDetail({{$item->id}})">
            <div class="game__item__pic set-bg">
                <img style="height: 100%" src="{{$item->thumbnail}}" alt="">
                <div class="btn btn-success vietsub" style="margin: 5px 0">{{$item->version}}</div>
{{--                <div onclick="showModalDetail({{$item->id}})" class="comment">Download</div>--}}
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
