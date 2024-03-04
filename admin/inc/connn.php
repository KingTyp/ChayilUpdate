
<?php
require_once("../config.php");
require_once("../initialize.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle other form fields

    // Handle file upload for land image
    if (isset($_FILES['land_image']) && $_FILES['land_image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['land_image']['tmp_name'];
        $file_name = $_FILES['land_image']['name'];
        $upload_directory = '../admin/uploads/'; // Specify your upload directory
        $target_file = $upload_directory . basename($file_name);

        // Move uploaded file to specified directory
        if (move_uploaded_file($file_tmp_name, $target_file)) {
            // File uploaded successfully, now save its path or content to the database
             $land_image_path = $target_file;
        } else {
            // File upload failed
            echo "Failed to upload file.";
        }
    }

    // Handle other form fields

    // After processing, insert data into database
    // Example: $conn->query("INSERT INTO `Land` (...) VALUES (...)");
}
