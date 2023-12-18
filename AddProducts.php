<?php
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "studentuol";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $Name = $_POST['name'];
    $Category = $_POST['category'];
    $Price = $_POST['price'];
    $Discount = $_POST['discount'];
    $Size = $_POST['size'];
    $Code = $_POST['code'];
    $Details = $_POST['details'];

    $targetDir = "uploads/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check === false) {
        $error = "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 500000) {
        $error = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $error = "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], __DIR__ . '/' . $targetFile)) {
            $image = 'uploads/' . $fileName;

            $sql = "INSERT INTO products (Name, image, category, Price, Discount, Size, Code, Details) 
                    VALUES ('$Name', '$image', '$Category', '$Price', '$Discount', '$Size', '$Code', '$Details')";
            
            if ($conn->query($sql) === TRUE) {
                $success = "Product added successfully";
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            width: 50%;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="file"] {
            margin-bottom: 20px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 10px;
            padding: 8px;
            border-radius: 5px;
        }

        p.error {
            background-color: #f44336;
            color: white;
        }

        p.success {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Add Product</h2>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image" required><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category"><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <label for="discount">Discount:</label>
        <input type="number" id="discount" name="discount" step="0.01"><br>

        <label for="size">Size:</label>
        <input type="text" id="size" name="size"><br>

        <label for="code">Code:</label>
        <input type="text" id="code" name="code"><br>

        <label for="details">Details:</label>
        <textarea id="details" name="details"></textarea><br>

        <input type="submit" value="Add Product">
    </form>

    <?php
    if (!empty($error)) {
        echo "<p class='error'>Error: $error</p>";
    } elseif (!empty($success)) {
        echo "<p class='success'>$success</p>";
    }
    ?>
</body>
</html>
