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
                                        'example' => '"3q454756ue"' ] ]
               ];
    }
    /*
     * (non-PHPdoc) @see \app\models\CData::getx()
     */
    protected static function getex( $paras = null ){
       // $key = __METHOD__ . ":" . serialize( $paras );
       // $data = CSystemCache::get( $key );
       // if( !is_null( $data ) ) return $data;

        $sql = "SELECT id, username, tel, weixin FROM tab_training_class_user WHERE uuid=:uuid";
        $command = CDB::getConnection()->createCommand( $sql );
        $command->bindParam( ':uuid', $paras['uuid'], \PDO::PARAM_STR ); // 用户UUID
        $data = $command->queryAll();
        $data[0]['like']=[];
//
        $sql = "SELECT company_id FROM tab_training_class_like WHERE user_id=:user_id";
        $command = CDB::getConnection()->createCommand( $sql );
        $command->bindParam( ':user_id', $data[0]['id'], \PDO::PARAM_INT );
        $rows = $command->queryAll();
        for($r=0;$r<count($rows);$r++){
        	$data[0]['like'][] = $rows[$r]['company_id'];
        }
//
       // CSystemCache::set( $key, $data, 10 * 60 );

        return $data;
    }
}
