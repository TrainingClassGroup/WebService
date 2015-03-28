<?php

namespace app\models;

class CData_Reservation extends CData {
    public static function description(){
        return [
                    'description' => '根据“用户ID”查询预约。',
                    'paras' => [
                                    [
                                        'para' => 'user_id',
                                        'desc' => '用户ID',
                                        'isnull' => false,
                                        'type' => 'numeric',
                                        'example' => '1' ] ]
               ];
    }
    /*
     * (non-PHPdoc) @see \app\models\CData::getx()
     */
    protected static function getex( $paras = null ){
        $key = __METHOD__ . ":" . serialize( $paras );
        $data = CSystemCache::get( $key );
        if( !is_null( $data ) ) return $data;
       
        $sql = "select cr.reservation_time, cu.id user_id, cu.tel, cu.username, cu.weixin, c.id company_id, c.company, ct.id teacher_id, ct.teacher, cs.class_id, cn.class_name, cc.course, cs.week0, cs.week1, cs.week2, cs.week3, cs.week4, cs.week5, cs.week6
from tab_training_class_reservation cr, tab_training_class_teacher ct,tab_training_class_user cu, tab_training_class_schedule cs, tab_training_class_db c, tab_training_class_course cc, tab_training_class_classname cn
where cr.teacher_id = ct.id
and cr.user_id = cu.id
and ct.company_id = c.id
and ct.schedule_id = cs.id
and cs.course_id = cc.id
and cs.class_id = cn.id
and cr.user_id=:user_id";
        
        
        $command = CDB::getConnection()->createCommand( $sql );
        $command->bindParam( ':user_id', $paras['user_id'], \PDO::PARAM_INT ); // 用户ID
        
        $data = $command->queryAll();
        
        CSystemCache::set( $key, $data, 10 * 60 );
        
        return $data;
    }
}
