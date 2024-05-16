<?php
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $contents = file_get_contents($url);
    header("Content-Type: image/jpeg");
    echo $contents;
} else {
    echo "No URL provided.";
}
?>