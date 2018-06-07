(function () {


        // SIGNUP OVERLAY
        var signupLinkEl = document.getElementById('nav-link-signup'),
        signupOverlayEl = document.getElementById('signup-overlay');
        signupFormEl = document.getElementById('signup-form'),
        pseudoEl = document.getElementById('pseudo'),
        passwordEl = document.getElementById('password'),
        signupResultEl = document.getElementById('signup-result');

        signupLinkEl.addEventListener('click', function (e) {
            e.preventDefault();
            signupOverlayEl.classList.toggle("hidden");
        });

})();