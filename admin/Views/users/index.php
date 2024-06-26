<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">
    <?= $title ?>
    <a class="btn btn-primary" href="<?= BASE_URL_ADMIN ?>?act=users-create ">Create</a>

  </h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
        DataTables
      </h6>
    </div>
    <div class="card-body">
      <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success">
          <?= $_SESSION['success'] ?>
        </div>
        <?php unset($_SESSION['success']) ?>
      <?php endif ?>

      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Type</th>
              <th>Action</th>
              <th></th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Type</th>
              <th>Action</th>
              <th></th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($users as $user) : ?>
              <tr>
                <td><?= $user['id'] ?> </td>
                <td><?= $user['name'] ?> </td>
                <td><?= $user['email'] ?> </td>
                <td><?= $user['type'] ? '<span class="badge badge-success" >Admin</span>' : '<span class="badge badge-warning" >Member</span>' ?> </td>
                <td>
                  <a class="btn btn-info" href="<?= BASE_URL_ADMIN ?>?act=users-detail&id=<?= $user['id'] ?>">Show</a>
                  <a class="btn btn-warning" href="<?= BASE_URL_ADMIN ?>?act=users-update&id=<?= $user['id'] ?>">Update</a>
                  <a class="btn btn-danger" onclick="return confirm('Are you sure delete this table ?')" href="<?= BASE_URL_ADMIN ?>?act=users-delete&id=<?= $user['id'] ?>">Delete</a>
                </td>
                <td></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>