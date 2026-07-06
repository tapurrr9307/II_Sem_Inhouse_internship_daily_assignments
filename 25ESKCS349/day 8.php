<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        <?php echo "this is my page main title"; ?>
    </h1>
    <p>this is my paragraph</p>
    <h2>
        <?php echo "this is my page sub title"; ?>
    </h2>
    <h3>
        <?php phpinfo(); ?>
    </h3>
    <?php
    $name = "third"; // corrected assignment operator
    echo "<p>hello, " . $name . "!</p>";
    ?>
    <?php
    $name ="Druvika Sharma";
    $college ="BTU";
    $branch ="Computer Science";
    ?>
    <h1>Hello, <?=$name ?></h1>
    <p><?=$college ?> | <?= $branch ?></p>
</body>
</html> 

