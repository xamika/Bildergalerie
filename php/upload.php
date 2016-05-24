<?php
/**
 * Created by PhpStorm.
 * User: jajaj
 * Date: 18.05.2016
 * Time: 10:25
 */
include 'db_functions.php';
include 'basic_functions.php';
include 'config.php';
// upload.php
// 'images' refers to your file input name attribute
if (empty($_FILES['images'])) {
    echo json_encode(['error'=>'No files found for upload.']);
    // or you can throw an exception
    return; // terminate
}

// get the files posted
$images = $_FILES['images'];

$galery_id = empty($_POST['galery_id']) ? '' : $_POST['galery_id'];

// a flag to see if everything is ok
$success = null;

// file paths to store
$paths= [];

// get file names
$filenames = $images['name'];

// loop and process files
$target = null;
for($i=0; $i < count($filenames); $i++){
    $ext = explode('.', basename($filenames[$i]));
    $target = "../images/galery/" . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
    if(move_uploaded_file($images['tmp_name'][$i], $target)) {
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
    db_insert_image($target, $galery_id);

    // store a successful response (default at least an empty array). You
    // could return any additional response info you need to the plugin for
    // advanced implementations.
    $output = [];
    // for example you can get the list of files uploaded this way
    // $output = ['uploaded' => $paths];
} elseif ($success === false) {
    $output = ['error'=>'Error while uploading images. Contact the system administrator'];
    // delete any uploaded files
    foreach ($paths as $file) {
        unlink($file);
    }
} else {
    $output = ['error'=>'No files were processed.'];
}

// return a json encoded response for plugin to process successfully
echo json_encode($output);
