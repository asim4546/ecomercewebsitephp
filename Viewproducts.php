<?php
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "studentuol";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $idToDelete = $_POST['delete'];

    $deleteSql = "DELETE FROM products WHERE id = $idToDelete";
    if ($conn->query($deleteSql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Size</th>
                    <th>Code</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>";
    
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td><img src='" . $row["image"] . "' alt='" . $row["Name"] . "' width='100px'></td>"; // Set width to 100px
            echo "<td>" . $row["category"] . "</td>";


            
            echo "<td>" . ($row["Price"] ? "$" . $row["Price"] : "") . "</td>";
            echo "<td>" . ($row["Discount"] ? "$" . $row["Discount"] : "") . "</td>";
            echo "<td>" . ($row["Size"] ? $row["Size"] : "") . "</td>";
            echo "<td>" . ($row["Code"] ? $row["Code"] : "") . "</td>";
            echo "<td>" . ($row["Details"] ? $row["Details"] : "") . "</td>";
            echo "<td><form method='post' action=''><button type='submit' name='delete' value='" . $row['id'] . "'>Delete</button></form></td>";
            echo "</tr>";
            
        }

        echo "</table>";
    } else {
        echo "No products found";
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>