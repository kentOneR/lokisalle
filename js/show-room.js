(function () {

    // AJAX HXR INIT
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

    var selectCategoryEls = document.querySelectorAll('#select-category>input'),
        selectCityEls = document.querySelectorAll('#select-city>input'),
        roomContainerEl = document.getElementById('room-container'),
        roomWrapperEls = document.querySelectorAll('.room-wrapper');

    if (selectCategoryEls) {
        for(var i = 0; selectCategoryEls[i]; i++) {
            selectCategoryEls[i].addEventListener('change', function (e) {
                var radio = e.target;
                showElements(roomWrapperEls, 'data-category', radio.value);
            });
        }
    }

    if (selectCityEls) {
        for (var i = 0; selectCityEls[i]; i++) {
            selectCityEls[i].addEventListener('change', function (e) {
                var radio = e.target;
                showElements(roomWrapperEls, 'data-city', radio.value);
            });
        }
    }

    function showElements(els, atr, value) {
        for (var i = 0; els[i]; i++) {
            var elValue = els[i].getAttribute(atr);
            if (elValue === value) {
                els[i].style.display = "block";
            } else {
                els[i].style.display = "none";
            }
        }
    }

    function selectQuery(action, data) {

        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                roomContainerEl.innerHTML = this.responseText;
            }
        }
        xhr.open('POST', 'model/select.room.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send("select=" + data);
    }


})();