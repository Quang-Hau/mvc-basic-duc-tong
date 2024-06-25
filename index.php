<?php

// require các file trong commons

require_once './commons/env.php'; // file biết môi trường
require_once './commons/helper.php';
require_once './commons/connect-db.php'; // require file connect csdl
require_once './commons/model.php';

// require các file trong Controller và models
//....

require_file(PATH_CONTROLLER);
require_file(PATH_MODEL);


//... điều hướng ....

$act = $_GET['act'] ?? '/';

match ($act) {
    '/' => Homeindex(),
    'user-detail' => userDetail($_GET['id']), // nếu trên đường dẫn có  'user-detail' thì hàm userDetail() trong UserController được gọi
};


require_once './commons/disconnect-db.php';// require file disconnect csdl