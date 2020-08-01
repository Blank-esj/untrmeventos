$(function () {
  //Lettering
  if (document.getElementById("nombre-sitio")) {
    $(".nombre-sitio").lettering();
  }

  //Agregar clase a Menu
  $('body.home .navegacion-principal a:contains("Inicio")').addClass("activo");
  $('body.galeria .navegacion-principal a:contains("Galería")').addClass(
    "activo"
  );
  $('body.calendario .navegacion-principal a:contains("Calendario")').addClass(
    "activo"
  );
  $('body.invitados .navegacion-principal a:contains("Invitados")').addClass(
    "activo"
  );

  //Menu fijo
  var windowHeight = $(window).height();
  var barraAltura = $(".barra").innerHeight();
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll > windowHeight) {
      $(".barra").addClass("fixed");
      $("body").css({ "margin-top": barraAltura + "px" });
    } else {
      $(".barra").removeClass("fixed");
      $("body").css({ "margin-top": "0px" });
    }
  });

  //Menu responsive
  $(".menu-movil").on("click", function () {
    $(".navegacion-principal").slideToggle();
  });

  //Programa de conferencias de la pagina principal
  $(".programa-evento .info-curso:first").show();
  $(".menu-programa a:first").addClass("activo");

  $(".menu-programa a").on("click", function () {
    $(".menu-programa a").removeClass("activo");
    $(this).addClass("activo");
    $(".ocultar").hide();
    var enlace = $(this).attr("href");
    $(enlace).fadeIn(1000);
    return false;
  });

  //Animaciones para los numeros
  /*$('.resumen-evento li:nth-child(1) p').animateNumber({ number: 3}, 1500);
    $('.resumen-evento li:nth-child(2) p').animateNumber({ number: 5}, 1500);
    $('.resumen-evento li:nth-child(3) p').animateNumber({ number: 5}, 1500);*/

  //Colorbox
  if ($(".invitado-info").length) {
    $(".invitado-info").colorbox({ inline: true, width: "50%" });
  }

  //colorbox+mailchimp
  if (document.getElementById("boton_newsletter")) {
    $(".boton_newsletter").colorbox({ inline: true, width: "50%" });
  }
});
