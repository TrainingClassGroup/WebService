<?php

namespace app\models;

class CData_ClassSchedule extends CData {
    /*
     * (non-PHPdoc) @see \app\models\CData::getx()
     */
    protected static function getex( $paras = null ){
        $key=__METHOD__.":".serialize($paras);
        $data = CSystemCache::get($key);
        if(!is_null($data)) return $data;
        
        $sql = "SELECT
	ct.id teacher_id,
	cs.course_id,
	cs.class_id,
	ct.teacher,
	ccn.class_name,
	cc.course,
	cs.week0,
	cs.week1,
	cs.week2,
	cs.week3,
	cs.week4,
	cs.week5,
	cs.week6
FROM
	tab_training_class_schedule cs,
	tab_training_class_teacher ct,
	tab_training_class_classname ccn,
	tab_training_class_course cc
WHERE cs.id = ct.schedule_id
AND ccn.id = cs.class_id
AND cc.id = cs.course_id
AND ct.company_id = :company_id
";

        $command = CDB::getConnection()->createCommand( $sql );
        $command->bindParam(':company_id',$paras['company_id'], \PDO::PARAM_STR); //公司ID
        
        $data = $command->queryAll();

        CSystemCache::set($key, $data, 10*60);
        
        return $data;
    }


}
