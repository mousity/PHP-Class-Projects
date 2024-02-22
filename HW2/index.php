<html>
<body>

<!-- Variables! -->
<?php
    $name = "Samr";
    $credits = 17;
    $random_num = 5.8;
?>

<table>
    <tr>
        <th>Type</th>
        <th>Value</th>
    </tr>
    <tr>
        <td><?php echo gettype($name); ?></td>
        <td><?php echo $name; ?></td>
    </tr>
    <tr>
        <td><?php echo gettype($credits); ?></td>
        <td><?php echo $credits; ?></td>
    </tr>
    <tr>
        <td><?php echo gettype($random_num); ?></td>
        <td><?php echo $random_num; ?></td>
    </tr>
</table>

<h1>
    <?php
        echo "Hello $name!"    
    ?>
</h1>
<p>
    <?php
    $temp = "";
    if($credits >= 12){
        $temp = "FULL TIME STUDENT";
    } else {
        $temp = "PART TIME STUDENT";
    }
    echo "Looks like you're a $temp!"
    ?>
    </p>

<?php
    echo "<h2>FILE NAME:</h2> ";
    echo "<p>{$_SERVER['PHP_SELF']}</p>";
    echo "<h2>SERVER SOFTWARE:</h2> ";
    echo "<p>{$_SERVER['SERVER_SOFTWARE']}</p>";
    echo "<h2>HOST IP ADDRESS:</h2> ";
    echo "<p>{$_SERVER['SERVER_ADDR']}</p>";
    echo "<h2>NAME OF BROWSER:</h2> ";
    echo "<p>{$_SERVER['HTTP_USER_AGENT']}</p>";
?>
</body>
</html>