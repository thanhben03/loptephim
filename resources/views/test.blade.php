<button onclick="a()" id="btnCam">Open Camera</button>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    function a() {
        $.ajax({
            type: "GET",
            url: "{{route('test.camera')}}",
            success: function (res) {
                console.log(res)
            },
            error: function (xhr) {
                console.log(xhr.responseJSON)
            }
        })
    }
</script>
