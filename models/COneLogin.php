<?php

namespace app\models;

class COneLogin {
    public static function getRestrict(){
        if( isset( \Yii::$app->params['login-restrict'] ) ){
            return \Yii::$app->params['login-restrict'];
        }
        return 0;
    }
    public static function regist( $loginId, $para ){
        $onelogin = \Yii::$app->cache->get( "_ONE_LOGIN_" );
        if( !is_array( $onelogin ) )
            $onelogin = [];
        
        $uuid = CUUID::guid();
        $onelogin[$loginId] = [
                'uuid' => $uuid,'para' => $para 
        ];
        \Yii::$app->cache->set( "_ONE_LOGIN_", $onelogin );
        return $uuid;
    }
    public static function update( $loginId, $para ){
        $onelogin = \Yii::$app->cache->get( "_ONE_LOGIN_" );
        if( !is_array( $onelogin ) )
            return;
        
        $onelogin[$loginId]['para'] = $para;
        \Yii::$app->cache->set( "_ONE_LOGIN_", $onelogin );
    }
    public static function remove( $loginId ){
        if( COneLogin::has( $loginId ) ){
            $onelogin = \Yii::$app->cache->get( "_ONE_LOGIN_" );
            unset( $onelogin[$loginId] );
            \Yii::$app->cache->set( "_ONE_LOGIN_", $onelogin );
        }
    }
    public static function has( $loginId ){
        $onelogin = \Yii::$app->cache->get( "_ONE_LOGIN_" );
        if( !is_array( $onelogin ) )
            return false;
        
        return isset( $onelogin[$loginId] ) && $onelogin[$loginId] != null;
    }
    public static function get( $loginId ){
        $onelogin = \Yii::$app->cache->get( "_ONE_LOGIN_" );
        if( !is_array( $onelogin ) || !isset( $onelogin[$loginId] ) || is_null( $onelogin[$loginId] ) )
            return null;
        
        return $onelogin[$loginId];
    }
}

?>