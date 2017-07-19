<?php
$url = "http://twitter-great-rss.herokuapp.com/feed/search?q=amazarashi%20OR%20緑茶&rpp=200&url_id_hash=c78d6e2c4166c873d8c4a41012e6fc8a94c3c19c";
$xml = file_get_contents($url);
header("Content-type: application/xml; charset=UTF-8");
print $xml;
?>
