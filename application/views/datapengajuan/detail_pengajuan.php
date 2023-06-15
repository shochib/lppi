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

     <section class="content">
         <?php
            $id_jenis = $this->uri->segment(3, 0);
            $array_val = array();
            if ($id_jenis != 3) {
                foreach ($publikasi_user as $key3 => $obj3) {

                    foreach ($publikasi_form as $key2 => $obj2) {

                        $Field = $obj2->nama_field;
                        $vl = $obj3->$Field;
                        $id_field = $obj2->id_field;

                        $array_val[] = array("nilai" => $vl, "nama" => $Field, "id_field" => $id_field);
                    }
                }
            } else {
                //sitasi
                $hitung_sitasi = count($publikasisitasi_user);
                $subtr = "";
                $no = 0;

                if ($hitung_sitasi > 0) {
                    foreach ($publikasisitasi_user as $key3 => $obj3) {
                        $id = $obj3->id;
                        $judul = $obj3->judul;
                        $no++;

                        $pensitasi = "";
                        $no2 = 0;

                        foreach ($pensitasi_user as $key2 => $obj2) {
                            $id_penelitian = $obj2->id_penelitian;
                            $judul_pensitasi = $obj2->judul;

                            if ($id_penelitian == $id) {
                                $no2++;
                                $pensitasi .= "$no2. $judul_pensitasi<br>";
                            }
                        }

                        $subtr .= "<tr>
                            <td>$no</td>
                            <td>$judul</td>
                            <td>$pensitasi</td>
                        </tr>";
                    }
                }
            }

            //print_r($publikasi_form);

            ?>

         <div class="card">
             <div class="card card-outline card-info">
                 <div class="card-header">
                     <h3 class="card-title">Data Publikasi</h3>
                 </div>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
                 <div class="card-body p-0">
                     <table class="table table-striped">
                         <tbody>
                             <tr>
                                 <td><b>NIDN</b></td>
                             </tr>
                             <tr>
                                 <td><b>Nama</b></td>
                             </tr>
                             <tr>
                                 <td><b>Prodi</b></td>
                             </tr>
                             <tr>
                                 <td></td>
                             </tr>

                         </tbody>
                     </table>

                     <table class="table table-striped">
                         <tbody>
                             <?php
                                if ($id_jenis != 3) {
                                    foreach ($array_val as $key4) {
                                        $nilai = $key4['nilai'];
                                        $nama = $key4['nama'];
                                        $id_field = $key4['id_field'];

                                ?>
                                     <tr>
                                         <td width="15%"><b><?= $nama ?></b></td>
                                         <td><?= $nilai ?></td>
                                     </tr>
                                 <?php
                                    }
                                } else {
                                    ?>
                                 <tr>
                                     <th>No.</th>
                                     <th>Judul</th>
                                     <th>Pensitasi</th>
                                 </tr>
                             <?php
                                    echo $subtr;
                                } ?>

                         </tbody>
                     </table>
                 </div>
             </div>
             <!-- /.card-body -->
         </div>
         <!-- /.card -->

         <div class="card">
             <div class="card card-outline card-info">
                 <div class="card-header">
                     <h3 class="card-title">Data Reviewer</h3>
                 </div>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
                 <div class="card-body p-0">
                     <table class="table table-striped">
                         <tbody>

                             <tr>
                                 <td>

                                     <select class="form-control">
                                         <option>-Pilih Reviewer 1</option>
                                         <option>option 2</option>
                                         <option>option 3</option>
                                         <option>option 4</option>
                                         <option>option 5</option>
                                     </select>

                                 </td>
                             </tr>
                             <tr>
                                 <td>

                                     <select class="form-control">
                                         <option>-Pilih Reviewer 2</option>
                                         <option>option 2</option>
                                         <option>option 3</option>
                                         <option>option 4</option>
                                         <option>option 5</option>
                                     </select>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
                 <!-- /.card-body -->
             </div>
         </div>

     </section>

     <section class="content">
         <div class="row">
             <div class="col-md-12">
                 <div class="card card-outline card-info">
                     <div class="card-header">
                         <h3 class="card-title">
                             Catatan
                         </h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                         <textarea id="summernote">
                            Place <em>some</em> <u>text</u> <strong>here</strong>
                        </textarea>
                     </div>

                 </div>
             </div>
             <!-- /.col-->
         </div>
         <!-- ./row -->

     </section>

     <section class="content">
         <div class="row">
             <div class="col-md-12">
                 <div class="card card-outline card-info">

                     <!-- /.card-header -->
                     <div class="card-body">
                         <select class="form-control">
                             <option>-Pilih Status Diterima</option>
                             <option>option 2</option>
                             <option>option 3</option>
                             <option>option 4</option>
                             <option>option 5</option>
                         </select>
                         <br>
                         <button type="button" class="btn btn-default"><i class="fa fa-arrow-left "></i> </button>
                         <button type="button" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                     </div>

                 </div>
             </div>
             <!-- /.col-->
         </div>
         <!-- ./row -->

     </section>
     <!-- /.content -->

 </div>