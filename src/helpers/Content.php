<?php

namespace pxgamer\wdTorr\helpers;

use pxgamer\Generic\Inclusions;

class Content extends Inclusions
{
    private $tmdb_api_key = '';

    private $base_url = 'https://api.themoviedb.org/3';
    private $default_language = 'en-GB';
    private $end_url = '';

    /**
     * Content constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->tmdb_api_key = $this->SL3->querySingle('SELECT tmdb_api_key FROM settings');
        $this->end_url = '?api_key=' . $this->tmdb_api_key . '&language=' . $this->default_language;
    }

    public function getPosters($selected = ['movies', 'tv', 'games'])
    {
        $content = [];
        foreach ($selected as $value) {
            $content[$value] = $this->getLatest($value);
        }
        $response = '';

        foreach ($content as $key => $items) {
            $response .= $this->S->fetch(
                'content/posters.tpl',
                [
                    'title' => $key,
                    'items' => isset($items) ? $items : []
                ]
            );
        }

        return $response;
    }

    public function getLatest($type = null)
    {
        switch ($type) {
            case 'tv':
            case 'movies':
                if ($type == 'movies') {
                    $type = 'movie';
                }
                $url = $this->base_url . '/' . $type . '/popular' . $this->end_url;
                break;
            default:
                $url = null;
        }

        $cache_file = PRIVATE_PATH . $type . '-cache.json';

        if (!file_exists($cache_file) || filemtime($cache_file) < (time() - 10800)) {
            $response = self::get($url);
            if ($response == '') {
                $response = '{}';
            }

            file_put_contents($cache_file, $response);
            $response = json_decode($response);
        } else {
            $response = json_decode(file_get_contents($cache_file));
        }

        if (isset($response->results)) {
            return $response->results;
        } else {
            return [];
        }
    }

    private static function get($url)
    {
        if (!$url) {
            return false;
        }
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
