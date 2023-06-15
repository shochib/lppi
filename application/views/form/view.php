<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
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
        <?php
        $form = "";
        $form2 = "";
        $form_jurnal = "";
        $form_pensitasi = "";
        $no = 0;
        $bagi2 = floor(count($field) / 2);

        foreach ($field as $key => $obj) {
            $no++;
            $IDdata = $obj->id;
            $IDfield = $obj->id_field;
            $Namafield = $obj->nama_field;
            $Namajudul = $obj->nama_judul;
            $IDpublikasi = $obj->id_publikasi;
            $Subform = $obj->sub_form;

            if ($IDfield == 1) {
                $field = "<input type=\"text\" name=\"$Namafield\" class=\"form-control\" id=\"exampleInputEmail1\">";
            } elseif ($IDfield == 3) {
                $reff_pilihdata = $obj->reff_pilihdata;
                if ($reff_pilihdata) {

                    $radio = "";
                    $field = "";

                    $this->db->select('*');
                    $this->db->from($reff_pilihdata);
                    $this->db->where('hapus', 0);
                    $query = $this->db->get();

                    foreach ($query->result() as $row) {
                        $Nama = $row->nama;
                        $field .= "<div class=\"custom-control custom-radio\">
                        <input class=\"form-check-input\" type=\"radio\" name=\"$Namafield\"> $Nama 
                        </div>";
                    }
                }
            } elseif ($IDfield == 5) {
                $field = "<div class=\"input-group\">
                      <div class=\"custom-file\">
                        <input type=\"file\" class=\"custom-file-input\" id=\"exampleInputFile\" name=\"$Namafield\">
                        <label class=\"custom-file-label\" for=\"exampleInputFile\">Choose file</label>
                      </div>
                      
                    </div>";
            } elseif ($IDfield == 6) {
                $field = "<input type=\"date\" name=\"$Namafield\" class=\"form-control\" id=\"exampleInputEmail1\">";
            } elseif ($IDfield == 7) {
                $thn_now = date("Y");
                $field = "<input type=\"number\" name=\"$Namafield\" value=\"$thn_now\" class=\"form-control\" id=\"exampleInputEmail1\">";
            }

            if ($Subform == $IDpublikasi) {
                $form_pensitasi .= "<div class=\"form-group\">
                    <label for=\"exampleInputEmail1\">$Namajudul</label>
                    $field
                </div>";
            } else {
                $form_jurnal .= "<div class=\"form-group\">
                    <label for=\"exampleInputEmail1\">$Namajudul</label>
                    $field
                </div>";
            }

            if ($no <= $bagi2) {
                $form .= "<div class=\"form-group\">
                    <label for=\"exampleInputEmail1\">$Namajudul</label>
                    $field
                </div>";
            } else {
                $form2 .= "<div class=\"form-group\">
                    <label for=\"exampleInputEmail1\">$Namajudul</label>
                    $field
                </div>";
            }
        }

        //print_r($jurnal);
        ?>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $jurnal['nama']; ?></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">

                <div class="card">

                    <!-- /.card-header -->

                    <?php
                    if ($Subform > 0) {
                    ?>
                        <div class="card-body">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-jurnal">
                                <i class="fa fa-plus"></i> Tambah Jurnal
                            </button>
                            <hr>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No.</th>
                                        <th>Jurnal</th>
                                        <th>Jurnal Pensitasi</th>
                                        <th style="width: 40px">Label</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>Jurnal</td>
                                        <td>
                                            <p>1. Jurnal Pensitasi 1</p>
                                            <p>2. Jurnal Pensitasi 2</p>
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-pensitasi">
                                                <i class="fa fa-plus"></i> Tambah Pensitasi
                                            </button>
                                        </td>
                                        <td><span class="badge bg-danger">55%</span></td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Jurnal 2</td>
                                        <td><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-pensitasi">
                                                <i class="fa fa-plus"></i> Tambah Pensitasi
                                            </button></td>
                                        <td><span class="badge bg-warning">70%</span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade" id="modal-jurnal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Data</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form>
                                        <div class="card-body">
                                            <?= $form_jurnal ?>
                                        </div>
                                        <!-- /.card-body -->



                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" name="simpan" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                        <div class="modal fade" id="modal-pensitasi">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Data</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form>
                                        <div class="card-body">
                                            <?= $form_pensitasi ?>
                                        </div>
                                        <!-- /.card-body -->



                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" name="simpan" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    <?php
                    } else {
                    ?>
                        <div class="card-body">

                            <div class="row">
                                <!-- left column -->
                                <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Isian Ke 1</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form>
                                            <div class="card-body">
                                                <?= $form ?>
                                            </div>
                                            <!-- /.card-body -->


                                        </form>
                                    </div>
                                    <!-- /.card -->

                                </div>
                                <!--/.col (left) -->
                                <!-- right column -->
                                <div class="col-md-6">
                                    <!-- Form Element sizes -->
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Isian Ke 2</h3>
                                        </div>
                                        <div class="card-body">
                                            <?= $form2 ?>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->

                                    <!-- /.card -->
                                </div>
                                <!--/.col (right) -->
                            </div>


                        </div>
                    <?php
                    }
                    ?>


                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url("Form") ?>' "> Kembali</button>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->