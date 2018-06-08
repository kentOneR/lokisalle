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

    var selectCategoryEls = document.querySelectorAll('#select-category>li'),
        selectCityEls = document.querySelectorAll('#select-city>li'),
        roomContainerEl = document.getElementById('room-container');

    if (selectCategoryEls) {
        for (var i = 0; selectCategoryEls[i]; i++) {
            selectCategoryEls[i].addEventListener('click', function (e) {
                var dataCategory = e.target.getAttribute("data-category");
                selectQuery("category", dataCategory);
            });
        }
    }

    if (selectCityEls) {
        for (var i = 0; selectCityEls[i]; i++) {
            selectCityEls[i].addEventListener('click', function (e) {
                var dataCity = e.target.getAttribute("data-city");
                selectQuery("city", dataCity);
            });
        }
    }

    function selectQuery(action, data) {
        var params =  action +"=" + data;
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                roomContainerEl.innerHTML = this.responseText;
            }
        }
        xhr.open('POST', 'inc/function.select.room.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(params);
    }


})();