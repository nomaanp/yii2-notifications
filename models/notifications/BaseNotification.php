<?php
namespace app\models\notifications;

abstract class BaseNotification {

    /**
     * @throw \Exception
     */
    public function notify(){
        throw new \Exception('Method notify is not implemented by class '.get_class($this));
    }

    /**
     * @return string
     */
    public static function getNamespace(){
        return __NAMESPACE__;
    }
}