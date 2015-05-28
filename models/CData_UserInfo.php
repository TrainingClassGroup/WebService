<?php

namespace app\models;

class CData_UserInfo extends CData {
    public static function description(){
        return [
                    'description' => '根据“用户UUID”查询用户信息。',
                    'paras' => [
                                    [
                                        'para' => 'uuid',
                                        'desc' => '用户ID',
                                        'isnull' => false,
                                        'type' => 'string',
                                        'example' => '3q454756ue' ] ]
               ];
    }
    /*
     * (non-PHPdoc) @see \app\models\CData::getx()
     */
    protected static function getex( $paras = null ){
        $key = __METHOD__ . ":" . serialize( $paras );
        $data = CSystemCache::get( $key );
        if( !is_null( $data ) ) return $data;

        $sql = "SELECT id, username, tel, weixin FROM tab_training_class_user WHERE uuid=:uuid";


        $command = CDB::getConnection()->createCommand( $sql );
        $command->bindParam( ':uuid', $paras['uuid'], \PDO::PARAM_STR ); // 用户UUID

        $data = $command->queryAll();

        CSystemCache::set( $key, $data, 10 * 60 );

        return $data;
    }
}
