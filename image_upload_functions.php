<?php

require_once __DIR__ . "\imagekitapi/vendor/autoload.php";

use ImageKit\ImageKit;

$public_key = "public_w50/3waN1vN9TNAg1U1C/ahR6Ko=";
$your_private_key = "private_yMtf8/TQs6h+MVhMOSi+lyreJMU=";
$url_end_point = "https://" . $_SERVER['SERVER_NAME'];

$imageKit = new ImageKit(
    $public_key,
    $your_private_key,
    $url_end_point
);

if (isset($_POST["design_submit"])) {

    $target_dir = "uploads/";
    $design_file = $target_dir . basename($_FILES["design_file"]["name"]);
    $estimation_file = $target_dir . basename($_FILES["estimation_file"]["name"]);
    $design_note = $_POST['design_note'];
    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $design_check = $_FILES["design_file"]["tmp_name"];
    $estimation_check = $_FILES["estimation_file"]["tmp_name"];
    if (!empty($design_check) && !empty($estimation_check)) {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $uploaddesign = $imageKit->uploadFile([
            "file" => "https://" . $_SERVER['SERVER_NAME'] . "/" . $design_file,
            "fileName" => "my_file_name.jpg"
        ]);
        unlink($design_file);
        $uploadestimations = $imageKit->uploadFile([
            "file" => "https://" . $_SERVER['SERVER_NAME'] . "/" . $estimation_file,
            "fileName" => "ssarc_file.jpg"
        ]);
        unlink($estimation_check);
        $uploadOk = 1;
        // echo ("Upload URL" . json_encode($uploadFile));
        $jsonData = (array) $uploadFile;
        $status_ar = (array) $jsonData['responseMetadata'];
        $raw_ar = (array) $status_ar['raw'];
        $status_code =  $status_ar['statusCode'];
        $file_name = $raw_ar['name'];
        if ($status_code  == 200) {
            echo "file uploaded to imagekit successfully";
            echo '<img src="https://ik.imagekit.io/wrnear2017/tr:n-ik_ml_thumbnail/' . $file_name . '" alt="">';
        } else {
            echo "image upload failed";
        }
    } else {
        $uploadOk = 0;
    }
}
