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
        addressEl = document.getElementById('address'),
        zipEl = document.getElementById('cp'),
        cityEl = document.getElementById('city'),
        signupResultEl = document.getElementById('signup-result'),
        closeSignupEl = document.getElementById('close-signup'),
        showSignupEl = document.getElementById('show-signup'),
        connexionOverlayEl = document.getElementById('connexion-overlay');

    if(signupLinkEl){
        signupLinkEl.addEventListener('click', function (e) {
            e.preventDefault();
            signupOverlayEl.classList.toggle("hidden");
        });
    }

    if(showSignupEl){
        showSignupEl.addEventListener('click', function (e) {
            e.preventDefault();
            signupOverlayEl.classList.toggle("hidden");
        });
    }

    function signup() {
        // Construct the POST variables [username, password]
        var params = "pseudo=" + pseudoEl.value + "&password=" + passwordEl.value + "&name=" + nameEl.value + "&firstname=" + firstNameEl.value + "&email=" + emailEl.value + "&sexe=" + sexEl.value
        + "&address=" + addressEl.value + "&zip=" + zipEl.value + "&city=" + cityEl.value;
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                signupResultEl.innerHTML = this.responseText;
                if(this.responseText.includes('validée')){
                    setTimeout(function(){ 
                        signupOverlayEl.classList.add("hidden");
                        connexionOverlayEl.classList.remove("hidden");
                    }, 2000);
                }
            }
        }
        xhr.open('POST', 'inc/signup.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(params);
    }

    signupFormEl.addEventListener('submit', function (e) {
        e.preventDefault();
        signup();
    });

    closeSignupEl.addEventListener('click', function(e){
        signupOverlayEl.classList.add("hidden");
    });

})();