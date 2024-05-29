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
                <h4 class="card-title">Edit Game Mod</h4>
                <form method="POST" action="{{ route('admin.game.update', $game->id) }}" class="forms-sample">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputName1">Name: </label>
                        <input type="text" value="{{$game->name}}" onkeyup="ChangeToSlug()" name="name" class="form-control" id="title"
                               placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Slug</label>
                        <input type="text" value="{{$game->slug}}" class="form-control" id="slug" name="slug" placeholder="Slug">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Thể loại</label>
                        <input type="text" class="form-control" value="{{$game->genre_name}}" name="genre_name">

                    </div>
                    <div class="form-group mt-3">
                        <select class="form-control" name="type">
                            <option value="0" @if(!$game->type) selected @endif>Game Mod</option>
                            <option value="1" @if($game->type) selected @endif>App Mod</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Version</label>
                        <input value="{{$game->version}}" type="text" name="version" class="form-control" id="version"
                               placeholder="Version">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Thumbnail</label>
                        <input value="{{$game->thumbnail}}" onkeyup="onShowImage()" type="text" name="thumbnail" class="form-control" id="thumbnail"
                               placeholder="thumbnail">
                    </div>
                    <div class="form-group show-image">

                    </div>
                    <div class="form-group">
                        <span onclick="saveContentMod()" class="btn btn-success">Save</span>
                        <label for="exampleTextarea1">Tính năng mod:</label>
                        <textarea rows="5" class="form-control" id="sample-mod">{{$game->mod_feartured}}</textarea>
                        <input type="text" name="mod_feartured" value="{{$game->mod_feartured}}" hidden id="mod_feartured">

                    </div>
                    <div>
                        <label for="exampleTextarea1">Mô tả:</label>
                        <span onclick="saveContent()" class="btn btn-success">Save</span>
                        <textarea rows="5" onchange="saveContent()" class="form-control" id="sample">{{$game->desc}}</textarea>
                        <input type="text" name="desc" value="{{$game->desc}}" hidden id="desc">
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

        const editor = SUNEDITOR.create((document.getElementById('sample') || 'sample'),{
            lang: SUNEDITOR_LANG['en'],
            // font : [
            //     'Arial',
            //     'tohoma',
            //     'Courier New,Courier'
            // ],
            buttonList: [
                ['undo', 'redo'],
                ['font', 'fontSize', 'formatBlock'],
                ['paragraphStyle', 'blockquote'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                ['fontColor', 'hiliteColor', 'textStyle'],
                ['removeFormat'],
                '/', // Line break
                ['outdent', 'indent'],
                ['align', 'horizontalRule', 'list', 'lineHeight'],
                ['table', 'link', 'image', 'video', 'audio' /** ,'math' */], // You must add the 'katex' library at options to use the 'math' plugin.
                /** ['imageGallery'] */ // You must add the "imageGalleryUrl".
                ['fullScreen', 'showBlocks', 'codeView'],
                ['preview', 'print'],
                ['save', 'template'],
                /** ['dir', 'dir_ltr', 'dir_rtl'] */ // "dir": Toggle text direction, "dir_ltr": Right to Left, "dir_rtl": Left to Right
            ],
            defaultStyle: 'font-family:arial'


        });

        const editor1 = SUNEDITOR.create((document.getElementById('sample-mod') || 'sample'),{
            lang: SUNEDITOR_LANG['en'],
            // font : [
            //     'Arial',
            //     'tohoma',
            //     'Courier New,Courier'
            // ],
            buttonList: [
                ['undo', 'redo'],
                ['font', 'fontSize', 'formatBlock'],
                ['paragraphStyle', 'blockquote'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                ['fontColor', 'hiliteColor', 'textStyle'],
                ['removeFormat'],
                '/', // Line break
                ['outdent', 'indent'],
                ['align', 'horizontalRule', 'list', 'lineHeight'],
                ['table', 'link', 'image', 'video', 'audio' /** ,'math' */], // You must add the 'katex' library at options to use the 'math' plugin.
                /** ['imageGallery'] */ // You must add the "imageGalleryUrl".
                ['fullScreen', 'showBlocks', 'codeView'],
                ['preview', 'print'],
                ['save', 'template'],
                /** ['dir', 'dir_ltr', 'dir_rtl'] */ // "dir": Toggle text direction, "dir_ltr": Right to Left, "dir_rtl": Left to Right
            ],
            defaultStyle: 'font-family:arial'


        });
        function init() {
            editor.setContents(document.getElementById('desc').value);
        }
        init();
        function saveContent() {
            // console.log(editor.getContents())
            document.getElementById('desc').value = editor.getContents();

        }
        function saveContentMod() {
            // console.log(editor.getContents())
            document.getElementById('mod_feartured').value = editor1.getContents();

        }
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
