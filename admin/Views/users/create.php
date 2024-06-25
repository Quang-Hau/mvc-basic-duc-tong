<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Create
            </h6>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 mt-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="type" class="form-label">Type:</label>
                            <select name="type" id="type" class="form-control">
                                <option value="1">Admin</option>
                                <option value="0">Member</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-danger" href="<?= BASE_URL_ADMIN ?>?act=users ">Back to list</a>
            </form>
        </div>
    </div>
</div>