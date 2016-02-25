<?php
return [
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => 'yii\gii\Module',
    		
    	//add by Scott
    	'gridview' => [
    			'class' => '\kartik\grid\Module'
    			// enter optional module parameters below - only if you need to
    			// use your own export download action or custom translation
    			// message source
    			// 'downloadAction' => 'gridview/export/download',
    			// 'i18n' => []
    	],
    ],
];
