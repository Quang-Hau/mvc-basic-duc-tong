<?php
session_start();
// require các file trong commons

require_once '../commons/env.php'; // file biết môi trường
require_once '../commons/helper.php';
require_once '../commons/connect-db.php'; // require file connect csdl
require_once '../commons/model.php';

// require các file trong Controller và models
//....

require_file(PATH_CONTROLLER_ADMIN);
require_file(PATH_MODEL_ADMIN);


//... điều hướng ....

$act = $_GET['act'] ?? '/';
//crud
match ($act) {
    '/' => dashboard(),
    // CRUD Users
    'users' => userListAll(),
    'users-detail' => userShowOne($_GET['id']),
    'users-create' => userCreate(),
    'users-update' => userUpdate($_GET['id']),
    'users-delete' => userDelete($_GET['id']),

    // CRUD Catecategory
    'categories' => categoryListAll(),
    'category-detail' => categoryShowOne($_GET['id']),
    'category-create' => categoryCreate(),
    'category-update' => categoryUpdate($_GET['id']),
    'category-delete' => categoryDelete($_GET['id']),

    // CRUD Tag
    'tags' => tagListAll(),
    'tag-detail' => tagShowOne($_GET['id']),
    'tag-create' => tagCreate(),
    'tag-update' => tagUpdate($_GET['id']),
    'tag-delete' => tagDelete($_GET['id']),

    
    // CRUD author
    'authors' => authorListAll(),
    'author-detail' => authorShowOne($_GET['id']),
    'author-create' => authorCreate(),
    'author-update' => authorUpdate($_GET['id']),
    'author-delete' => authorDelete($_GET['id']),
};


require_once '../commons/disconnect-db.php';// require file disconnect csdl