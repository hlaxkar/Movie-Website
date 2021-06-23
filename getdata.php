<?php

function createurl($base, $movieDID = '550')
{
  $API_KEY = 'api_key=7432355f4f5f5ce12ec85408a877ac57&';
  $API_URL = 'https://api.themoviedb.org/3';
  $urls = array(
    'movie' => '/movie/' . $movieDID . '?',
    'similar' => '/movie/' . $movieDID . '/recommendations?',
    'popular' => '/discover/movie?sort_by=popularity.desc&'

  );

  $url =  $API_URL . $urls[$base] . $API_KEY . "append_to_response=images,credits";
  return $url;
}


?>
