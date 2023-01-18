<?php 

$files = scandir('../fatture/');
//print_r($files);

$zip_file_name_with_location = "../fatture/tutte-le-fatture.zip";
touch($zip_file_name_with_location); 
$zip = new ZipArchive;

$zip->open($zip_file_name_with_location);

for($i = 2;$i < count($files); $i++){
    $zip->addFile("../fatture/" . $files[$i],$files[$i]);
}

$zip->close();

$demo_name = "tutte-le-fatture.zip";
header('Content-type: application/zip');
header('Content-Disposition: attachment; filename="'.$demo_name.'"');
readfile($zip_file_name_with_location); 

unlink($zip_file_name_with_location);

header('Location: ../vendite-insegnante.html');
?>