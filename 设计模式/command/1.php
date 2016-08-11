<?php
abstract class Command {
    abstract function execute( CommandContext $context );
}


class LoginCommand extends Command {
    function execute( CommandContext $context ) {
        $manager = Registry::getAccessManager();
        $user = $context->get( 'username' );
        $pass = $context->get( 'pass' );
        $user_obj = $manager->login( $user, $pass );
        if ( is_null( $user_obj ) ) {
            $context->setError( $manager->getError() );
            return false;
        }
        $context->addParam( "user", $user_obj );
        return true;
    }
}

class CommandContext {
    private $params = array();
    private $error = "";
    function __construct() {
        $this->params = $_REQUEST;
    }
    function addParam( $key, $val ) {
        $this->params[$key]=$val;
    }
    function get( $key ) {
        if ( isset( $this->params[$key] ) ) {
            return $this->params[$key];
        }
        return null;
    }
    function setError( $error ) {
        $this->error = $error;
    }
    function getError() {
        return $this->error;
    }
}


class CommandNotFoundException extends Exception {}

class CommandFactory {
    private static $dir = 'commands';
    static function getCommand( $action='Default' ) {
        if ( preg_match( '/\W/', $action ) ) {
            throw new Exception("illegal characters in action");
        }
        $class = UCFirst(strtolower($action))."Command";
        $file = self::$dir.DIRECTORY_SEPARATOR."{$class}.php";
        if ( ! file_exists( $file ) ) {
            throw new CommandNotFoundException( "could not find '$file'" );
        }
        require_once( $file );
        if ( ! class_exists( $class ) ) {
            throw new CommandNotFoundException( "no '$class' class located" );
        }
        $cmd = new $class();
        return $cmd;
    }
}


class Controller {
    private $context;
    function __construct() {
        $this->context = new CommandContext();
    }
    function getContext() {
        return $this->context;
    }
    function process() {
        $action = $this->context->get('action');
        $action = ( is_null( $action ) ) ? "default" : $action;
        $cmd = CommandFactory::getCommand( $action );
        if ( ! $cmd->execute( $this->context ) ) {
            // handle failure
        } else {
            // success
            // dispatch view now..
        }
    }
}

$controller = new Controller();
// fake user request
$context = $controller->getContext();
$context->addParam('action', 'login' );
$context->addParam('username', 'bob' );
$context->addParam('pass', 'tiddles' );
$controller->process();



// another command:
class FeedbackCommand extends Command {
    function execute( CommandContext $context ) {
        $msgSystem = Registry::getMessageSystem();
        $email = $context->get( 'email' );
        $msg = $context->get( 'msg' );
        $topic = $context->get( 'topic' );
        $result = $msgSystem->send( $email, $msg, $topic );
        if ( ! $result ) {
            $context->setError( $msgSystem->getError() );
            return false;
        }
        return true;
    }
}
