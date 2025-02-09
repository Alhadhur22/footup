<?php
/**
 * FOOTUP - 0.1.4 - 01.2022
 * *************************
 * Hard Coded by Faustfizz Yous
 * 
 * @package Footup
 * @version 0.1
 * @author Faustfizz Yous <youssoufmbae2@gmail.com>
 */
namespace Footup;

use App\Config\Config;
use Footup\Http\Request;
use Footup\Routing\Router;

// Directory Separator
defined("DS") or define("DS", DIRECTORY_SEPARATOR);

/**
 * Le dossier système
 */
defined('SYS_PATH') or define('SYS_PATH', realpath(__DIR__.DS).DS);

/**
 * Chargement des classes de configuration
 * =======================================
 * - config système
 * - config utilisateur
 */
include_once SYS_PATH.'Config/Config.php';
include_once CONFIG_PATH.'Config.php';

/**
 * Chargement des chargeurs de classes
 */
include_once SYS_PATH.'Config/Autoload.php';
include_once CONFIG_PATH.'Autoload.php';

/**
 * Démarrer le chargeur de classes
 */
(new \App\Config\Autoload())->register();

/**
 * Initialise la classe de configuration
 */
$config = new Config();

/**
 * Création de quelques constantes importantes
 * ==========================================
 * - le chemin vers le dossier (app)
 * - chemin vers le dossier des vues (app/view)
 * - chemin vers le dossier de téléversement
 */
defined('VIEW_PATH') or define('VIEW_PATH', realpath($config->view_path).DS);
defined('STORE_DIR') or define('STORE_DIR', realpath($config->store_dir).DS);
defined('ASSETS_DIR') or define('ASSETS_DIR', realpath($config->assets_dir).DS);

/**
 * Insertion des routeurs définies par l'utilisateur
 */
include_once CONFIG_PATH.'Routes.php';

/**
 * Recupère l'objet variable $router
 */
$Router = ($router ?? (new Router(new Request()))->setAutoRoute(true));

/**
 * Chargement des function globales
 */
if(file_exists(APP_PATH.'Functions.php'))
{
    include_once APP_PATH.'Functions.php';
}
include_once SYS_PATH.'Functions.php';

/**
 * Démarrage de Footup Framework
 */
(new Footup($Router))->terminate();