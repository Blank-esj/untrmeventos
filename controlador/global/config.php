<?php
// Constantes para la conexión a la base de datos
define("SERVIDOR", "localhost");
define("BASEDATOS", "untrmeventos");
define("USUARIO", "root");
define("CONTRASENA", "1234");

// Constantes para encriptación de datos
define("KEY", "untrmeventos");
define("COD", "AES-192-ECB");

// Nombre del nodo de la Sesión
define("SESION", "untrmeventos");
// Nombre de los segundos nodos de la Sesión
define("N_PLANES", "planes");
define("N_ARTICULOS", "articulos");
define("N_USUARIO", "usuario");
// Nombre de los segundos nodos de la Sesión
define("N_USUARIO_USUARIO", "usuario");
define("N_CONTRASENA_USUARIO", "contrasena");
define("N_NOMBRE_USUARIO", "nombre");
define("N_NIVEL_USUARIO", "nivel");
define("N_ID_USUARIO", "id");
// Nodos de planes
define("N_NOMBRE_PLAN", "nombre");
define("N_PRECIO_PLAN", "precio");
define("N_ASISTENTES_PLAN", "asistentes");
// Nodo de asistentes a un plan
define("N_DOC_IDENTIDAD_ASISTENTE", "doc_identidad");
define("N_NOMBRE_ASISTENTE", "nombre");
define("N_APELLIDOPA_ASISTENTE", "apellidopa");
define("N_APELLIDOMA_ASISTENTE", "apellidoma");
define("N_EMAIL_ASISTENTE", "email");
define("N_TELEFONO_ASISTENTE", "telefono");
define("N_REGALO_ASISTENTE", "regalo");
// Nombre del ID del regalo de un asistente a un plan
define("N_ID_REGALO", "id");
// Nombre del nodos de articulos
define("N_NOMBRE_ARTICULO", "nombre");
define("N_PRECIO_ARTICULO", "precio");
define("N_CANTIDAD_ARTICULO", "cantidad");

// PAYPAL SANDBOX
define("LINKAPI", "https://api.sandbox.paypal.com");
define("CLIENTID", "Acw6JKOkE9XtSjX3J4sqkwIjHjMCiE93-a_f5Pek11wumC8v4gnfnAu6djkG8UZ-fxHvctvKl3-8ug2B");
define("SECRETID", "EKEen4RxNW4ZlbcBwZ_Ca_Elf_hJoQ50x6IG5RyDOzqBBY71BLXIDzwUyzto4V0902mqwpHC4-G1FAWh");

// DIRECTORIOS DE IMAGENES
/**
 * Directorio donde se guardan las imagenes de los invitados
 */
define("DIR_IMG_INVITADO", "vista/assets/img/invitados/");

/**
 * Directorio de imagenes de articulos
 */
define("DIR_IMG_ARTICULO", "vista/assets/img/articulos/");
