<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Input User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Quick Example</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php echo validation_errors(); ?>

        <form action="<?php echo base_url() . 'Data/add'; ?>" method="post">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="hidden" name="user_id" value="<?= $row->id ?>">
              <input type="text" name="username" value="<?= $row->username ?>" class="form-control" id="exampleInputText" placeholder="Enter username">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Password</label>
              <input type="password" name="password1" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Ulangi Password</label>
              <input type="password" name="password2" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" name="email" value="<?= $row->email ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Unit Kerja</label>
              <select name="unit" <?= set_value('unit') ?> class="form-control">
                <option value="">-Pilih </option>

                <?php
                $id_unit = $row->unit;

                foreach ($dataunit as $key => $obj) {
                  $kode_unit = $obj->kode_unit;
                  $sub_unit = $obj->sub_unit;

                  if ($kode_unit == $id_unit) {
                    $sel = "selected";
                  } else {
                    $sel = "";
                  }

                  echo "<option value=\"$kode_unit\" $sel>$sub_unit</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Status</label>
              <select name="status" class="form-control">
                <option value=""> - Pilih</option>
                <option value="2"> Administrator</option>
                <option value="3"> Admin Fakjur</option>
                <option value="9"> Reviewer</option>
                <option value="10"> User Pengaju</option>
              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="<?= $page ?>"> <i class="fa fa-save"></i> <?= $page ?> </button>
          </div>
        </form>
      </div>
    </div>


</div>

<!-- /.card-footer-->

</section>
<!-- /.content -->