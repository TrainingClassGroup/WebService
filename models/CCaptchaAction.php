<?php

namespace app\models;

use yii\captcha\CaptchaAction;

class CCaptchaAction extends CaptchaAction {
    const SESSION_VAR_PREFIX = 'Ext.CCaptchaAction.';
    public $minLength = 4;
    public $maxLength = 4;
    protected function generateVerifyCode(){
        if( $this->minLength < 3 )
            $this->minLength = 3;
        if( $this->maxLength > 20 )
            $this->maxLength = 20;
        if( $this->minLength > $this->maxLength )
            $this->maxLength = $this->minLength;
        $length = rand( $this->minLength, $this->maxLength );
        
        $letters = '1234567890';
        $code = '';
        for($i = 0; $i < $length; ++$i){
            $code .= $letters[rand( 0, strlen( $letters ) - 1 )];
        }
        
        return $code;
    }
}

?>