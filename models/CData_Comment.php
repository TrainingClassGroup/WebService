<?php

namespace app\models;

class CData_Comment extends CData {
    public static function description(){
        return [
                    'description' => '根据“培训班ID”查询评论。',
                    'paras' => [
                                    [
                                        'para' => 'company_id',
                                        'desc' => '培训班ID',
                                        'isnull' => false,
                                        'type' => 'numeric',
                                        'example' => '222' ],
                                    [
                                        'para' => 'rownum',
                                        'desc' => '行数',
                                        'isnull' => true,
                                        'type' => 'numeric',
                                        'example' => '10' ],
                                    [
                                        'para' => 'page',
                                        'desc' => '页数',
                                        'isnull' => true,
                                        'type' => 'numeric',
                                        'example' => '0' ] ]
               ];
    }
    /*
     * (non-PHPdoc) @see \app\models\CData::getx()
     */
    protected static function getex( $paras = null ){
        $key = __METHOD__ . ":" . serialize( $paras );
        $data = CSystemCache::get( $key );
        if( !is_null( $data ) ) return $data;
       
        $sql = "SELECT com.\"comment\", com.\"timestamp\", (case when usr.username IS NULL then usr.tel else usr.username end) username
        FROM tab_training_class_comment com, tab_training_class_user usr
        WHERE	com.company_id = :company_id
        AND com.user_id = usr.id
ORDER BY \"timestamp\" DESC
LIMIT :rownum OFFSET :page";
        
        if( !isset( $paras['rownum'] ) || is_null( $paras['rownum'] ) ) $paras['rownum'] = 10;
        if( !isset( $paras['page'] ) || is_null( $paras['page'] ) ) $paras['page'] = 0;
        
        $command = CDB::getConnection()->createCommand( $sql );
        $command->bindParam( ':company_id', $paras['company_id'], \PDO::PARAM_INT ); // 培训班ID
        $command->bindParam( ':rownum', $paras['rownum'], \PDO::PARAM_INT ); // 行数
        $command->bindParam( ':page', $paras['page'], \PDO::PARAM_INT ); // 页数
        
        $data = $command->queryAll();
        
        CSystemCache::set( $key, $data, 10 * 60 );
        
        return $data;
    }
}
