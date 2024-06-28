<?php

function authorListAll()
{
    $title = 'Danh sách author';
    $view = 'authors/index';
    $script = 'datatable';
    $script2 = 'authors/script';
    $style = 'datatable';

    $authors = lisAll('authors');


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function authorShowOne($id)
{

    $author = showOne('authors', $id);

    if (empty($author)) {
        e404();
    }

    $title = 'Chi tiết author :' .  $author['name'];
    $view = 'authors/show';

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function authorCreate()
{
    $title = 'Danh sách author';
    $view = 'authors/create';

    if (!empty($_POST)) {

        $data = [
            'name' => $_POST['name'] ?? null,
            'avatar' => $_POST['avatar'] ?? null,
        ];

        $errors = validateAuthorCreate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            $_SESSION['data'] = $data;

            header('location: ' . BASE_URL_ADMIN . '?act=author-create');
            exit();
        }

        //upload files
        $avatar = $_FILES['avatar'] ?? null;

        if (!empty($avatar)) {
            //nếu xử lý upload file thành công thì $data['avatar'] sẽ ghi dè kết quả $_POST['avatar'] ?? null, ở trên mảng data
            $data['avatar'] = upload_file($avatar, 'uploads/authors/');
        }


        insert('authors', $data);

        $_SESSION['success'] = 'Done';

        header('location: ' . BASE_URL_ADMIN . '?act=authors');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

//valiate Create 
function validateAuthorCreate($data)
{
    $errors = [];
    //vld Name
    if (empty($data['name'])) {
        $errors[] = 'Name is required';
    } else if (strlen($data['name']) > 50) {
        $errors[] = 'The name is maximum 50 characters long';
    } else if (!checkUniqueName('authors', $data['name'])) {
        $errors[] = 'Name has been used';
    }

    //vld avatar
    $typeImage = ['image/png', 'image/jpeg', 'image/jpg'];

    if ($data['avatar']['size'] > 2 * 1024 * 1024) {
        $errors[] = ' Capacity must not exceed 2MB';
    } else// if (!in_array($data['avatar']['type'], $typeImage)) {
       // $errors[] = 'The avatar field only accepts png, jpg, jpeg formats';
   // }
    return $errors;
}

function authorUpdate($id)
{
    $author = showOne('authors', $id);

    if (empty($author)) {
        e404();
    }

    $title = 'Cập nhật author:' . $author['name'];
    $view = 'authors/update';

    if (!empty($_POST)) {

        $data = [
            'name' => $_POST['name'] ?? null,
            'avatar' => $_POST['avatar'] ?? null,
        ];

        $errors = validateAuthorUpdate($id, $data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {

            //upload files
            $avatar = $_FILES['avatar'] ?? null;

            if (!empty($avatar)) {
                //nếu xử lý upload file thành công thì $data['avatar'] sẽ ghi dè kết quả $_POST['avatar'] ?? null, ở trên mảng data
                $data['avatar'] = upload_file($avatar, 'uploads/authors/');
            }

            update('authors', $id, $data);
            //xóa file cũ trên hệ thống
            if(!empty($avatar)  //có upload file
             && !empty($author['avatar']) //có giá trị
             && !empty($data['avatar']) //uploadfile thành công
             && file_exists(PATH_UPLOAD . $author['avatar'])) // phải còn file tồn tại trên hệ thống
            {
                    unlink(PATH_UPLOAD . $author['avatar']);
            }

            $_SESSION['success'] = 'Done';
        }
        header('location: ' . BASE_URL_ADMIN . '?act=author-update&id=' . $id);
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

//validate update
function validateAuthorUpdate($id, $data)
{
    $errors = [];
    //vld Name
    if (empty($data['name'])) {
        $errors[] = 'Name is required';
    } else if (strlen($data['name']) > 50) {
        $errors[] = 'The name is maximum 50 characters long';
    } else if (!checkUniqueNameForUpdate('authors', $id, $data['name'])) {
        $errors[] = 'Name has been used';
    }

    //vld avatar
    $typeImage = ['png', 'jpeg', 'jpg'];

    if ($data['avatar']['size'] > 2 * 1024 * 1024) {
        $errors[] = 'Capacity must not exceed 2MB';
     } //else if (!in_array($data['avatar']['type'], $typeImage)) {
    //     $errors[] = 'The avatar field only accepts png, jpg, jpeg formats';
    // }
    return $errors;
}

function authorDelete($id)
{
    $author = showOne('authors', $id);

    if (empty($author)) {
        e404();
    }

    removed('authors', $id);

     //xóa file cũ trên hệ thống
     if(!empty($author['avatar'])  //có upload file
     && file_exists(PATH_UPLOAD . $author['avatar'])) // phải còn file tồn tại trên hệ thống
    {
         unlink(PATH_UPLOAD . $author['avatar']);
    }

    $_SESSION['success'] = 'Done';

    header('location: ' . BASE_URL_ADMIN . '?act=authors');

    exit();
}
