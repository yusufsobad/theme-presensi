window.setTimeout("waktu()", 1000);

    function waktu() {
        var waktu = new Date();
        setTimeout("waktu()", 1000);
        j = waktu.getHours().toString();
        if (j.length < 2) {
            j = '0' + j;
        }

        m = waktu.getMinutes().toString();
        if (m.length < 2) {
            m = '0' + m;
        }
        // document.getElementById("jam").innerHTML = waktu.getHours();
        // document.getElementById("menit").innerHTML = waktu.getMinutes();
        document.getElementById("hour").innerHTML = j
        document.getElementById("minute").innerHTML = m
    }

    function blink() {
        $('#sparator').fadeOut();
        $('#sparator').fadeIn();
    }

    setInterval(blink, 1000);