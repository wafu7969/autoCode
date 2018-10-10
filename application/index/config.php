<?php

return [
    'dataname'          => 'xmh_v5',  //数据表前缀
    'prefix'          => 'cc_',  //数据表前缀
    'group'           =>[
        'api'=>[
            'api'=>'E:\2-xmh(test)\application\api\controller\v5',
            'event'=>'E:\2-xmh(test)\application\api\event',
            'model'=>'E:\2-xmh(test)\application\api\model',
        ],
        'admin'=>[
            'api'=>'E:\2-xmh(test)\application\admin\controller',
            'event'=>'E:\2-xmh(test)\application\admin\Event',
            'model'=>'E:\2-xmh(test)\application\admin\model',
        ]
    ],
    'temp'=>[
        'admin'=>'E:\10-autoCode\application\index\template\admin',
        'api'=>'E:\10-autoCode\application\index\template\api',
     ],
    'copyright'=>'Xmh',
    'user_name'=>'Fuqiang wang',
];