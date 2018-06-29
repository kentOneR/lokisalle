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
        loginResultEl = document.getElementById('login-result'),
        closeLoginEl = document.getElementById('close-login'),
        showLoginEls = document.getElementsByClassName('show-login');

    if(connexionLinkEl){
        connexionLinkEl.addEventListener('click', function (e) {
            e.preventDefault();
            connexionOverlayEl.classList.toggle("hidden");
        });
    }

    if(showLoginEls){
        for(var i=0; showLoginEls[i]; i++){
            showLoginEls[i].addEventListener('click', function (e) {
                e.preventDefault();
                connexionOverlayEl.classList.remove("hidden");
            });
        }
    }

    function checkLogin() {
        var params = "pseudo=" + pseudoCheckEl.value + "&"
            + "password=" + passwordCheckEl.value;
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                loginResultEl.innerHTML = this.responseText;
                if(!this.responseText.includes('Erreur')){
                    setTimeout(function(){ 
                        connexionOverlayEl.classList.add("hidden");
                        window.location.reload(); 
                    }, 2000);
                }
            }
        }
        xhr.open('POST', 'model/login.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(params);
    }

    if(connexionFormEl){
        connexionFormEl.addEventListener('submit', function (e) {
            e.preventDefault();
            checkLogin();
            connexionFormEl.reset();
        });
        closeLoginEl.addEventListener('click', function(e){
            connexionOverlayEl.classList.add("hidden");
            connexionFormEl.reset();
        });
    }

})();