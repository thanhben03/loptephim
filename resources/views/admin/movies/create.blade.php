@extends('layouts.admin')
@section('content')
    <!-- Button trigger modal -->

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
                <h4 class="card-title">Thêm Movie</h4>
                <form method="POST" action="{{ route('admin.movie.store') }}" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input type="text" onkeyup="ChangeToSlug()" name="title" class="form-control" id="title"
                            placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Thể loại</label>
                        <select class="form-control" name="genre_id">
                            @foreach($genres as $genre)
                                <option value="{{$genre->id }}">{{$genre->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Quốc gia</label>
                        <select class="form-control" name="country_id">
                            @foreach($countries as $country)
                                <option value="{{$country->id }}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Thumbnail</label>
                        <input onkeyup="onShowImage()" type="text" name="thumbnail" class="form-control" id="thumbnail"
                            placeholder="thumbnail">
                    </div>
                    <div class="form-group show-image">

                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Mô tả</label>
                        <textarea name="desc" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Vietsub</label>
                        <select name="is_vietsub" class="form-control" id="exampleSelectGender">
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCity1">Ngày phát hành</label>
                        <input type="date" name="release_date" class="form-control" id="exampleInputCity1"
                            placeholder="Location">
                    </div>
                    <div class="form-group link-movie">
                        <div class="wrap-add-movie">
                            <label for="exampleInputCity1">Link</label>
                            <button type="button" class="btn-add-movie" data-bs-toggle="modal"
                                data-bs-target="#modal">Thêm</button>
                        </div>
                        <i class="mdi mdi-delete"></i>

                        <div class="wrap-movie-link">
                            <div class="wrap-link">
{{--                                <input type="text" name="link[]" class="form-control" id="exampleInputCity1">--}}
{{--                                <i class="typcn typcn-delete-outline menu-icon btn-deletel-link"></i>--}}
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
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
