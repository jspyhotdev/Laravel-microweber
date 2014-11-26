<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/22/14
 * Time: 3:09 PM
 */

namespace Weber;

error_reporting(E_ALL);
ini_set('display_errors', 1);
//use Illuminate\Support\Facades\Config;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\ClassLoader;
use Illuminate\Filesystem\Filesystem;

use Illuminate\Http\Request;
use Illuminate\Config\FileLoader;
use  Artdevue\Fcache\Fcache;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Cache\Repository;


include_once(__DIR__ . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'bootstrap.php');

class LaravelServiceProvider extends ServiceProvider
{


    public function __construct($app)
    {



        ClassLoader::addDirectories(array(
            base_path() . '/userfiles/modules',
            __DIR__,
        ));
        ClassLoader::register();

        parent::__construct($app);
    }

    public function register()
    {

//        $this->app->bindIf('cssssonfig.loader', function($app){
//
//            return new Utils\FileLoader(new Filesystem, $app['path'].'/config');
//
//         }, true);

        $this->app->bind('config', function ($app) {
            return new Providers\SaveConfig($app->getConfigLoader(), $app->environment());
        });

        $this->app->singleton('event', function ($app) {
            return new Providers\Event($app);
        });

        $this->app->singleton('database', function ($app) {
            return new Providers\Database($app);
        });

        $this->app->singleton('format', function ($app) {
            return new Utils\Format($app);
        });

        $this->app->singleton('parser', function ($app) {
            return new Utils\Parser($app);
        });

        $this->app->extend('url', function ($app) {
            return new Utils\Url($app);
        });
        $this->app->singleton('ui', function ($app) {
            return new Providers\Ui($app);
        });
        $this->app->singleton('content_manager', function ($app) {
            return new Providers\ContentManager($app);
        });


        $this->app->singleton('update', function ($app) {
            return new Providers\UpdateManager($app);
        });
        $this->app->singleton('cache_manager', function ($app) {
            return new Providers\CacheManager($app);
        });
        $this->app->singleton('config_manager', function ($app) {
            return new Providers\ConfigurationManager($app);
        });

        $this->app->singleton('notifications_manager', function ($app) {
            return new Providers\NotificationsManager($app);
        });
        $this->app->singleton('option', function ($app) {
            return new Providers\Option($app);
        });

        $this->app->bind('template', function ($app) {
            return new Providers\Template($app);
        });
        $this->app->singleton('modules', function ($app) {
            return new Providers\Modules($app);
        });
        $this->app->singleton('category_manager', function ($app) {
            return new Providers\CategoryManager($app);
        });
        $this->app->singleton('user_manager', function ($app) {
            return new Providers\UserManager($app);
        });


//        $this->app->bind('module', function ($app) {
//            return new Models\Module($app);
//        });


//        $this->app->extend('db', function ($app) {
//            return new Db($app);
//        });


        Event::listen('illuminate.query', function ($sql, $bindings, $time) {
            echo $sql; // select * from my_table where id=?
            print_r($bindings); // Array ( [0] => 4 )
            echo $time; // 0.58

            // To get the full sql query with bindings inserted
            $sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
            $full_sql = vsprintf($sql, $bindings);
        });


        // $this->registerModules();
    }


    public function boot()
    {
        \Cache::extend('fcache', function ($app) {
            $store = new \Artdevue\Fcache\Fcache;
            return new \Illuminate\Cache\Repository($store);
        });

        parent::boot();
        $is_installed = Config::get('weber.is_installed');

        if (!$is_installed) {
            return;
        }
        $modules = load_all_functions_files_for_modules();



    }





//    protected function registerCache()
//    {
//        $this->app['mw.cache'] = $this->app->share(function ($app) {
//            return new Models\Cache($app);
//        });
//    }
//
//
//    protected function registerHtmlBuilder()
//    {
//        $this->app->bind('config', function($app)
//        {
//            return new SaveConfig($app->getConfigLoader(), $app->environment());
//        });
//    }
//
//    protected function registerFormBuilder()
//    {
//        $this->app['form'] = $this->app->share(function ($app) {
//            return new \admin\Controller();
//        });
//    }


} 