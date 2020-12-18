<?php 

echo "<pre>";
print_r($images = json_decode(file_get_contents("https://api.unsplash.com/search/photos?page=1&query=office&client_id=c706a76619628f3b52ba1c5953798189c1d50431290a256f5e0bf399e7628ce8"),true));
echo "</pre>";




echo $images["results"][0];
?>