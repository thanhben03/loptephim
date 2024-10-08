<button onclick="a()" id="btnCam">Open Camera</button>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    function a() {
        $.ajax({
            type: "POST",
            url: "https://8e10-113-23-96-150.ngrok-free.app/command",
            crossDomain: true,
            headers: {  'Access-Control-Allow-Origin': 'https://8e10-113-23-96-150.ngrok-free.app/command' },
            type: 'json',
            data: {
              'command': 'scan_qr'
            },
            success: function (res) {
                console.log(res)
            },
            error: function (xhr) {
                console.log(xhr.responseJSON)
            }
        })
    }
</script>
