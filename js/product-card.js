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

    var formBookingEl = document.getElementById('book-room'),
        roomResultEl = document.getElementById('room-result')
        searchFromEl = document.getElementById('search-from'),
        searchToEl = document.getElementById('search-from'),
        idRoomEl = document.getElementById('id-room');

    if(formBookingEl){
        formBookingEl.addEventListener('submit', function(e){
            e.preventDefault();
            checkAvailable();
        });
    }


    function checkAvailable() {
        var params = "id-room=" + idRoomEl.value + "&arrival-date=" + searchFromEl.value + "&departure-date=" + searchToEl.value +"&booking=1";
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = 'booking.php?id-room=' + idRoomEl.value +'&arrival-date=' + searchFromEl.value + '&departure-date=' + searchToEl.value;
                roomResultEl.innerHTML = this.responseText;
            }
        }
        xhr.open('POST', 'inc/function.booking.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(params);
    }


})();