<footer class="site-footer">
  <div class="contenedor clearfix">
    <div class="footer-informacion">
      <h3>Sobre <span>UNTRM-Eventos</span></h3>
      <p>Es un sistema promocionado por el Centro de producción y servicios de la Facultad de Ingeniería de Sistemas y Mecánica Eléctrica FISME - Bagua. Con el apoyo de los alumnos de la Carrera Profesional de Ingeniería de Sistemas.</p>
    </div>
    <!--footer-informacion-->
    <div class="ultimos-tweets">
      <h3>Directivos <span>Centro de Producción y Servicios</span></h3>
      <ul>
        <li>Director: Ing. Roberto Carlos Santa Cruz Arenas.</li>
        <li>Apoyo: Alumnos de la Ingeniería de Sistemas.</li>
      </ul>
    </div>
    <!--.ultimos-tweets-->
    <div class="menu">
      <h3>Redes <span>sociales</span></h3>
      <nav class="redes-sociales">
        <a href="https://www.facebook.com/untrmbagua/?hc_ref=ARSTU3fqVh1PflGUivyDqiLcy8_hBrql_F8oANIYxlHTenBxHaGXNIlzSgnwZrGsBVc&fref=nf&__tn__=kC-R"><i class="fab fa-facebook-square" aria-hidden="true"></i></a>
      </nav>
      <!--.redes-sociales-->
    </div>
    <!--.menu-->
  </div>
  <!--.contenedor-->
  <p class="copyright">Todos los derechos reservados UNTRM-Eventos 2019</p>

  <!-- Begin Mailchimp Signup Form -->
  <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    #mc_embed_signup {
      background: #fff;
      clear: left;
      font: 14px Helvetica, Arial, sans-serif;
    }

    /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
      We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
  </style>
  <div style="display:none;">
    <div id="mc_embed_signup">
      <form action="https://gmail.us4.list-manage.com/subscribe/post?u=407e005e2f49e226a66d0eaa6&amp;id=b4c0599042" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <div id="mc_embed_signup_scroll">
          <h2>Suscribete al Newsletter y no te pierdas nada de este evento</h2>
          <div class="indicates-required"><span class="asterisk">*</span> Es obligatorio</div>
          <div class="mc-field-group">
            <label for="mce-EMAIL">Correo Electrónico <span class="asterisk">*</span>
            </label>
            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
          </div>
          <div class="mc-field-group">
            <label for="mce-FNAME">Nombre </label>
            <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
          </div>
          <div id="mce-responses" class="clear">
            <div class="response" id="mce-error-response" style="display:none"></div>
            <div class="response" id="mce-success-response" style="display:none"></div>
          </div> <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
          <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_407e005e2f49e226a66d0eaa6_b4c0599042" tabindex="-1" value=""></div>
          <div class="clear"><input type="submit" value="Suscribete" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
        </div>
      </form>
    </div>
    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
    <script type='text/javascript'>
      (function($) {
        window.fnames = new Array();
        window.ftypes = new Array();
        fnames[0] = 'EMAIL';
        ftypes[0] = 'email';
        fnames[1] = 'FNAME';
        ftypes[1] = 'text';
        fnames[2] = 'LNAME';
        ftypes[2] = 'text';
        fnames[3] = 'ADDRESS';
        ftypes[3] = 'address';
        fnames[4] = 'PHONE';
        ftypes[4] = 'phone';
        fnames[5] = 'BIRTHDAY';
        ftypes[5] = 'birthday';
      }(jQuery));
      var $mcj = jQuery.noConflict(true);
    </script>
    <!--End mc_embed_signup-->

    <!-- Alerta correct -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="vista/assets/js/sweetalert2.min.js"></script>
    <script src="vista/assets/js/sweetalert2.all.min.js"></script>

  </div>
</footer>











<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
  window.jQuery || document.write('<script src="vista/assets/js/vendor/jquery-3.4.1.min.js"><\/script>')
</script>
<script src="vista/assets/js/plugins.js"></script>
<script src="vista/assets/js/jquery.animateNumber.min.js"></script>
<script src="vista/assets/js/lightbox.js"></script>
<?php
$archivo = basename($_SERVER['REQUEST_URI']);
$pagina = str_replace(".php", "", $archivo);
if ($pagina == 'invitados' || $pagina == 'home') {
  echo '<script src="vista/assets/js/jquery.colorbox-min.js"></script>';
  echo '<script src="vista/assets/js/jquery.waypoints.min.js"></script>';
}
?>
<script src="controlador/js/cotizador.js"></script>
<script src="vista/assets/js/main.js"></script>

<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
  window.ga = function() {
    ga.q.push(arguments)
  };
  ga.q = [];
  ga.l = +new Date;
  ga('create', 'UA-XXXXX-Y', 'auto');
  ga('set', 'transport', 'beacon');
  ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async></script>
<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script>
<script type="text/javascript">
  window.dojoRequire(["mojo/signup-forms/Loader"], function(L) {
    L.start({
      "baseUrl": "mc.us4.list-manage.com",
      "uuid": "407e005e2f49e226a66d0eaa6",
      "lid": "b4c0599042",
      "uniqueMethods": true
    })
  })
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<!-- toggle -->
<script>
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  });

  $(function() {
    $('[data-toggle="popover"]').popover()
  })
</script>

</body>

</html>