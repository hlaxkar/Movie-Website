<?php
$imgbase = 'https://image.tmdb.org/t/p/';
function createurl($base, $movieDID = '550')
{
  $API_KEY = 'api_key=7432355f4f5f5ce12ec85408a877ac57&';
  $API_URL = 'https://api.themoviedb.org/3';
  $urls = array(
    'movie' => '/movie/' . $movieDID . '?',
    'similar' => '/movie/' . $movieDID . '/similar?&include_adult=false&',
    'popular' => '/discover/movie?sort_by=popularity.desc&page=2&',
    
    'animation' => '/discover/movie?language=en-US&sort_by=popularity.desc&include_adult=true&with_genres=16&page=3&',
    'action' => '/discover/movie?language=en-US&sort_by=popularity.desc&include_adult=true&with_genres=10751&page=2&',
    'drama' => '/discover/movie?language=en-US&sort_by=popularity.desc&include_adult=true&with_genres=53&page=4&',
    'nowplaying' => '/movie/now_playing?',
    'latest' => '/movie/top_rated?',
    'toprated' => '/movie/top_rated?',
    'search' => '/search/movie?'
  );
if ($base == 'movie'){
  $url =  $API_URL . $urls[$base] . $API_KEY ."append_to_response=images,credits";
return $url;
}
elseif($base == 'search'){
  $url =  $API_URL . $urls[$base] . $API_KEY .'&query='.$movieDID.'&include_adult=false';
  return $url;
}
else{
  $url =  $API_URL . $urls[$base] . $API_KEY ;
  return $url;
}}

function getData($base)
{
 
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $base,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache"
    ),
  ));

  $response = curl_exec($curl);
  //$err = curl_error($curl);

  curl_close($curl);

  $response = json_decode($response, true);
  return $response;
}
?>
