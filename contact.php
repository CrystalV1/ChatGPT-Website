<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"], $_POST["email"], $_POST["message"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Prepare the contact form data
    $contactFormData = "Name: $name\nEmail: $email\nMessage: $message\n\n";

    // Store the contact form data in a session variable
    $_SESSION['contact_submissions'][] = $contactFormData;

    echo "<h2>Contact Form Submission Successful</h2>";
} else {
    // No form submission
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap">
    <style>
        body {
            background-color: #000;
            margin: 0;
            font-family: 'Roboto', sans-serif; /* Added the Roboto font */
        }

        .container {
            color: #fff;
            text-align: center;
            background: #000;
            padding: 20px;
            margin: 10px auto;
            border-radius: 10px;
            width: 60%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container input,
        .container textarea {
            width: 80%;
            padding: 8px;
            margin-bottom: 10px;
            border: none;
            border-radius: 3px;
            text-align: center;
        }

        .container button {
            background: #000;
            color: #fff;
            cursor: pointer;
            transition: background 1s, transform 0.3s;
            font-size: 12px;
            width: 80%;
            outline: none;
            border: none;
            border-radius: 5px;
            padding: 8px;
        }

        .container button:hover {
            background: linear-gradient(to bottom, #8e6dff, #5c3ba8);
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

    <h2 class="container" style="font-family: 'Roboto', sans-serif;">Contact Form</h2>
    <form action="contact.php" method="post" class="container">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="message" placeholder="Message" rows="4" required></textarea>
        <button type="submit">Submit</button>
    </form>

</body>
</html>

<?php
}
?>

