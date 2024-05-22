<?php
session_start();


$host = "localhost"; 
$username = "mouna"; 
$password = "samr5457"; 
$dbname = "mouna_"; 

error_reporting(E_ALL);
ini_set('display_errors', 1);


function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function test() {
    $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", 'test@example.com', 'testuser', password_hash('Test1234!', PASSWORD_DEFAULT));
$stmt->execute();

}
// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    debug_to_console("im in");
}

{/* if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}

code used to check connection, not needed right now
*/}


// Handling login, registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    
    if (isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("SELECT userid, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['userid'] = $row['userid'];
                session_write_close();
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid username or password.";
                var_dump($error);
            }
        } else {
            $error = "Invalid username or password.";
        }
    } elseif (isset($_POST['register'])) {
     
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        var_dump($email, $username, $password);
        $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = "Username already exists. Please choose a different username.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $username, $hashedPassword);
            if ($stmt->execute()) {
                $_SESSION['username'] = $username;
                $_SESSION['userid'] = $stmt->insert_id;
                header("Location: index.php");
            } else {
                $error = "Error: " . $stmt->error;
                
            }
        }
    } elseif (isset($_POST['create_post'])) {
   
        $title = $_POST['title'];
        $body = $_POST['body'];
        $userid = $_SESSION['userid'];
        $stmt = $conn->prepare("INSERT INTO posts (title, body, userid) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $title, $body, $userid);
        if ($stmt->execute()) {
            $message = "Post created successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Board</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav style="background-color: #f8f9fa; padding: 10px 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a href="index.php">Message Board</a>
            <div>
                <?php if(isset($_SESSION['userid'])): ?>
                    <a href="?logout">Logout</a>
                <?php else: ?>
                    <a href="?login">Login</a>
                    <a href="?register">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <?php
    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: index.php");
    }

    if (isset($_SESSION['userid'])) {
        // Dashboard
        echo "<h2>Welcome, " . htmlspecialchars($_SESSION['username']) . "</h2>";
        echo isset($message) ? $message : '';
        // Form 
        echo '<form action="index.php" method="post" class="postform">
                Title: <input type="text" name="title" required><br>
                Body: <textarea name="body" required></textarea><br>
                <button type="submit" name="create_post">Post</button>
              </form>';
        echo "<h3>Recent Posts</h3>";
        $stmt = $conn->prepare("SELECT p.title, p.body, p.created_at, u.username FROM posts p JOIN users u ON p.userid = u.userid ORDER BY p.created_at DESC LIMIT 5");
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<div class='postbox'><h4 class='title'>" . htmlspecialchars($row['title']) . "</h4>";
            echo "<p class='body'>" . nl2br(htmlspecialchars($row['body'])) . "</p>";
            echo "<p class='user'>Posted by " . htmlspecialchars($row['username']) . " on " . $row['created_at'] . "</p></div>";
        }
    } else {
        if (isset($_GET['register'])) {
            // Registration 
            echo "<h2>Register</h2>";
            echo isset($error) ? $error : '';
            echo '<form action="index.php" method="post">
                    Email: <input type="email" name="email" required><br>
                    Username: <input type="text" name="username" required><br>
                    Password: <input type="password" name="password" required><br>
                    <button type="submit" name="register">Register</button>
                </form>';
        } elseif (isset($_GET['login'])) {
            // Login
            echo "<h2>Login</h2>";
            echo isset($error) ? $error : '';
            echo '<form action="index.php" method="post">
                    Username: <input type="text" name="username" required><br>
                    Password: <input type="password" name="password" required><br>
                    <button type="submit" name="login">Login</button>
                </form>';
        }
    }
    ?>

</body>
</html>
