<?php
    require_once("connection.php");
    function generateShortURL($long_url)
    {
        $hashed_url = md5($long_url); 
        $short_url = substr($hashed_url, 0, 7); 
        return $short_url;
    }
    if (isset($_POST['submit'])) {
        $long_url = mysqli_real_escape_string($connect, $_POST['long_url']);
        $short_url = mysqli_real_escape_string($connect, $_POST['short_url']);
    if (empty($short_url)) {
        $short_url = generateShortURL($long_url);
    }
    $query = "INSERT INTO shortened_urls (short_url, long_url) VALUES ('$short_url', '$long_url');";
    mysqli_query($connect, $query);
    echo "<a href='$long_url'>http://<your_web_domain>/$short_url</a>";
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
    <h2 id="Judul">Xhortener</h2>
    </div>
    </div>
    <div>
    Xhorten your long url!
    </div>
    <div>
    <form method="POST">
        <label for="" id="label">Long URL</label>
        <input type="text" name="long_url" id="input" required>
        <label for="" id="label">Short URL</label>
        <input type="text" name="short_url" id="input" value="">
        <br>
        <input type="submit" name="submit" value="Generate">
    </form>
    </div>
</body>
</html>