<?php

function createurl($base, $movieDID = '550')
{
  $API_KEY = 'api_key=7432355f4f5f5ce12ec85408a877ac57&';
  $API_URL = 'https://api.themoviedb.org/3';
  $urls = array(
    'movie' => '/movie/' . $movieDID . '?',
    'similar' => '/movie/' . $movieDID . '/similar?',
    'popular' => '/discover/movie?sort_by=popularity.desc&',
    'nowplaying' => '/movie/now_playing?',
    'latest' => '/movie/top_rated?',
    'toprated' => '/movie/top_rated?'
  );
if ($base == 'movie'){
  $url =  $API_URL . $urls[$base] . $API_KEY ."append_to_response=images,credits";
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
