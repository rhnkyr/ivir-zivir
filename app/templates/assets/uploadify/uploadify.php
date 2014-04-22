<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/templates/uploads'; // Relative to the root

if (!empty($_FILES)) {
    $tempFile = $_FILES['Filedata']['tmp_name'];

    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/';

    $returnFile = $_FILES['Filedata']['name'];
    $file = $_FILES['Filedata']['name'];
    $file = utf8_decode($file);
    $file = preg_replace("/[^a-zA-Z0-9_.\-\[\]]/i", "", strtr($file, "()İŞşĞğÇçáàâãäéèêëíìîïóòôõöúùûüçÁÀÂÃÄÉÈÊËÍÌÎÏÓÒÔÕÖÚÙÛÜÇ% ", "[]iSsGgCcaaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC__"));
    $file = strtolower($file);

    $fileTypeExts = $_REQUEST['fileTypeExts'];
    if (isset($fileTypeExts)) {
        $fileTypes = str_replace('*.', '', $fileTypeExts);
        $fileTypes = str_replace(';', '|', $fileTypes);
        $typesArray = split('\|', $fileTypes);
        $fileParts = pathinfo($file);
        if (!in_array($fileParts['extension'], $typesArray)) {
            die('File type not allowed!');
        }
    }

    $aux_targetFile = str_replace('//', '/', $targetPath);

    $rand = rand(1000, 9999);
    $newName = $rand . '_' . $file;
    $targetFile = $aux_targetFile . $newName;

    move_uploaded_file($tempFile, $targetFile);

    echo $newName;
}