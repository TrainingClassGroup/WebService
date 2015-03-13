<?php

namespace app\models;

class CData_CatalogOfClassNameAndCourseAndTime extends CData {
    /*
     * (non-PHPdoc) @see \app\models\CData::getx()
     */
    protected static function getex( $paras = null ){
        $sql = 'SELECT cn."id" class_name_id, cc."id" course_id, cn.class_name,	cc.course
FROM tab_training_class_classname cn
LEFT JOIN (
	tab_training_class_relation_between_class_name_and_course nrc
	LEFT JOIN tab_training_class_course cc ON cc."id" = nrc.course_id
) ON cn."id" = nrc.class_name_id ORDER BY cn."id", cc."id"';
        
        $command = CDB::getConnection()->createCommand( $sql );
        $result = $command->queryAll();
        $data = [];
        
        $rownum = count( $result );
        for($r = 0; $r < $rownum; $r++){
            CTree::menuTree($data, '', ['id'=>$result[$r]['class_name_id'], 'menu'=>$result[$r]['class_name'], 'paras'=>'' ],
                                       ['id'=>$result[$r]['course_id'], 'menu'=>$result[$r]['course'], 'paras'=>'' ]);
        }
        
        return $data;
    }
    
    
}
