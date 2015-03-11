<?php

namespace app\models;

class CScreenLock {
    public static function getTimeout(){
        $timeout = isset( \Yii::$app->params['screen-lock-timeout'] ) ? \Yii::$app->params['screen-lock-timeout'] : (60 * 10);
        if( $timeout < 5 )
            $timeout = 5;
        
        return $timeout;
    }
    public static function getTimeoutDelay(){
        $delay = isset( \Yii::$app->params['screen-lock-timeout-delay'] ) ? \Yii::$app->params['screen-lock-timeout-delay'] : 0;
        if( $delay < 0 )
            $delay = 0;
        
        return $delay;
    }
}

?>