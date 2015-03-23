<?php

namespace app\models;

class CData_ClassSchedule extends CData {
    public static function description(){
        return [
                'description' => '根据“培训班ID”、“年级”、“课程”和“时间”查询老师及其授课计划。',
                'paras' => [
                        [
                                'para' => 'company_id',
                                'desc' => '培训班ID',
                                'isnull' => false,
                                'type' => 'numeric',
                                'example' => '222' ],
                        [
                                'para' => 'class_id',
                                'desc' => '年级ID',
                                'isnull' => false,
                                'type' => 'numeric',
                                'example' => '6' ],
                        [
                                'para' => 'course_id',
                                'desc' => '课程ID',
                                'isnull' => false,
                                'type' => 'numeric',
                                'example' => '7' ],
                        [
                                'para' => 'schedule',
                                'desc' => '授课时间 (0:所有时段, 1:上午, 2:下午, 3:晚上)',
                                'isnull' => false,
                                'type' => 'numeric',
                                'example' => '2' ] ]
               ];
    }
    
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
AND cs.class_id = :class_id
AND cs.course_id = :course_id
AND (week0 ~ ('.*' || :schedule || '.*') OR week1 ~ ('.*' || :schedule || '.*') OR week2 ~ ('.*' || :schedule || '.*') OR week3 ~ ('.*' || :schedule || '.*') OR week4 ~ ('.*' || :schedule || '.*') OR week5 ~ ('.*' || :schedule || '.*') OR week6 ~ ('.*' || :schedule || '.*'))
";

        switch ($paras['schedule']){
        	case 0: $paras['schedule']=''; break;
        	case 1: $paras['schedule']='上'; break;
        	case 2: $paras['schedule']='下'; break;
        	case 3: $paras['schedule']='晚'; break;
        }
        
        
        $command = CDB::getConnection()->createCommand( $sql );
        $command->bindParam(':company_id',$paras['company_id'], \PDO::PARAM_INT); //培训班ID
        $command->bindParam(':class_id',$paras['class_id'], \PDO::PARAM_INT); //年级ID
        $command->bindParam(':course_id',$paras['course_id'], \PDO::PARAM_INT); //课程ID
        $command->bindParam(':schedule',$paras['schedule'], \PDO::PARAM_STR); //授课时间 (0:所有时段, 1:上午, 2:下午, 3:晚上)
        
        $data = $command->queryAll();

        CSystemCache::set($key, $data, 10*60);
        
        return $data;
    }


}
