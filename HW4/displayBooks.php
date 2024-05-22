<?php
function displayBooks() {
    if (!empty($_SESSION['books'])) {
        echo "<table border='1'>";
        echo "<tr><th>Title</th><th>Author</th><th>Year Published</th></tr>";
        
        foreach ($_SESSION['books'] as $book) {
            echo "<tr>";
            echo "<td>" . $book['title'] . "</td>";
            echo "<td>" . $book['author'] . "</td>";
            echo "<td>" . $book['year'] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
}
?>
