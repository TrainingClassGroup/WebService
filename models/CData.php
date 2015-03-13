<?php

namespace app\models;

class CData implements IData {
    
    protected static function getex( $paras = null ){
        return null;
    }
    
    public static function get( $paras = null ){
        return json_encode(static::getex($paras), JSON_UNESCAPED_UNICODE);
    }
}

