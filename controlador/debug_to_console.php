<?php
/**
 * Funcion que muestra en la consola del navegador el resultado que se le pase por parametro
 */
function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = "[" . implode(', ', $output) . "]";

    echo "<script>console.log( '" . $output . "' );</script>";
}
