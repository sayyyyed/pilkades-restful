<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file was uploaded without errors
    if (isset($_FILES['file_input']) && $_FILES['file_input']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'img/';
        $uploadedFile = $uploadDir . basename($_FILES['file_input']['name']);

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES['file_input']['tmp_name'], $uploadedFile)) {
            // File uploaded successfully
            echo json_encode(['status' => 'success', 'message' => 'File uploaded successfully.']);
        } else {
            // Error moving the file
            echo json_encode(['status' => 'error', 'message' => 'Error moving the file.']);
        }
    } else {
        // File upload error
        echo json_encode(['status' => 'error', 'message' => 'File upload error.']);
    }
} else {
    // Invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
