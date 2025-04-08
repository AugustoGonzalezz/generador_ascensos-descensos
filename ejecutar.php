<?php
function actualizarCSV($archivoCSV) {
    $rangos = [
        "Comandante",
        "Capitan",
        "Comisario",
        "Teniente",
        "Sargento II",
        "Sargento I",
        "Inspector",
        "Oficial III",
        "Oficial II",
        "Oficial I",
        "Suboficial",
        "Cadete",
        "Estudiante"
    ];

    if (!file_exists($archivoCSV)) {
        echo "Este archivo no ha sido encontrado.";
        return;
    }

    $fecha = date("Y-m-d");
    $carpetaPrincipal = "Reunion Ascensos - $fecha";
    if (!is_dir($carpetaPrincipal)) {
        mkdir($carpetaPrincipal, 0777, true);
    }

    $subcarpetas = ["Ascensos", "Descensos", "Expulsiones"];
    foreach ($subcarpetas as $subcarpeta) {
        $ruta = $carpetaPrincipal . DIRECTORY_SEPARATOR . $subcarpeta;
        if (!is_dir($ruta)) {
            mkdir($ruta, 0777, true);
        }
    }

    $archivo = fopen($archivoCSV, 'r');
    $datos = [];
    $encabezados = fgetcsv($archivo);

    while ($fila = fgetcsv($archivo)) {
        $datos[] = array_combine($encabezados, $fila);
    }
    fclose($archivo);

    $archivoAscensos = fopen("$carpetaPrincipal/Ascensos/listado_ascensos.txt", 'w');
    $archivoDescensos = fopen("$carpetaPrincipal/Descensos/listado_descensos.txt", 'w');
    $archivoExpulsiones = fopen("$carpetaPrincipal/Expulsiones/listado_expulsiones.txt", 'w');

    fwrite($archivoAscensos, "*** ASCENSOS ***\n\n");
    foreach ($datos as $dato) {
        $rangoActual = array_search(trim(strtolower($dato['Rangos'])), array_map('strtolower', $rangos));
        $rangoNuevo = array_search(trim(strtolower($dato['Nuevos Rangos'])), array_map('strtolower', $rangos));

        if ($rangoActual !== false && $rangoNuevo !== false && $rangoNuevo < $rangoActual) {
            fwrite($archivoAscensos, "Nombre: {$dato['Nombre']}\n");
            fwrite($archivoAscensos, "Institucion: {$dato['Institucion']}\n");
            fwrite($archivoAscensos, "Rango Anterior: {$dato['Rangos']}\n");
            fwrite($archivoAscensos, "Rango Nuevo: {$dato['Nuevos Rangos']}\n");
            fwrite($archivoAscensos, "----------------------\n");
        }
    }

    fwrite($archivoDescensos, "*** DESCENSOS ***\n\n");
    foreach ($datos as $dato) {
        $rangoActual = array_search(trim(strtolower($dato['Rangos'])), array_map('strtolower', $rangos));
        $rangoNuevo = array_search(trim(strtolower($dato['Nuevos Rangos'])), array_map('strtolower', $rangos));

        if ($rangoActual !== false && $rangoNuevo !== false && $rangoNuevo > $rangoActual) {
            fwrite($archivoDescensos, "Nombre: {$dato['Nombre']}\n");
            fwrite($archivoDescensos, "Institucion: {$dato['Institucion']}\n");
            fwrite($archivoDescensos, "Rango Anterior: {$dato['Rangos']}\n");
            fwrite($archivoDescensos, "Rango Nuevo: {$dato['Nuevos Rangos']}\n");
            fwrite($archivoDescensos, "----------------------\n");
        }
    }

    fwrite($archivoExpulsiones, "*** EXPULSIONES ***\n\n");
    foreach ($datos as $dato) {
        $rangoNuevo = trim(strtolower($dato['Nuevos Rangos'])); 
        if ($rangoNuevo === 'expulsado' || $rangoNuevo === 'expulsion') {
            fwrite($archivoExpulsiones, "Nombre: {$dato['Nombre']}\n");
            fwrite($archivoExpulsiones, "Institucion: {$dato['Institucion']}\n");
            fwrite($archivoExpulsiones, "Rango Anterior: {$dato['Rangos']}\n");
            fwrite($archivoExpulsiones, "----------------------\n");
        }
    }


    fclose($archivoAscensos);
    fclose($archivoDescensos);
    fclose($archivoExpulsiones);

    echo "Los archivos han sido generados correctamente en la carpeta <b>$carpetaPrincipal</b>";
}

$archivoCSV = 'revision/controlSAPD.csv';
actualizarCSV($archivoCSV);
?>
