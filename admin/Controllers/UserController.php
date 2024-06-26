<?php

function userListAll()
{
    $title = 'Danh sách user';
    $view = 'users/index';
    $script = 'datatable';
    $script2 = 'users/script';
    $style = 'datatable';

    $users = lisAll('users');


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function userShowOne($id)
{

    $user = showOne('users', $id);

    if (empty($user)) {
        e404();
    }

    $title = 'Chi tiết user :' .  $user['name'];
    $view = 'users/show';

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function userCreate()
{
    $title = 'Danh sách user';
    $view = 'users/create';

    if (!empty($_POST)) {

        $data = [
            'name' => $_POST['name'] ?? null,
            'email' => $_POST['email'] ?? null,
            'password' => $_POST['password'] ?? null,
            'type' => $_POST['type'] ?? null,
        ];

        $errors = validateCreate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            $_SESSION['data'] = $data;

            header('location: ' . BASE_URL_ADMIN . '?act=users-create');
            exit();
        }

        insert('users', $data);

        $_SESSION['success'] = 'Done';

        header('location: ' . BASE_URL_ADMIN . '?act=users');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

//valiate Create 
function validateCreate($data)
{
    $errors = [];
    //vld Name
    if(empty($data['name'])){
        $errors[] = 'Name is required';
    }else if(strlen($data['name']) > 50){
        $errors[] = 'The name is maximum 50 characters long';
    }

    //vld email
    if(empty($data['email'])){
        $errors[] = 'email is required';
    }else if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email invalidate';
    }else if(!checkUniqueEmail('users',$data['email'])){
        $errors[] = 'Email has been used';
    }

    //vld password
    if(empty($data['password'])){
        $errors[] = 'password is required';
    }else if(strlen($data['password']) < 8 || strlen($data['password']) > 20){
        $errors[] = 'The minimum password length is 8 characters and the maximum is 20 characters';
    }

    //vld type
    if($data['type'] === null){
        $errors[] = 'type is required';
    }
    // }else if(!in_array($data['type'],[0,1])){
    //     $errors[] = 'Type must be 0 or 1';
    // }

    return $errors;
}

function userUpdate($id)
{
    $user = showOne('users', $id);

    if (empty($user)) {
        e404();
    }

    $title = 'Cập nhật User:' . $user['name'];
    $view = 'users/update';

    if (!empty($_POST)) {

        $data = [
            'name' => $_POST['name'] ?? null,
            'email' => $_POST['email'] ?? null,
            'password' => $_POST['password'] ?? null,
            'type' => $_POST['type'] ?? null
        ];

        $errors = validateUpdate($id ,$data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {  
            update('users', $id, $data);

            $_SESSION['success'] = 'Done';
        }
        header('location: ' . BASE_URL_ADMIN . '?act=users-update&id=' . $id);
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

//validate update
function validateUpdate($id,$data)
{
    $errors = [];
    //vld Name
    if(empty($data['name'])){
        $errors[] = 'Name is required';
    }else if(strlen($data['name']) > 50){
        $errors[] = 'The name is maximum 50 characters long';
    }

    //vld email
    if(empty($data['email'])){
        $errors[] = 'email is required';
    }else if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email invalidate';
    }else if(!checkUniqueEmailForUpdate('users',$id,$data['email'])){
        $errors[] = 'Email has been used';
    }

    //vld password
    if(empty($data['password'])){
        $errors[] = 'password is required';
    }else if(strlen($data['password']) < 8 || strlen($data['password']) > 20){
        $errors[] = 'The minimum password length is 8 characters and the maximum is 20 characters';
    }

    //vld type
    if($data['type'] === null){
        $errors[] = 'type is required';
    }
    // }else if(!in_array($data['type'],[0,1])){
    //     $errors[] = 'Type must be 0 or 1';
    // }

    return $errors;
}

function userDelete($id)
{
    removed('users', $id);

    $_SESSION['success'] = 'Done';

    header('location: ' . BASE_URL_ADMIN . '?act=users');

    exit();
}
