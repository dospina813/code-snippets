// put the function in the wordpress themes functions.php file

// when you want to list it, run the get_discog() method with whatever page you want in it
// then loop through it like below, with whatever HTML you want.


/**
 * @Function get_discogs
 * pulls in an artists releases from discogs.com
 * !importat This is not synced up through oAuth, so images WILL NOT WORK
 * @param - page - int - the page you are on/
 */
function get_discogs($page = 1){
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, 'https://api.discogs.com/artists/29349/releases?page=' . $page);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  $data = json_decode($data, true);
  return $data;
  //echo"<pre>"; print_r($data); echo "</pre>";
}

$discog = get_discogs(4);
//echo "<pre>"; print_r($discog['releases']); echo "</pre>";

foreach($discog['releases'] as $release){
  echo $release['title'];
  echo "<br>";
  echo $release['year'];
  echo  "<hr>";
}