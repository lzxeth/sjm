<?php
// 一个独立的文件 Settings.php
class Settings {
    static $COMMSTYPE = 'Bloggs';
}

/*
 *单例模式和工厂模式
 */
//AppConfig.php
require_once( 'Settings.php' );
class AppConfig {
    private static $instance;
    private $commsManager;
    private function __construct() {
        // will run once only
        $this->init();
    }
    private function init() {
        switch ( Settings::$COMMSTYPE ) {
            case 'Mega':
                $this->commsManager = new MegaCommsManager();
                break;
            default:
                $this->commsManager = new BloggsCommsManager();
        }
    }

    public static function getInstance() {
        if ( empty( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getCommsManager() {
        return $this->commsManager;
    }
}
