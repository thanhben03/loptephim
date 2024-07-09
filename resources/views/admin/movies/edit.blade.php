@extends('layouts.admin')
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm link xem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail3">Tên hiển thị: </label>
                        <input type="text" class="form-control" id="name_link" name="name_link" placeholder="Link vietsub,v.v">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Link: </label>
                        <input type="text" class="form-control" id="linkModal" name="linkModal" placeholder="Link">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" data-bs-dismiss="modal" onclick="addLinkToMovie()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chỉnh sửa Movie</h4>
                <form method="POST" action="{{ route('admin.movie.update', $movie->id) }}" class="forms-sample">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input type="text" value="{{$movie->title}}" onkeyup="ChangeToSlug()" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Slug</label>
                        <input type="text" value="{{$movie->slug}}" class="form-control" id="slug" name="slug" placeholder="Slug">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail3">Thể loại</label>
                        <select class="form-control" name="genre_id[]" multiple id="genre1">
                            @foreach($genres as $genre)
                                <option
                                    @if(in_array($genre->id, $genreIds))
                                        selected
                                    @endif
                                    value="{{$genre->id }}">{{$genre->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Quốc gia</label>
                        <input class="form-control" type="text" name="country" value="{{$movie->country}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Thumbnail</label>
                        <input onkeyup="onShowImage()" value="{{$movie->thumbnail}}" type="text" name="thumbnail" class="form-control" id="thumbnail" placeholder="thumbnail">
                    </div>
                    <div class="form-group show-image">
                        @if($movie->thumbnail)
                            <img style="height: 200px" src="{{$movie->thumbnail}}" />
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail3">Ngôn ngữ</label>
                        <select class="form-control" name="language_id[]" multiple id="language_id">
                            @foreach($countries as $language)
                                <option
                                    @if(in_array($language->id, $languageIds))
                                        selected
                                    @endif
                                    value="{{$language->id }}">{{$language->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCity1">Năm phát hành</label>
                        <input type="text" value="{{$movie->release_date}}" name="release_date" class="form-control" id="exampleInputCity1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCity1">Link trailer</label>
                        <input type="text" value="{{$movie->trailer}}" name="trailer" class="form-control" id="exampleInputCity1" placeholder="">
                    </div>
                    <div class="form-group link-movie">
                        <div class="wrap-add-movie">
                            <label for="exampleInputCity1">Link</label>
                            <button type="button" class="btn-add-movie" data-bs-toggle="modal"
                                    data-bs-target="#modal">Thêm</button>
                        </div>

                             <div class="wrap-movie-link">
                                 @foreach($links as $key=> $link)

                                     <div class="wrap-link">
                                         <div class="row" style="margin-bottom: 10px">
                                             <input value="{{$link->name}}" type="text" name="link[{{$key}}][name]" class="col-6" id="exampleInputCity1">
                                             <input value="{{$link->link}}" type="text" name="link[{{$key}}][link]" class="col-6" id="exampleInputCity1">

                                         </div>
                                         <i onclick="removeLink(this)" class="typcn typcn-delete-outline menu-icon btn-deletel-link"></i>
                                     </div>
                                 @endforeach
                             </div>

                    </div>


                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="button" onclick="history.go(-1)" class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {

            $('#genre1').select2();
            $('#language_id').select2();
        });



    </script>
    <script>


        function addLinkToMovie() {
            let linkModal = $("#linkModal")[0];
            // console.log(linkModal[0]); return;
            let link = $(".wrap-movie-link").append(
                `
                     <div class="wrap-link">
                        <input type="text" name="link[]" class="form-control" value="${linkModal.value}" id="exampleInputCity1">
                        <i onclick="removeLink(this)" class="typcn typcn-delete-outline menu-icon btn-deletel-link"></i>
                    </div>

                `
            )

            linkModal.value = ''
            $('#modal').modal('toggle');
        }
        function removeLink(e) {
            e.parentElement.remove();
        }
        function ChangeToSlug() {
            var title, slug;

            //Lấy text từ thẻ input title
            title = document.getElementById("title").value;
            console.log(title)
            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, " - ");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            slug = slug.replace(/ /gi, "");
            //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        }

        function onShowImage() {
            let thumbnail = document.getElementById('thumbnail');
            let showImage = document.querySelector('.show-image');
            console.log(showImage);
            showImage.innerHTML = `<image style="height: 200px" src="${thumbnail.value}" />`
        }
    </script>
@endpush
