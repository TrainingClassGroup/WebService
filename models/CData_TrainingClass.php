<?php

namespace app\models;

class CData_TrainingClass extends CData {
    public static function description(){
        return [
                    'description' => '根据“年纪”和“课程”查询培训班，并按照举例排序。',
                    'paras' => [
                                    [
                                        'para' => 'lng',
                                        'desc' => '经度',
                                        'isnull' => false,
                                        'type' => 'numeric',
                                        'example' => '123.417095' ],
                                    [
                                        'para' => 'lat',
                                        'desc' => '纬度',
                                        'isnull' => false,
                                        'type' => 'numeric',
                                        'example' => '41.836929' ],
                                    [
                                        'para' => 'catalog',
                                        'desc' => '年级',
                                        'isnull' => false,
                                        'type' => 'string',
                                        'example' => '"高中"' ],
                                    [
                                        'para' => 'curriculum',
                                        'desc' => '课程',
                                        'isnull' => false,
                                        'type' => 'string',
                                        'example' => '"数学"' ],
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
        $key = __METHOD__ . ":" . serialize( [
                                                    'lng' => $paras['lng'],
                                                    'lat' => $paras['lat'],
                                                    'catalog' => $paras['catalog'],
                                                    'curriculum' => $paras['curriculum'] ] );
        $data = CSystemCache::get( $key );
        if( !is_null( $data ) ) return $data;

        $sql = "SELECT *
FROM
	(
		SELECT cdb.id, cdb.company, cdb.url_home, cdb.contact, replace(substr(cdb.text, 1, 160),'\"','')||'...' as \"text\", cdb.catalog, cdb.taught, cdb.curriculum,
        	   cdb.tel, cdb.address, cdb.coordinate, fun_distance (:lng, :lat, cdb.coordinate[0], cdb.coordinate[1]) distance,
        	   cdb.logo_image
		FROM tab_training_class_db cdb
		WHERE
			catalog ~ ('.*' || :catalog || '.*')
		AND curriculum ~ ('.*' || :curriculum || '.*')
	) cc
ORDER BY cc.distance
LIMIT :rownum OFFSET :page";

        if( !isset( $paras['rownum'] ) || is_null( $paras['rownum'] ) ) $paras['rownum'] = 10;
        if( !isset( $paras['page'] ) || is_null( $paras['page'] ) ) $paras['page'] = 0;

        $command = CDB::getConnection()->createCommand( $sql );
        $command->bindParam( ':lng', $paras['lng'], \PDO::PARAM_STR ); // 经度
        $command->bindParam( ':lat', $paras['lat'], \PDO::PARAM_STR ); // 纬度
        $command->bindParam( ':catalog', $paras['catalog'], \PDO::PARAM_STR ); // 年级
        $command->bindParam( ':curriculum', $paras['curriculum'], \PDO::PARAM_STR ); // 课程
        $command->bindParam( ':rownum', $paras['rownum'], \PDO::PARAM_INT ); // 行数
        $command->bindParam( ':page', $paras['page'], \PDO::PARAM_INT ); // 页数

        $data = $command->queryAll();

        $len=count($data);
        for($i=0;$i<$len;$i++){
        	$data[$i]['index'] = $paras['page'] * $paras['rownum'] + $i;
        }

        CSystemCache::set( $key, $data, 10 * 60 );

        return $data;
    }
}
