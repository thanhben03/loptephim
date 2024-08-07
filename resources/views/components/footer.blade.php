<!-- Footer Section Begin -->
<footer class="footer">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
{{--        <div class="row">--}}
{{--            <div class="col-lg-3">--}}
{{--                <div class="footer__logo">--}}
{{--                    <a href="./index.html"><img src="img/logo.png" alt=""></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6">--}}
{{--                <div class="f
ooter__nav">--}}
{{--                    <ul>--}}
{{--                        <li class="active"><a href="./index.html">Homepage</a></li>--}}
{{--                        <li><a href="./categories.html">Categories</a></li>--}}
{{--                        <li><a href="./blog.html">Our Blog</a></li>--}}
{{--                        <li><a href="#">Contacts</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search model Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch"><i class="icon_close"></i></div>
        <form class="search-model-form" action="{{route('search')}}" method="POST">
            @csrf

            <input type="text" name="movie_name" id="search-input" placeholder="Search here.....">
            <select class="form-control" name="type_search">
                <option value="0">Phim</option>
                <option value="1">Game/App</option>
            </select>
            <div class="mt-4" style="float: right">
                <button class="btn btn-success"  type="submit">Tìm kiếm</button>

            </div>

        </form>
        <div class="popup">
            <div class="so btn btn-info" onclick="chonSo(0)">0</div>
            <div class="so btn btn-info" onclick="chonSo(1)">1</div>
            <div class="so btn btn-info" onclick="chonSo(2)">2</div>
            <div class="so btn btn-info" onclick="chonSo(3)">3</div>
            <div class="so btn btn-info" onclick="chonSo(4)">4</div>
            <div class="so btn btn-info" onclick="chonSo(5)">5</div>
            <div class="so btn btn-info" onclick="chonSo(6)">6</div>
            <div class="so btn btn-info" onclick="chonSo(7)">7</div>
            <div class="so btn btn-info" onclick="chonSo(8)">8</div>
            <div class="so btn btn-info" onclick="chonSo(9)">9</div>
            <button class="btn btn-danger" onclick="clearValue()">Clear</button>
        </div>
    </div>
</div>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nhập License</h5>
            </div>
            <div class="modal-body">
                <div id="msg"></div>
                <input type="text" id="license-input" name="license" class="form-control" placeholder="Key">
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" onclick="active()" class="btn btn-primary">Xác thực</button>
            </div>
        </div>
    </div>
    <div class="popup">
        <div class="so btn btn-info" onclick="chonSo1(0)">0</div>
        <div class="so btn btn-info" onclick="chonSo1(1)">1</div>
        <div class="so btn btn-info" onclick="chonSo1(2)">2</div>
        <div class="so btn btn-info" onclick="chonSo1(3)">3</div>
        <div class="so btn btn-info" onclick="chonSo1(4)">4</div>
        <div class="so btn btn-info" onclick="chonSo1(5)">5</div>
        <div class="so btn btn-info" onclick="chonSo1(6)">6</div>
        <div class="so btn btn-info" onclick="chonSo1(7)">7</div>
        <div class="so btn btn-info" onclick="chonSo1(8)">8</div>
        <div class="so btn btn-info" onclick="chonSo1(9)">9</div>
        <button class="btn btn-danger" onclick="clearValue1()">Clear</button>
    </div>
</div>
<!-- Search model end -->

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nhập License</h5>
            </div>
            <div class="modal-body">
                <div id="msg"></div>
                <input type="text" id="license" name="license" class="form-control" placeholder="Key">
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" onclick="active()" class="btn btn-primary">Xác thực</button>
            </div>
        </div>
    </div>
</div>

<!-- Js Plugins -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/player.js')}}"></script>
<script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('js/mixitup.min.js')}}"></script>
<script src="{{asset('js/jquery.slicknav.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="
https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js
"></script>
<script src="{{asset('js/main.js')}}"></script>
<script>
    let interval;
    $( document ).ready(function() {

        if (getCookie('active') != 'true') {
            $('#staticBackdrop').modal('show')

        }
        // interval = setInterval(checkLicenseTenSecond, 2000)
    });

    function checkLicenseTenSecond() {
        console.log(getCookie('session_id'));
        if(getCookie('laravel_session').length <= 0) {
            console.log(getCookie('laravel_session'))
            clearInterval(interval)
        }
        $.ajax({
            url: '{{route('api.liveLicense')}}',
            type: 'POST',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function (res) {
            }
        })
    }

    function active() {
        $.ajax({
            url: '{{route('api.checkLicense')}}',
            type: 'POST',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                'license': $("#license-input").val()
            },
            beforeSend: function () {
                $("#msg").removeClass()
            },
            success: function (res) {
                let date = new Date(res.license.expired);
                let curr = new Date();
                // document.cookie = `active=true; expires=${date};`;
                let ttl = res.license.number_day;
                Cookies.set("active", true, {expires: ttl});
                $("#msg").text('Xác thực thành công !')
                $("#msg").addClass('alert alert-success')

                setTimeout(function () {
                    $('#staticBackdrop').modal('toggle')
                }, 1500)

            },
            error: function (xhr, status, error) {
                var err = JSON.parse(xhr.responseText);
                console.log(err)
                $("#msg").text(err.msg)
                $("#msg").addClass('alert alert-danger')

            }
        })
    }

    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length,c.length);
            }
        }
        return "";
    }

    function showPopup() {
        document.getElementById("popup").style.display = "block";
    }

    function chonSo(so) {
        document.getElementById("search-input").value += so;

    }

    function chonSo1(so) {
        document.getElementById("license-input").value += so;

    }

    function closePopup() {

        document.getElementById("popup").style.display = "none";
    }
    function clearValue() {
        document.getElementById("search-input").value = '';
    }
    function clearValue1() {
        document.getElementById("license-input").value = '';
    }
</script>

@stack('custom-js')

</body>

</html>
