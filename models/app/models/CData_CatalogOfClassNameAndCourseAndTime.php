<?php

namespace app\models;

class CData_CatalogOfClassNameAndCourseAndTime extends CData{
	/* (non-PHPdoc)
     * @see \app\models\CData::getx()
     */
    protected static function getx( $paras = null ){
        $sql='SELECT cn."id" class_name_id, cc."id" course_id, cn.class_name,	cc.course
FROM tab_training_class_classname cn
LEFT JOIN (
	tab_training_class_relation_between_class_name_and_course nrc
	LEFT JOIN tab_training_class_course cc ON cc."id" = nrc.course_id
) ON cn."id" = nrc.class_name_id';
        
        $command = CDB::getConnection()->createCommand($sql);
        $result = $command->queryAll();
        
        
    }
}

?>
