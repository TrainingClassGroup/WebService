<?php

namespace app\models;

class CTree {

    /*
     * $idPath=id1/id2/id3...
    * $menu=[id, menu, paras]
    * $submenu=[id, menu, paras]
    */
    public static function menuTree(&$result, $idPath, $menu, $submenu){
        $_result = &$result;

        $paths = split("/", $idPath);
        $pathsNum = count($paths);
        // search path
        for($p=0;$p<$pathsNum;$p++){
            if(strlen($paths[$p])==0) continue;

            if(!isset($_result[$paths[$p]]) || !is_array($_result[$paths[$p]])){
                $_result[$paths[$p]] = [];
            }
            if(!isset($_result[$paths[$p]]['sub']) || !is_array($_result[$paths[$p]]['sub'])){
                $_result[$paths[$p]]['sub'] = [];
            }
            $_result=&$_result[$paths[$p]]['sub'];
        }
        //
        if(!isset($_result[$menu['id']]) || !is_array($_result[$menu['id']])){
            $_result[$menu['id']] = ['menu'=> $menu['menu'],
                    'paras'=> $menu['paras'],
                    'sub'=>[ ]
                    ];
        }
        $_result[$menu['id']]['sub'][$submenu['id']] = ['menu'=> $submenu['menu'],
        'paras'=> $submenu['paras'],
        'sub'=> []
        ];

    }
}

?>