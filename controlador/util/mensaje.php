<?php
function mensaje(string $mensaje, string $tipo)
{
    echo "<script> Swal.fire('Aviso', '" . $mensaje . "', '" . $tipo . "'); </script>";
}
