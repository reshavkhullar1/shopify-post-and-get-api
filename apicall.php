<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://484485bba58714f19d3352eb9584b86f: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@quick-start-105b2654.myshopify.com/admin/api/2023-04/products.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
$beauty =json_decode($response, true);
 //  echo"<pre>";
 // print_r($beauty);
 // echo"</pre>";


foreach ($beauty['products'] as $value) {
  echo $value['title'];
  echo"<br/>";
  foreach ($value['variants'] as $value1) {
   echo $value1['price'];
  echo"<br/>";

}   

foreach ($value['images'] as $value1) {
  ?><img src="<?php echo $value1['src'] ?>;" alt="Girl in a jacket" width="500" height="600"><?php
   // echo $value1['src'];
  echo"<br/>";

}
}




?>