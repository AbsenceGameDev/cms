<?php

$config = [
    'model' => [
        'gallery_image' => [
            'class' => Gallery_Model_Image::class,
        ],
        'gallery_group' => [
            'class' => Gallery_Model_Group::class,
        ],
    ],

    'block' => [
        'admin.head' => [
            'stylesheet' => [
                'Leafiny_Gallery::backend/css/gallery.css' => 600,
            ],
        ],
        'admin.script' => [
            'javascript' => [
                'Leafiny_Gallery::backend/js/gallery.js' => 200
            ]
        ],
        'admin.gallery.form' => [
            'template'          => 'Leafiny_Gallery::block/backend/form/gallery.twig',
            'class'             => Gallery_Block_Backend_Form_Gallery::class,
            'context'           => Backend_Page_Admin_Page_Abstract::CONTEXT_BACKEND,
            'input_file_name'   => 'gallery_images',
            'input_data_name'   => 'gallery_image',
            'delete_identifier' => '/admin/*/gallery/image/delete/',
            'status_identifier' => '/admin/*/gallery/image/status/',
            'show_position'     => true,
            'show_label'        => true,
        ],
        'admin.menu' => [
            'tree' => [
                200 => [
                    'Content' => [
                        30 => [
                            'title' => 'Images',
                            'path'  => '/admin/*/gallery/list/'
                        ],
                    ]
                ]
            ]
        ],
    ],

    'page' => [
        '/admin/*/gallery/image/delete/' => [
            'class'            => Gallery_Page_Backend_Gallery_Image_Delete::class,
            'template'         => null,
            'allow_params'     => 1,
        ],
        '/admin/*/gallery/image/status/' => [
            'class'            => Gallery_Page_Backend_Gallery_Image_Status::class,
            'template'         => null,
            'allow_params'     => 1,
        ],

        /* Gallery Groups */
        '/admin/*/gallery/list/' => [
            'title'            => 'Images',
            'template'         => 'Leafiny_Backend::page.twig',
            'class'            => Catalog_Page_Backend_Product_List::class,
            'content'          => 'Leafiny_Gallery::page/backend/gallery/list.twig',
            'model_identifier' => 'gallery_group',
            'meta_title'       => 'Images',
            'meta_description' => '',
        ],
        '/admin/*/gallery/list/action/' => [
            'class'            => Backend_Page_Admin_List_Action::class,
            'model_identifier' => 'gallery_group',
            'template'         => null,
            'allow_params'     => 1,
        ],
        '/admin/*/gallery/new/' => [
            'title'              => 'New',
            'class'              => Backend_Page_Admin_Form_New::class,
            'template'           => null,
        ],
        '/admin/*/gallery/edit/' => [
            'title'                 => 'Edit',
            'template'              => 'Leafiny_Backend::page.twig',
            'class'                 => Backend_Page_Admin_Form::class,
            'content'               => 'Leafiny_Gallery::page/backend/gallery/form.twig',
            'referer_identifier'    => '/admin/*/gallery/list/',
            'model_identifier'      => 'gallery_group',
            'meta_title'            => 'Edit',
            'meta_description'      => '',
            'allow_params'          => 1,
            'types'                 => ['folder' => 'Folder'],
            'javascript'            => [
                'Leafiny_Gallery::backend/js/gallery/form.js' => 200
            ]
        ],
        '/admin/*/gallery/edit/save/' => [
            'class'            => Backend_Page_Admin_Form_Save::class,
            'model_identifier' => 'gallery_group',
            'template'         => null,
        ],
        /* /Gallery Groups */
    ],

    'observer' => [
        'backend_object_save_after' => [
            'backend_gallery_image_add' => 200,
        ],
        'object_delete_after' => [
            'backend_gallery_image_delete' => 200,
        ],
    ],

    'event' => [
        'backend_gallery_image_add' => [
            'class' => Gallery_Observer_Backend_Gallery_ProcessImages::class,
            'allowed_extensions' => ['jpg', 'jpeg', 'gif', 'png'],
        ],
        'backend_gallery_image_delete' => [
            'class' => Gallery_Observer_Backend_Gallery_DeleteImages::class,
        ],
    ],
];
