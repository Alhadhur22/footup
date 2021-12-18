<?php
/**
 * FOOTUP - 0.1.3 - 11.2021
 * *************************
 * Hard Coded by Faustfizz Yous
 * 
 * @package Footup/Config
 * @version 0.1
 * @author Faustfizz Yous <youssoufmbae2@gmail.com>
 */
namespace Footup\Config;

use Footup\Config\DotEnv\DotEnv;

class Config
{
    /**
     * @var array
     */
    public $page_error = [
        "1s"     =>  BASE_PATH."error/100.html",
        "2s"     =>  BASE_PATH."error/200.html",
        "3s"     =>  BASE_PATH."error/300.html",
        "4s"     =>  BASE_PATH."error/400.html",
        "404s"   =>  BASE_PATH."error/404.html",
        "5s"     =>  BASE_PATH."error/500.html",
    ];
    
    /**
     * @var array
     */
    protected $config = [
        // Configuration des dossiers
        /**
         * Dissier uploads pour les fichiers téléversés [relative to public dir]
         */
        "store_dir" => BASE_PATH."uploads/",
        /**
         * Dissier assets pour les fichiers statics css, js, img [relative to public dir]
         */
        "assets_dir" => BASE_PATH."assets/",
        /**
         * Dissier contenant les fichiers de vues de votre application
         */
        "view_path" => ROOT_PATH."app/View/",
        /**
         * Extension des vues
         */
        "view_ext" => ".php",
        /**
         * Nom du controlleur par défaut
         */
        "default_controller" => "Home",
        /**
         * Méthode par défaut
         */
        "default_method" => "index",

        /**
         * Environement de l'application
         * # possibles values: dev  || prod
         */
        "environment" => "dev",

        /**
         * Serveur de base de données
         */
        "db_host"   => "localhost",
        /**
         * Utilisateur de la base de données
         */
        "db_user"   => "root",
        /**
         * Mot de passe de la base de données
         */
        "db_pass"   => "123456",
        /**
         * Nom de la base de données
         */
        "db_name"   => "udc",
        /**
         * Port du serveur de la base de données
         */
        "db_port"   => "3306",
        /**
         * Nom de la base de données ( ça utilise pdo )
         * 'pdomysql', 'pdopgsql', 'pdosqlite'
         */
        "db_type"   => "pdomysql"
    ];

    public function __construct(?array $config = null, ?array $page_error = null)
    {
        $env = new DotEnv();
        if(!empty($config) || !empty($page_error) || isset($_ENV["config"]))
        {
            $this->config = array_merge($this->config, $config, $_ENV["config"]);
            $this->page_error = array_merge($this->page_error, $page_error);
        }
        
        if($this->config["environment"] === "prod")
        {
            error_reporting(0);
        }else{
            error_reporting(E_ALL);
        }
    }

    public function __set($name, $val)
    {
        $this->config[$name] = $val;
    }

    public function __get($name)
    {
        if(property_exists($this, $name))
        {
            return $this->{$name};
        }
        return $this->config[$name] ?? null;
    }

}
