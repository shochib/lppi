<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title ?></h1>
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

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $page ?></h3>

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

                <button type="button" class="btn btn-success btn-sm tambah_data" data_title="Tambah Data" data-toggle="modal" data-target="#modal-jurnal" id="add_btn" data-id="0">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>

                <!-- /.card-header -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Judul</th>
                            <th>Kritaria</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $array_kriteria = array();
                        foreach ($kriteria as $key3 => $obj3) {

                            $IDdata = $obj3->id;
                            $Nama = $obj3->nama_kriteria;
                            $array_kriteria[$IDdata] = array("nama" => $Nama);
                        }

                        $no = 0;
                        foreach ($naskah as $key2 => $obj2) {
                            $no++;
                            $IDdata = $obj2->id;
                            $Mhs = $obj2->nama_mahasiswa;
                            $Dosen1 = $obj2->nama_dosen1;
                            $Dosen2 = $obj2->nama_dosen2;
                            $Judul = $obj2->judul;
                            $nama_jurnal = $obj2->nama_jurnal;
                            $url = $obj2->url;
                            $publikasi = $obj2->publikasi;
                            $kriteria_publikasi = $obj2->kriteria_publikasi;
                            $nm_kriteria = $array_kriteria[$kriteria_publikasi]["nama"];
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $Mhs ?></td>
                                <td><?= $Dosen1 ?></td>
                                <td><?= $Dosen2 ?></td>
                                <td><?= $Judul ?></td>
                                <td><?= $nm_kriteria ?></td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                                        <button class="btn btn-block btn-success btn-xs edit_data" data-toggle="modal" data-target="#modal-jurnal" data-title="Edit" data-id="<?= $IDdata ?>" data-nama="<?= $Mhs ?>" data-dosen1="<?= $Dosen1 ?>" data-dosen2="<?= $Dosen2 ?>" data-judul="<?= $Judul ?>" data-kriteria="<?= $kriteria_publikasi ?>" data-nama_jurnal="<?= $nama_jurnal ?>" data-url="<?= $url ?>" data-publikasi="<?= $publikasi ?>">
                                            <i class="fas fa-pencil-alt"></i> Edit </button>
                                    </p>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>

                </table>

                <!-- /.card-body -->
            </div>
        </div>


        <!-- /.card -->


        <script src="<?php echo base_url(); ?>files/plugins/jquery/jquery-1.10.2.js"></script>

        <script type="text/javascript">
            $(document).on("click", ".edit_data", function() {
                $("#data_title").html('Edit Data');

                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var judul = $(this).data('judul');
                var dosen1 = $(this).data('dosen1');
                var dosen2 = $(this).data('dosen2');
                var kriteria = $(this).data('kriteria');
                var nama_jurnal = $(this).data('nama_jurnal');
                var url = $(this).data('url');
                var publikasi = $(this).data('publikasi');
                $("#id_data").val(id);
                $("#nama").val(nama);
                $("#judul").val(judul);
                $("#nama_pembimbing1").val(dosen1);
                $("#nama_pembimbing2").val(dosen2);
                $("#kriteria").val(kriteria);
                $("#nama_jurnal").val(nama_jurnal);
                $("#url").val(url);
                $("#publikasi").val(publikasi);

            })

            $(document).on("click", ".tambah_data", function() {
                $("#data_title").html('Tambah Data');

                $("#id_data").val(id);
                $("#nama").val('');
                $("#judul").val('');
                $("#nama_pembimbing1").val('');
                $("#nama_pembimbing2").val('');
                $("#kriteria").val('');
                $("#nama_jurnal").val('');
                $("#url").val('');
                $("#publikasi").val('');
            })

            function showDiv(divId, element) {

                if (document.getElementById(divId).style.display = element.value == 3) {
                    document.getElementById(divId).style.display = "none";
                    document.getElementById("hidden_div").style.display = "block";


                } else if (document.getElementById(divId).style.display = element.value == 4) {
                    document.getElementById(divId).style.display = "none";
                    document.getElementById("hidden_div").style.display = "block";

                } else if (document.getElementById(divId).style.display = element.value == 1) {
                    document.getElementById(divId).style.display = "block";
                    document.getElementById("hidden_div").style.display = "none";

                } else if (document.getElementById(divId).style.display = element.value == 2) {
                    document.getElementById(divId).style.display = "block";
                    document.getElementById("hidden_div").style.display = "none";

                }

            }
        </script>

    </section>
    <!-- /.content -->


    <div id="modal-jurnal" class="modal fade">
        <div class="modal-dialog">
            <!--
            <form action="<?php echo base_url() . 'Naskahpublikasi/simpan'; ?>" method="post" enctype="multipart/form-data">
            -->

            <style>
                #hidden_div {
                    display: none;
                }
            </style>

            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url() . 'Naskahpublikasi/simpan'; ?>" id="mainForm" class="_form_post">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title" id="data_title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul Publikasi</label>
                            <input type="hidden" name="id" id="id_data">
                            <textarea name="judul" class="form-control" placeholder="Judul" id="judul" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Mahasiswa</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Mahasiswa" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Pembimbing 1</label>
                            <input type="text" name="nama_pembimbing1" class="form-control" id="nama_pembimbing1" placeholder="Pembimbing 1" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Pembimbing 2</label>
                            <input type="text" name="nama_pembimbing2" class="form-control" id="nama_pembimbing2" placeholder="Pembimbing 2" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Kriteria Publikasi Artikel</label>
                            <select name="kriteria" class="form-control" id="kriteria" onchange="showDiv('hidden_div', this)">
                                <option value="">-Pilih </option>

                                <?php
                                foreach ($kriteria as $key => $obj) {

                                    $IDdata = $obj->id;
                                    $Nama = $obj->nama_kriteria;

                                ?>
                                    <option value="<?= $IDdata ?>"><?= $Nama ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>

                        <div id="hidden_div">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Jurnal</label>
                                <input type="text" name="nama_jurnal" class="form-control" id="nama_jurnal" placeholder="Nama Jurnal">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Link Url Jurnal</label>
                                <input type="text" name="url" class="form-control" id="url" placeholder="Url">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Publikasi </label>
                                <select name="publikasi" class="form-control" id="publikasi">
                                    <option value="">-Pilih </option>
                                    <option value="Sinta">Sinta</option>
                                    <option value="Q">Q</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>



</div>


<!-- /.content-wrapper -->