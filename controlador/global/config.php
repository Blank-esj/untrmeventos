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
define("CLIENTID", "Ad3BzvK8xD2dM0ZsVLJWFjKITqLEYEStaSxe3zGH7eZ8NykLhTlLzR4aaiEHApGyek7TM5pcbfw3zrJj");
define("SECRETID", "EDXuvb80VgIBqxsh85lyNKdkxCZtqe4eKVFUPrceYuxCADBlI1CB-6oECR74Icm6aQKvO7f_sPtUoK11");