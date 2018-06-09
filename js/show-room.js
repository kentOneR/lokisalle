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
        roomContainerEl = document.getElementById('room-container');

    if (selectCategoryEls) {
        var dataCategory = [];
        for (var i = 0; selectCategoryEls[i]; i++) {
            selectCategoryEls[i].addEventListener('change', function (e) {
                var checkbok = e.target;
                if(checkbok.checked) {
                    dataCategory.push(checkbok.value);
                    console.log(dataCategory);
                } else {
                    var index = dataCategory.indexOf(checkbok.value);
                    if (index > -1) {
                    dataCategory.splice(index, 1);
                    }
                    console.log(dataCategory);
                }
                //jsonCategory = JSON.stringify(dataCategory);
                // selectQuery("category", jsonCategory);
            });
        }
    }

    if (selectCityEls) {
        var dataCity = [];
        for (var i = 0; selectCityEls[i]; i++) {
            selectCityEls[i].addEventListener('change', function (e) {
                var checkbok = e.target;
                if(checkbok.checked) {
                    dataCity.push(checkbok.value);
                    console.log(dataCity);
                } else {
                    var index = dataCity.indexOf(checkbok.value);
                    if (index > -1) {
                    dataCity.splice(index, 1);
                    }
                    console.log(dataCity);
                }
                // jsonCategory = JSON.stringify(dataCategory);
                // selectQuery("category", jsonCategory);
            });
        }
    }

    function selectQuery(action, data) {

        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                roomContainerEl.innerHTML = this.responseText;
            }
        }
        xhr.open('POST', 'inc/function.select.room.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send("select=" + data);
    }


})();