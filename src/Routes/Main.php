<?php

namespace pxgamer\wdTorr\Routes;

use pxgamer\Generic\Inclusions;
use pxgamer\wdTorr\helpers\Content;

/**
 * Class Main
 * @package pxgamer\wdTorr\Routes
 *
 * @property \System\Request request
 * @property \System\Route route
 */
class Main extends Inclusions
{
    public function index()
    {
        if (isset($this->request->body['refresh_cache_data'])) {
            Content::clearCache();
        }

        $Content = new Content();
        $posters = $Content->getPosters();

        $this->S->display(
            'index.tpl',
            [
                'posters' => $posters
            ]
        );
    }

    public function show($type, $id)
    {
        $Content = new Content();
        $meta = $Content->meta($type, $id);

        if (!$meta->id) {
            header('Location: /');
        }

        $title = (isset($meta->title) ? $meta->title : $meta->name);
        $year = (isset($meta->release_date) ? $this->absolute_time($meta->release_date, 'Y') : '');

        $this->S->display(
            'content/show.tpl',
            [
                'meta' => $meta,
                'type' => ($this->route->req->args[0] == 'movies' ? 'movie' : $this->route->req->args[0]),
                'torrents' => $Content->fetchTorrents($title, $year)
            ]
        );
    }
}
