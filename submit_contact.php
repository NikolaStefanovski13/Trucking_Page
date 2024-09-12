<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "contact_form_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$phone = $_POST['phone']; 
$email = $_POST['email'];

if(isset($_POST['company_business_id']) && !empty($_POST['company_business_id'])) {
    $company_business_id = $_POST['company_business_id'];
} else {
    $company_business_id = ""; 
}

$stmt = $conn->prepare("INSERT INTO contacts (name, phone, email, company_business_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $phone, $email, $company_business_id);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
