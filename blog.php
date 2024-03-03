<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Roboto', sans-serif; /* Added a modern font (Roboto) */
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
            margin-bottom: 20px;
        }

        /* Individual blog display styles */
        .blog-display {
            margin: 20px 0; /* Add vertical margin to space out the entries */
            padding: 15px;
            border: 1px solid #fff;
            border-radius: 10px;
            width: 80%; /* Adjust as needed */
            opacity: 0; /* Initially hidden for fade-in effect */
            animation: fadeIn 2s forwards; /* Animation for fade-in effect */
            text-align: left; /* Align text to the left */
            box-sizing: border-box; /* Include padding and border in element's total width and height */
            max-width: 600px; /* Set a maximum width for better readability */
            line-height: 1.5; /* Set line height for better readability */
        }

        .blog-title {
            font-size: 24px; /* Large font size for the title */
            font-weight: bold; /* Make the title bold */
            margin-bottom: 10px; /* Add margin below the title */
        }

        .blog-content {
            font-size: 20px; /* Adjust as needed for content font size */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <h2>Blog Entries</h2>

    <?php
    if (isset($_SESSION['blog_content'])) {
        foreach ($_SESSION['blog_content'] as $blog) {
            // Display title and content separately with their own styles
            echo "<div class='blog-display'>";
            
            // Separate title and content
            list($title, $content) = explode("\n", $blog, 2);

            // Display title
            echo "<div class='blog-title'>$title</div>";

            // Display content
            echo "<div class='blog-content'>$content</div>";

            echo "</div>";
        }
    }
    ?>
</body>
</html>

