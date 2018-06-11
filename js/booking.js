(function(){

    function getXMLHttpRequest() {
        var xhr;
        if (window.XMLHttpRequest) {
            // Instanciation de XMLHttpRequest
            xhr = new XMLHttpRequest();
        } else {
            try {
                xhr = new ActiveXObject('Msxml2.XMLHTTP');
            } catch (e) {
                xhr = new ActiveXObject('Microsoft.XMLHTTP');
            }
        }
        return xhr;
    }

    var xhr = getXMLHttpRequest();

    var formConfirmBookingEl = document.getElementById('confirm-booking'),
        confirmResultEl = document.getElementById('confirm-result')
        confirmFromEl = document.getElementById('arrival-date'),
        confirmToEl = document.getElementById('departure-date'),
        idRoomEl = document.getElementById('id-room');

    if(formConfirmBookingEl){
        formConfirmBookingEl.addEventListener('submit', function(e){
            e.preventDefault();
            checkAvailable();
        });
    }


    function checkAvailable() {
        var params = "id-room=" + idRoomEl.value + "&arrival-date=" + confirmFromEl.value + "&departure-date=" + confirmToEl.value +"&confirm=1";
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                confirmResultEl.innerHTML = this.responseText;
            }
        }
        xhr.open('POST', 'inc/function.booking.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(params);
    }

})();