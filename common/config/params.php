<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,

    // 图片服务器的域名设置，拼接保存在数据库中的相对地址，可通过web进行展示
    'uploadPath' => dirname(dirname(__DIR__)),
    'upload_domain' => 'http://file.docstore.com/',
    'domain' => '',
    'root' => dirname(dirname(__DIR__)),
    'webuploader' => [
        // 后端处理图片的地址，value 是相对的地址
        'uploadUrl' => '/upload/index',
        // 多文件分隔符
        'delimiter' => ',',
        // 基本配置
        'baseConfig' => [
            'defaultImage' => 'http://img1.imgtn.bdimg.com/it/u=2056478505,162569476&fm=26&gp=0.jpg',
            'disableGlobalDnd' => true,
            'accept' => [
                'title' => 'Images',
                'extensions' => 'gif,jpg,jpeg,bmp,png,docx,doc,pdf',
//                'mimeTypes' => 'image/*',
            ],
            'pick' => [
                'multiple' => false,
            ],
        ],
    ],
];
