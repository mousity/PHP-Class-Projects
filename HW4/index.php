<html>
    <head>
    <!-- Including other PHP file just for displaying books -->
    <?php
        include 'displayBooks.php';
    ?>
    </head>

    <body>

    
    <form class="" action="" method="post">
        <div>
            <h3>Book Information</h3>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author">

            <label for="year">Year:</label>
            <input type="text" id="year" name="year" maxlength="4" size="4">
        </div>

        <input type="submit" value="Submit" name="submit">
    </form>

    <form method="post" action="">
        <button type="submit" name="refresh">Refresh data!</button>
    </form>

    <?php     
    // Session starting
    session_start();

    // Setting data for a session
    if (!isset($_SESSION['books'])) {
        $_SESSION['books'] = [];
    }

    // If the refresh button is pressed, destroy session and refresh page
    if (isset($_POST['refresh'])) {
        session_destroy(); 
        unset($_SESSION['books']);
        header("Refresh:0");
    }
    
    // array to hold errors
    $errors = [];
    
    // If the method is post, go directly to validation conditions
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit'])) {
        $title = trim($_POST['title']);
        $author = trim($_POST['author']);
        $year = trim($_POST['year']);
        
        // Validations
        if (empty($title)) {
            $errors[] = "Title is required! Cannot be empty";
        }
        
        if (empty($author)) {
            $errors[] = "Author is required! Cannot be empty";
        }
        
        if (!is_numeric($year) || strlen($year) != 4) {
            $errors[] = "Please enter a valid year.";
        }
        
        if (count($errors) == 0) {
            $_SESSION['books'][] = ['title' => $title, 'author' => $author, 'year' => $year];
        }
        }
    }

    // Print out errors as they show up
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
    // Display all books
    displayBooks();
    ?>


    </body>






</html>