        <script src="/assets/js/jquery.js"></script>

        <script src="/assets/js/masden.js"></script>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>

        <script>
        window.addEventListener("load", function(){
            window.cookieconsent.initialise({
              "palette": {
                "popup": {
                  "background": "#92290C"
                },
                "button": {
                  "background": "#fff"
                }
              },
              "theme": "classic",
              "content": {
                "message": "Ce site utilise des cookies pour améliorer l'expérience utilisateur.",
                "dismiss": "D'accord",
                "link": "En savoir plus",
                "href": "#"
              }
            })
        });
        </script>


        @yield('js')

    </body>



</html>