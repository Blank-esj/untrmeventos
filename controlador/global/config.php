<?php
// Contantes para la conexión a la base de datos
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
define("CLIENTID", "");
define("SECRETID", "");