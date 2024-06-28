<?php

function tagListAll()
{
    $title = 'Danh sách tag';
    $view = 'tags/index';
    $script = 'datatable';
    $script2 = 'tags/script';
    $style = 'datatable';

    $tags = lisAll('tags');


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function tagShowOne($id)
{

    $tag = showOne('tags', $id);

    if (empty($tag)) {
        e404();
    }

    $title = 'Chi tiết tag :' .  $tag['name'];
    $view = 'tags/show';

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function tagCreate()
{
    $title = 'Danh sách tag';
    $view = 'tags/create';

    if (!empty($_POST)) {

        $data = [
            'name' => $_POST['name'] ?? null,
        ];

        $errors = validateTagCreate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            $_SESSION['data'] = $data;

            header('location: ' . BASE_URL_ADMIN . '?act=tag-create');
            exit();
        }

        insert('tags', $data);

        $_SESSION['success'] = 'Done';

        header('location: ' . BASE_URL_ADMIN . '?act=tags');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

//valiate Create 
function validateTagCreate($data)
{
    $errors = [];
    //vld Name
    if(empty($data['name'])){
        $errors[] = 'Name is required';
    }else if(strlen($data['name']) > 50){
        $errors[] = 'The name is maximum 50 characters long';
    }else if(!checkUniqueName('tags',$data['name'])){
        $errors[] = 'Name has been used';
    }

    return $errors;
}

function tagUpdate($id)
{
    $tag = showOne('tags', $id);

    if (empty($tag)) {
        e404();
    }

    $title = 'Cập nhật tag:' . $tag['name'];
    $view = 'tags/update';

    if (!empty($_POST)) {

        $data = [
            'name' => $_POST['name'] ?? null,
            
        ];

        $errors = validateTagUpdate($id ,$data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {  
            update('tags', $id, $data);

            $_SESSION['success'] = 'Done';
        }
        header('location: ' . BASE_URL_ADMIN . '?act=tag-update&id=' . $id);
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

//validate update
function validateTagUpdate($id,$data)
{
    $errors = [];
    //vld Name
    if(empty($data['name'])){
        $errors[] = 'Name is required';
    }else if(strlen($data['name']) > 50){
        $errors[] = 'The name is maximum 50 characters long';
    }else if(!checkUniqueNameForUpdate('tags',$id,$data['name'])){
        $errors[] = 'Name has been used';
    }

    return $errors;
}

function tagDelete($id)
{
    removed('tags', $id);

    $_SESSION['success'] = 'Done';

    header('location: ' . BASE_URL_ADMIN . '?act=tags');

    exit();
}
