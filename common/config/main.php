<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
    		'authManager' => [
    				'class' => 'yii\rbac\DbManager',
    				'defaultRoles' => ['guest'],
    				'cache' => 'cache' //�������� �����������
    		],
    	/*'authManager' => [
    		'class' => 'yii\rbac\PhpManager',
    		'defaultRoles' => ['user','moder','admin'], //����� ����������� ����
    		//������� ���� ����� ����������� ���� ����� ������������ RBAC
    		'itemFile' => '@common/components/rbac/items.php',
    		'assignmentFile' => '@common/components/rbac/assignments.php',
    		'ruleFile' => '@common/components/rbac/rules.php'
    		],*/
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
