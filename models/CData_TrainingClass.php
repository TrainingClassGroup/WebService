<?php

namespace app\models;

class CData_TrainingClass extends CData {
    /*
     * (non-PHPdoc) @see \app\models\CData::getx()
     */
    protected static function getex( $paras = null ){
        $key=__METHOD__.":".serialize(['lng'=>$paras['lng'], 'lat'=>$paras['lat'], 'catalog'=>$paras['catalog'], 'curriculum'=>$paras['curriculum'] ]);
        $data = CSystemCache::get($key);
        if(!is_null($data)) return $data;
        
        $sql = "SELECT *
FROM
	(
		SELECT id, company, url_home, contact, text, catalog, taught, curriculum, tel, address, coordinate, fun_distance (:lng, :lat, coordinate[0], coordinate[1]) distance
		FROM tab_training_class_db
		WHERE
			catalog ~ ('.*' || :catalog || '.*')
		AND curriculum ~ ('.*' || :curriculum || '.*')
	) cc
ORDER BY cc.distance
LIMIT :rownum OFFSET :page";
        
        if(!isset($paras['rownum']) || is_null($paras['rownum'])) $paras['rownum'] = 10;
        if(!isset($paras['page']) || is_null($paras['page'])) $paras['page'] = 0;
        
        $command = CDB::getConnection()->createCommand( $sql );
        $command->bindParam(':lng',$paras['lng'], \PDO::PARAM_STR); //经度
        $command->bindParam(':lat',$paras['lat'], \PDO::PARAM_STR); //纬度
        $command->bindParam(':catalog',$paras['catalog'], \PDO::PARAM_STR); //年级
        $command->bindParam(':curriculum',$paras['curriculum'], \PDO::PARAM_STR); //课程
        $command->bindParam(':rownum',$paras['rownum'], \PDO::PARAM_INT); //行数
        $command->bindParam(':page',$paras['page'], \PDO::PARAM_INT); //页数
        
        $data = $command->queryAll();

        CSystemCache::set($key, $data, 10*60);
        
        return $data;
    }


}
