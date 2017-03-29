<?php

namespace pxgamer\wdTorr\helpers;

use pxgamer\Generic\Inclusions;

/**
 * Class Content
 * @package pxgamer\wdTorr\helpers
 */
class Content extends Inclusions
{
    private $tmdb_api_key;
    private $default_torrent_site;

    private $base_url = 'https://api.themoviedb.org/3';
    private $default_language = 'en-GB';
    private $end_url = '';

    /**
     * Content constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->default_torrent_site = $this->SL3->querySingle('SELECT default_torrent_site FROM settings');
        $this->tmdb_api_key = $this->SL3->querySingle('SELECT tmdb_api_key FROM settings');
        $this->end_url = '?api_key=' . $this->tmdb_api_key . '&language=' . $this->default_language;
    }

    public static function clearCache()
    {
        if (is_dir(CACHE_PATH)) {
            $dir = new \DirectoryIterator(CACHE_PATH);
            foreach ($dir as $file) {
                if ($file->valid() && $file->getExtension() == 'json') {
                    unlink(CACHE_PATH . $dir);
                }
            }
        }
    }

    /**
     * @param string $title
     * @return array
     */
    public function fetchTorrents($title, $year = '')
    {
        if (class_exists('\\pxgamer\\TorrentParser\\' . $this->default_torrent_site)) {
            return ('\\pxgamer\\TorrentParser\\' . $this->default_torrent_site)::search($title . ' ' . $year);
        } else {
            return [];
        }
    }

    /**
     * @param $url
     * @return bool|mixed
     */
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

    /**
     * @param array $selected
     * @return string
     */
    public function getPosters($selected = ['movies', 'tv'])
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

    /**
     * @param string $type
     * @param int $id
     * @return object|boolean
     */
    public function meta($type, $id)
    {
        if ($type == 'movies') {
            $type = 'movie';
        }

        $url = $this->base_url . '/' . $type . '/' . $id . $this->end_url;

        $cache_file = CACHE_PATH . $type . '-' . $id . '-cache.json';

        if (!file_exists($cache_file) || filemtime($cache_file) < (time() - 604800)) {
            $response = self::get($url);
            if ($response == '') {
                $response = '{}';
            }

            file_put_contents($cache_file, $response);
            $response = json_decode($response);
        } else {
            $response = json_decode(file_get_contents($cache_file));
        }

        if (isset($response->title)) {
            return $response;
        } elseif (isset($response->name)) {
            return $response;
        } else {
            return false;
        }
    }

    /**
     * @param null|string $type
     * @return array
     */
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

        $cache_file = CACHE_PATH . $type . '-cache.json';

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
}
