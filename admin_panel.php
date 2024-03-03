<?php
session_start();

// Check if the user logged in via admin.php
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: index.html");
    exit();
}

// Check if a contact form submission deletion is requested
if (isset($_GET['delete_contact'])) {
    $indexToDelete = $_GET['delete_contact'];

    // Check if the index exists in the contact_submissions array
    if (isset($_SESSION['contact_submissions'][$indexToDelete])) {
        // Remove the contact form submission at the specified index
        unset($_SESSION['contact_submissions'][$indexToDelete]);

        // Reindex the array to ensure correct numbering
        $_SESSION['contact_submissions'] = array_values($_SESSION['contact_submissions']);
    }
}

// Handle blog creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["blog_title"], $_POST["blog_content"])) {
    // Get the blog data
    $blogTitle = $_POST["blog_title"];
    $blogContent = $_POST["blog_content"];

    // Prepare the blog data
    $blogData = "Title: $blogTitle\nContent: $blogContent\n\n";

    // Store the blog data in a session variable
    $_SESSION['blog_content'][] = $blogData;

    echo "<h2 style='color: #61dafb;'>Blog Creation Successful</h2>";
}

// Handle blog deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_blog_submit"])) {
    $indexToDelete = $_POST["delete_blog"];

    // Check if the index exists in the blog_content array
    if (isset($_SESSION['blog_content'][$indexToDelete])) {
        // Remove the blog at the specified index
        unset($_SESSION['blog_content'][$indexToDelete]);

        // Reindex the array to ensure correct numbering
        $_SESSION['blog_content'] = array_values($_SESSION['blog_content']);
    }
}

// Display existing blogs
echo "<h2 style='text-align: right; margin-top: 0; color: #61dafb;'>Existing Blogs</h2>";

if (isset($_SESSION['blog_content'])) {
    echo "<div style='text-align: right;'>";
    foreach ($_SESSION['blog_content'] as $index => $blog) {
        echo "<pre>$blog <a href='admin_panel.php?delete_blog=$index'>Delete</a></pre>";
    }
    echo "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #000;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #61dafb;
        }

        /* Container styles for the blog forms and contact form */
        .forms-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 80%; /* Adjust as needed */
        }

        /* Individual form styles */
        form {
            margin: 5px;
            padding: 10px;
            border-radius: 10px;
            width: 100%; /* Adjust as needed */
            height: 100px; /* Make the forms square */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label, input, textarea, button, select {
            display: block;
            margin-bottom: 5px;
            outline: none;
        }

        input, textarea, select {
            width: 150px; /* Increase the width of the text boxes */
            padding: 8px; /* Increase the padding for better visibility */
            border: none;
            border-radius: 3px;
        }

        button, select {
            background-color: #000;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
            border: 1px solid #fff;
            font-size: 12px;
            width: 150px; /* Increase the width of the buttons */
            outline: none;
        }

        button:hover, select:hover {
            background: linear-gradient(to bottom, #8e6dff, #5c3ba8);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="forms-container">
        <form action='admin_panel.php' method='post'>
            <input type='text' name='blog_title' placeholder='Blog Title' required>
            <textarea name='blog_content' placeholder='Blog Content' rows='2' required></textarea>
            <button type='submit' name='create_blog'>Create</button>
        </form>

        <form action='admin_panel.php' method='post'>
            <select name='delete_blog'>
                <?php
                $blogArray = isset($_SESSION['blog_content']) ? $_SESSION['blog_content'] : [];
                foreach ($blogArray as $index => $blog) {
                    if (!empty($blog)) {
                        echo "<option value='$index'>$blog</option>";
                    }
                }
                ?>
            </select>
            <button type='submit' name='delete_blog_submit'>Delete</button>
        </form>
    </div>
</body>
</html>

