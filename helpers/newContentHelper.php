<?php

class newContentHelper
{
    private static $tmdb_api_key = '';

    private static $base_url = 'https://api.themoviedb.org/3';
    private static $default_language = 'en-GB';
    private static $end_url = '';
    private static $contentTypes = [
      'movie' => 'movie',
      'tv' => 'tv',
    ];
    private static $endpoints = [
      'popular' => 'popular',
    ];

    public function __construct()
    {
        self::$end_url = '?api_key='.self::$tmdb_api_key.'&language='.self::$default_language;
    }

    public function viewReplace($templateContent, $torrents)
    {
        $latestMovies = self::getLatestMovies();
        $lm = '';
        if (isset($latestMovies->results)) {
            $lm .= '
<div class="panel panel-default">
  <div class="panel-heading"><h4>Popular Movies</h4></div>
  <div class="panel-body">
  ';
            foreach ($latestMovies->results as $movie) {
                $lm .= '
              <img src="https://image.tmdb.org/t/p/w154/'.$movie->poster_path.'" alt="'.$movie->title.'" class="img-thumbnail">
            ';
            }
            $lm .= '</div>
      </div>';
        }

        return preg_replace('/\{\{newContentMovies\}\}/', $lm, $templateContent);
    }

    public static function getLatestMovies()
    {
        $url = self::$base_url.'/'.self::$contentTypes['movie'].'/'.self::$endpoints['popular'].self::$end_url;

        return json_decode(self::get($url));
    }

    private static function get($url)
    {
        $cu = curl_init();
        curl_setopt_array(
          $cu,
          [
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_RETURNTRANSFER => 1,
          ]
        );

        return curl_exec($cu);
    }
}
