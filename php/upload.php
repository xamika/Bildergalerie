<?php
/**
 * Created by PhpStorm.
 * User: jajaj
 * Date: 18.05.2016
 * Time: 10:25
 * Quelle: http://webtips.krajee.com/ajax-based-file-uploads-using-fileinput-plugin/
 * Dieses File wurde von krajee erstellt und von mir angepasst
 */
include 'db_functions.php';
include 'basic_functions.php';
include 'config.php';
// upload.php
// 'images' refers to your file input name attribute
if (empty($_FILES['images'])) {
    echo json_encode(['error' => 'No files found for upload.']);
    // or you can throw an exception
    return; // terminate
}

// get the files posted
$images = $_FILES['images'];

$galery_id = empty($_POST['galery_id']) ? '' : $_POST['galery_id'];

// a flag to see if everything is ok
$success = null;

// file paths to store
$paths = [];

// get file names
$filenames = $images['name'];

// loop and process files
$target = null;
for ($i = 0; $i < count($filenames); $i++) {
    $ext = explode('.', basename($filenames[$i]));
    $target = "../images/galery/". DIRECTORY_SEPARATOR . uniqid(rand(10, 50), true) . "." . array_pop($ext);
    while (file_exists($target)) {
        $target = "../images/galery/". DIRECTORY_SEPARATOR . uniqid(rand(10, 50), true) . "." . array_pop($ext);
    }

    if (move_uploaded_file($images['tmp_name'][$i], $target)) {
        $success = true;
        $paths[] = $target;
    } else {
        $success = false;
        break;
    }
}

// check and process based on successful status
if ($success === true) {
    // call the function to save all data to database
    // code for the following function `save_data` is not
    // mentioned in this example

    $filename = $target;

// Set a maximum height and width
    $width = 200;
    $height = 200;


// Get new dimensions
    list($width_orig, $height_orig) = getimagesize($filename);

    $ratio_orig = $width_orig / $height_orig;

    if ($width / $height > $ratio_orig) {
        $width = $height * $ratio_orig;
    } else {
        $height = $width / $ratio_orig;
    }

// Resample
    $image_p = imagecreatetruecolor($width, $height);
    $image = imagecreatefromjpeg($filename);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

    imagejpeg($image_p, $target ."_thumb.jpg", 100);
    db_insert_image($target, $galery_id, $target  ."_thumb.jpg");

    // store a successful response (default at least an empty array). You
    // could return any additional response info you need to the plugin for
    // advanced implementations.
    $output = [];
    // for example you can get the list of files uploaded this way
    // $output = ['uploaded' => $paths];
} elseif ($success === false) {
    $output = ['error' => 'Error while uploading images. Contact the system administrator'];
    // delete any uploaded files
    foreach ($paths as $file) {
        unlink($file);
        unlink($file . "_thumb.jpg");
    }
} else {
    $output = ['error' => 'No files were processed.'];
}

// return a json encoded response for plugin to process successfully
echo json_encode($output);