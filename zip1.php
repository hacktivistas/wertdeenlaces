<?php
$za = new ZipArchive();

$za->open('ejemplo.zip');
print_r($za);
var_dump($za);
echo "numFicheros: " . $za->numFiles . "\n";
echo "estado: " . $za->status  . "\n";
echo "estadosSis: " . $za->statusSys . "\n";
echo "nombreFichero: " . $za->filename . "\n";
echo "comentario: " . $za->comment . "\n";

for ($i=0; $i<$za->numFiles;$i++) {
    echo "index: $i\n";
    print_r($za->statIndex($i));
}
echo "numFichero:" . $za->numFiles . "\n";
?>
