<?php

namespace app\models;

class CData_Image extends CData {
    public static function description(){
        return [
                    'description' => '根据“ID”查询图片。',
                    'paras' => [
                                    [
                                        'para' => 'id',
                                        'desc' => '图片ID,可以是逗号串，查询多个图片',
                                        'isnull' => false,
                                        'type' => 'numeric',
                                        'example' => '\'1,2\'' ],
                                     [
                                        'para' => 'isthumbnail',
                                        'desc' => '是否是缩略图，1/0',
                                        'isnull' => false,
                                        'type' => 'numeric',
                                        'example' => '0' ]  ]
               ];
    }
    /*
     * (non-PHPdoc) @see \app\models\CData::getx()
     */
    protected static function getex( $paras = null ){
        $key = __METHOD__ . ":" . serialize( $paras );
        $data = CSystemCache::get( $key );
        if( !is_null( $data ) ) return $data;

        $sql="";
        if($paras['isthumbnail']=='0' || $paras['isthumbnail']==0){
        	$sql = "SELECT id,imagetype, imagedata, imageurl FROM tab_training_class_image WHERE id in (".$paras['id'].")";
        }
        else{
        	$sql = "SELECT id,imagetype, imagedata, imageurl FROM tab_training_class_image_thumbnail WHERE id in (".$paras['id'].")";
        }

        $command = CDB::getConnection()->createCommand( $sql );
        //$command->bindParam( ':id', $paras['id'], \PDO::PARAM_STR ); // 图片ID

        $result = $command->queryAll();

        $data=[];
        $len=count($result);
        for($i=0;$i<$len;$i++){
        	$data[$result[$i]['id']] = ['imagetype'=>$result[$i]['imagetype'], 'imagedata'=>$result[$i]['imagedata'], 'imageurl'=>$result[$i]['imageurl'] ];
        }

        CSystemCache::set( $key, $data, 10 * 60 );

        return $data;
    }
}
