<?php

namespace pxgamer\wdTorr;

use System\App;
use System\Request;
use System\Route;


/**
 * Class Router
 * @package pxgamer\wdTorr
 */
class Router
{
    /**
     * Router constructor.
     */
    public function __construct()
    {
        define('APP_NAME', 'webd-torr Client', true);

        if (!isset($_SERVER['HTTP_CONTENT_TYPE'])) {
            $_SERVER['HTTP_CONTENT_TYPE'] = '';
        }

        define('DS', DIRECTORY_SEPARATOR, true);
        define('ROOT_PATH', realpath('..'), true);
        define('BASE_PATH', ROOT_PATH . DS . 'public' . DS, true);
        define('SRC_PATH', ROOT_PATH . DS . 'src' . DS, true);
        define('PRIVATE_PATH', ROOT_PATH . DS . 'private' . DS, true);
        define('CACHE_PATH', PRIVATE_PATH . 'cache' . DS, true);

        if (!is_dir(CACHE_PATH)) {
            mkdir(CACHE_PATH);
        }

        define('SQL_LITE_DB_PATH', PRIVATE_PATH . 'db.sqlite', true);

        define('ROUTES', '\\pxgamer\\wdTorr\\Routes\\');


        $app = App::instance();
        $app->request = Request::instance();
        $app->route = Route::instance($app->request);
        $route = $app->route;

        $route->any('/', function () {
            (new Routes\Main)->setVars($this->app)->index();
        });
        $route->any('/torrents', function () {
            (new Routes\Torrents)->setVars($this->app)->index();
        });
        $route->any('/settings', function () {
            (new Routes\Settings)->setVars($this->app)->index();
        });
        $route->any('/show/?/?', function ($type, $id) {
            (new Routes\Main)->setVars($this->app)->show($type, $id);
        });
        $route->any('/*', function () {
            (new Routes\Generic)->error(404, 'Oops, page not found.');
        });

        $route->end();
    }
}
