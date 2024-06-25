<?php

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

match ($act) {
    '/' => dashboard(),
    'users' => userListAll(),
    'users-detail' => userShowOne($_GET['id']),
    'users-create' => userCreate(),
    'users-update' => userUpdate($_GET['id']),
    'users-delete' => userDelete($_GET['id']),
};


require_once '../commons/disconnect-db.php';// require file disconnect csdl