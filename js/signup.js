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

    // SIGNUP OVERLAY
    var signupLinkEl = document.getElementById('nav-link-signup'),
        signupOverlayEl = document.getElementById('signup-overlay');
        signupFormEl = document.getElementById('signup-form'),
        pseudoEl = document.getElementById('pseudo'),
        passwordEl = document.getElementById('password'),
        nameEl = document.getElementById('name'),
        firstNameEl = document.getElementById('firstname'),
        emailEl = document.getElementById('email'),
        sexEl = document.getElementById('sex'),
        signupResultEl = document.getElementById('signup-result');

    if(signupLinkEl){
        signupLinkEl.addEventListener('click', function (e) {
            e.preventDefault();
            signupOverlayEl.classList.toggle("hidden");
        });
    }

    function signup() {
        // Construct the POST variables [username, password]
        var params = "pseudo=" + pseudoEl.value + "&"
            + "password=" + passwordEl.value + "&" + "name=" + nameEl.value + "&" + "firstname=" + firstNameEl.value + "&" + "email=" + emailEl.value + "&" + "sexe=" + sexEl.value;
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                signupResultEl.innerHTML = this.responseText;
            }
        }
        xhr.open('POST', 'inc/signup.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(params);
    }

    signupFormEl.addEventListener('submit', function (e) {
        e.preventDefault();
        signup();
    })

})();