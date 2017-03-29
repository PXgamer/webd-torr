<?php

namespace pxgamer\wdTorr;

use System\App;
use System\Request;
use System\Route;

/**
 * Class Router.
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
        define('BASE_PATH', ROOT_PATH.DS.'public'.DS, true);
        define('SRC_PATH', ROOT_PATH.DS.'src'.DS, true);
        define('ROUTES', '\\pxgamer\\wdTorr\\Routes\\');

        define('PRIVATE_PATH', ROOT_PATH . '/private', true);
        define('SQL_LITE_DB_PATH', PRIVATE_PATH . '/db.sqlite', true);

        $app = App::instance();
        $app->request = Request::instance();
        $app->route = Route::instance($app->request);
        $route = $app->route;

        $route->any('/', [ROUTES.'Main', 'index']);
        $route->any('/torrents', function() {
            (new Routes\Torrents)->setVars($this->app)->index();
        });
        $route->any('/settings', function() {
            (new Routes\Settings)->setVars($this->app)->index();
        });
        $route->any('/*', function(){
			(new Routes\Generic)->error(404, 'Oops, page not found.');
		});

        $route->end();
    }
}
