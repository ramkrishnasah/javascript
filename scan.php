<?php
$uploadDir = 'uploads/';
$phonesDir = 'phones/';

// Make sure the folders exist
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (isset($_FILES['phone_image'])) {
    $uploadedFile = $uploadDir . basename($_FILES['phone_image']['name']);

    if (move_uploaded_file($_FILES['phone_image']['tmp_name'], $uploadedFile)) {
        $uploadedHash = md5_file($uploadedFile);
        $matchFound = false;

        // Check for exact match with known phones
        foreach (glob($phonesDir . "*.{jpg,jpeg,png}", GLOB_BRACE) as $knownPhone) {
            if (md5_file($knownPhone) === $uploadedHash) {
                $matchFound = true;
                break;
            }
        }

        echo "<div style='
            font-family: Arial;
            text-align: center;
            padding: 50px;
            font-size: 24px;
            background: #f9f9f9;
            margin: 100px auto;
            width: 60%;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        '>";

        if ($matchFound) {
            echo "✅ Phone is <strong>available</strong> in store";
        } else {
            echo "❌ Phone is <strong>not available</strong> in store";
        }

        echo "</div>";

        // Optional: Delete uploaded file after check
        unlink($uploadedFile);
    } else {
        echo "❌ Error uploading the file.";
    }
} else {
    echo "❌ No file uploaded.";
}
?>
