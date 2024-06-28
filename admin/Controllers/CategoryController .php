<?php

function categoryListAll()
{
    $title = 'Danh sách category';
    $view = 'categories/index';
    $script = 'datatable';
    $script2 = 'categories/script';
    $style = 'datatable';

    $categories = lisAll('categories');


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function categoryShowOne($id)
{

    $category = showOne('categories', $id);

    if (empty($category)) {
        e404();
    }

    $title = 'Chi tiết category :' .  $category['name'];
    $view = 'categories/show';

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function categoryCreate()
{
    $title = 'Danh sách category';
    $view = 'categories/create';

    if (!empty($_POST)) {

        $data = [
            'name' => $_POST['name'] ?? null,
        ];

        $errors = validateCategoryCreate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            $_SESSION['data'] = $data;

            header('location: ' . BASE_URL_ADMIN . '?act=category-create');
            exit();
        }

        insert('categories', $data);

        $_SESSION['success'] = 'Done';

        header('location: ' . BASE_URL_ADMIN . '?act=categories');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

//valiate Create 
function validateCategoryCreate($data)
{
    $errors = [];
    //vld Name
    if(empty($data['name'])){
        $errors[] = 'Name is required';
    }else if(strlen($data['name']) > 50){
        $errors[] = 'The name is maximum 50 characters long';
    }else if(!checkUniqueName('categories',$data['name'])){
        $errors[] = 'Name has been used';
    }

   
    return $errors;
}

function categoryUpdate($id)
{
    $category = showOne('categories', $id);

    if (empty($category)) {
        e404();
    }

    $title = 'Cập nhật category:' . $category['name'];
    $view = 'categories/update';

    if (!empty($_POST)) {

        $data = [
            'name' => $_POST['name'] ?? null
        ];

        $errors = validateCategoryUpdate($id ,$data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {  
            update('categories', $id, $data);

            $_SESSION['success'] = 'Done';
        }
        header('location: ' . BASE_URL_ADMIN . '?act=category-update&id=' . $id);
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

//validate update
function validateCategoryUpdate($id,$data)
{
    $errors = [];
    //vld Name
    if(empty($data['name'])){
        $errors[] = 'Name is required';
    }else if(strlen($data['name']) > 50){
        $errors[] = 'The name is maximum 50 characters long';
    }else if(!checkUniqueNameForUpdate('categories',$id,$data['name'])){
        $errors[] = 'Name has been used';
    }

    return $errors;
}

function categoryDelete($id)
{
    removed('categories', $id);

    $_SESSION['success'] = 'Done';

    header('location: ' . BASE_URL_ADMIN . '?act=categories');

    exit();
}
