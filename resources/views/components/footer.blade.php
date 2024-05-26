<!-- Footer Section Begin -->
<footer class="footer">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer__logo">
                    <a href="./index.html"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="footer__nav">
                    <ul>
                        <li class="active"><a href="./index.html">Homepage</a></li>
                        <li><a href="./categories.html">Categories</a></li>
                        <li><a href="./blog.html">Our Blog</a></li>
                        <li><a href="#">Contacts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>

            </div>
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

            <div class="mt-4" style="float: right">
                <button onclick="showPopup()" class="btn btn-info" type="button">Mở bàn phím</button>
                <button class="btn btn-success"  type="submit">Tìm kiếm</button>
            </div>
        </form>
        <div id="popup">
            <div class="so" onclick="chonSo(0)">0</div>
            <div class="so" onclick="chonSo(1)">1</div>
            <div class="so" onclick="chonSo(2)">2</div>
            <div class="so" onclick="chonSo(3)">3</div>
            <div class="so" onclick="chonSo(4)">4</div>
            <div class="so" onclick="chonSo(5)">5</div>
            <div class="so" onclick="chonSo(6)">6</div>
            <div class="so" onclick="chonSo(7)">7</div>
            <div class="so" onclick="chonSo(8)">8</div>
            <div class="so" onclick="chonSo(9)">9</div>
            <button class="btn btn-success" onclick="closePopup()">Close</button>
            <button class="btn btn-danger" onclick="clearValue()">Clear</button>
        </div>
    </div>
</div>

<!-- Search model end -->

<!-- Js Plugins -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/player.js')}}"></script>
<script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('js/mixitup.min.js')}}"></script>
<script src="{{asset('js/jquery.slicknav.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script>
    function showPopup() {
        document.getElementById("popup").style.display = "block";
    }

    function chonSo(so) {
        document.getElementById("search-input").value += so;

    }

    function closePopup() {

        document.getElementById("popup").style.display = "none";
    }
    function clearValue() {
        document.getElementById("search-input").value = '';
    }
</script>

@stack('custom-js')

</body>

</html>
