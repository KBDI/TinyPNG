<?php
include 'includes/settings.php';
include 'includes/functions.php';

$folder = __DIR__ . "\images";
$filelist = scandir($folder);
if(count($filelist) == 2)
	die("Папка пустая!\n");

$countFiles = count($filelist);
for ($i=0; $i < $countFiles; $i++) { 
    if(is_dir($folder . "\\" . $filelist[$i])){
        unset($filelist[$i]);
    }
}

$status_max = count($filelist);
$status_this = 1;
$files = "";
foreach($filelist as $i => $filename) {
    $pathFile = $folder.'\\'.$filename;
    $defaultFileSize = formatSize(filesize($pathFile));
	$source = Tinify\fromFile($pathFile)->toFile($pathFile);
	$files .= $filename . " (" . $defaultFileSize . " -> " . formatSize($source) . ")\n";

	clear();
	echo($files);
	show_status($status_this++, $status_max);
}

echo("\n\n" . "Готово!" . "\n");