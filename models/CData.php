<?php

namespace app\models;

class CData implements IData {

    public static function description(){
        return '';
    }

    protected static function getex( $paras = null ){
        return null;
    }

    public static function get( $paras = null ){
        if(is_array($paras)){
            if(isset($paras['type'])){
                if($paras['type']=='json'){
                	$data = static::getex($paras);
                	$result = json_encode((Object)$data, JSON_UNESCAPED_UNICODE);
                    return $result;
                }
                else if($paras['type']=='xml'){
                    $array2xml = new CArray2xml();
                    $array2xml->transform(static::getex($paras));
                    return $array2xml->getXML();
                }
                else{
                    return [];
                }
            }
        }
        return json_encode(static::getex($paras), JSON_UNESCAPED_UNICODE);

    }
}

