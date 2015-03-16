<?php

namespace app\models;

class CData_TrainingClass extends CData {
    /*
     * (non-PHPdoc) @see \app\models\CData::getx()
     */
    protected static function getex( $paras = null ){
        $key=__METHOD__.":".serialize($paras);
        $data = CSystemCache::get($key);
        if(!is_null($data)) return $data;
        
        $sql = "SELECT *
FROM
	(
		SELECT company, url_home, contact, text, catalog, taught, curriculum, tel, address, coordinate, fun_distance (:lng, :lat, coordinate[0], coordinate[1]) distance
		FROM tab_training_class_db
		WHERE
			catalog ~ '.*高中.*'
		AND curriculum ~ '.*英语.*'
	) cc
ORDER BY cc.distance";

        $command = CDB::getConnection()->createCommand( $sql );
        $command->bindParam(':lng',$paras['lng'], \PDO::PARAM_STR);
        $command->bindParam(':lat',$paras['lat'], \PDO::PARAM_STR);
        
        $data = $command->queryAll();

        CSystemCache::set($key, $data, 10*60);
        
        return $data;
    }


}
