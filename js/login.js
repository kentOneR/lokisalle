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

    // CONNEXION OVERLAY
    var connexionLinkEl = document.getElementById('nav-link-login'),
        connexionOverlayEl = document.getElementById('connexion-overlay');
        connexionFormEl = document.getElementById('connexion-form'),
        pseudoCheckEl = document.getElementById('check-pseudo'),
        passwordCheckEl = document.getElementById('check-password'),
        loginResultEl = document.getElementById('login-result');

    connexionLinkEl.addEventListener('click', function (e) {
        e.preventDefault();
        connexionOverlayEl.classList.toggle("hidden");
    });

    function checkLogin() {
        var params = "pseudo=" + pseudoCheckEl.value + "&"
            + "password=" + passwordCheckEl.value;
        console.log(params);
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                loginResultEl.innerHTML = this.responseText;
            }
        }
        xhr.open('POST', 'inc/login.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(params);
    }

    connexionFormEl.addEventListener('submit', function (e) {
        e.preventDefault();
        checkLogin();
    })


})();