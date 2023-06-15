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
         <div class="row">
             <div class="col-md-6">
                 <div class="card">
                     <div class="card-header">
                         <h3 class="card-title">Pilih Jenis Insentif Publikasi </h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                         <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                         <div id="accordion">
                             <?php
                                //print_r($publikasi);
                                $no = 0;
                                $sisa = 0;

                                foreach ($publikasi as $key => $obj) {
                                    $no++;
                                    $nama = $obj->nama;
                                    $id = $obj->id;

                                    $sisa = $no % 4;

                                    if ($sisa == 0) {
                                        $cl = "primary";
                                    } elseif ($sisa == 1) {
                                        $cl = "danger";
                                    } elseif ($sisa == 2) {
                                        $cl = "success";
                                    } elseif ($sisa == 3) {
                                        $cl = "warning";
                                    }

                                    $nm_publis = "";
                                    foreach ($masterpublikasi as $key2 => $obj2) {
                                        $id_jenis = $obj2->id_jenis;
                                        if ($id_jenis == $id) {

                                            $id_m = $obj2->id;

                                            $nm_pub = $obj2->nama;
                                            $nm_publis .= "<button type=\"button\" class=\"btn btn-outline-info btn-block btn-flat\" onclick=\"location.href= '" . base_url("Pengajuan/cekdata/$id/$id_m") . "' \"><i class=\"fa fa-book\"></i> $nm_pub </button>";
                                        }
                                    }

                                ?>
                                 <div class="card card-<?= $cl ?>">
                                     <div class="card-header">
                                         <h4 class="card-title w-100">
                                             <a class="d-block w-100" data-toggle="collapse" href="#collapse-<?= $id ?>">
                                                 <?= $nama ?>
                                             </a>
                                         </h4>
                                     </div>
                                     <div id="collapse-<?= $id ?>" class="collapse" data-parent="#accordion">
                                         <div class="card-body">
                                             <?= $nm_publis ?>
                                         </div>
                                     </div>
                                 </div>
                             <?php
                                }
                                ?>

                         </div>
                     </div>
                     <!-- /.card-body -->
                 </div>
                 <!-- /.card -->
             </div>
             <!-- /.col -->
             <div class="col-md-6">
                 <div class="card">
                     <div class="card-header">
                         <h3 class="card-title"></h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                         <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                             <ol class="carousel-indicators">
                                 <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                 <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                 <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                             </ol>
                             <div class="carousel-inner">
                                 <div class="carousel-item active">
                                     <img class="d-block w-100" src="https://lppi.umm.ac.id/files/image/Header%20-%20Klinik%20dan%20Review%20Artikel%20Jurnal%20Jul-Sep%202022.jpg" alt="First slide">
                                 </div>
                                 <div class="carousel-item">
                                     <img class="d-block w-100" src="https://lppi.umm.ac.id/files/image/Header%20website%20LPPI%202022%202.jpg" alt="Second slide">
                                 </div>
                                 <div class="carousel-item">
                                     <img class="d-block w-100" src="https://lppi.umm.ac.id/files/image/Header1%20rgb.jpg" alt="Third slide">
                                 </div>
                             </div>
                             <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                 <span class="carousel-control-custom-icon" aria-hidden="true">
                                     <i class="fas fa-chevron-left"></i>
                                 </span>
                                 <span class="sr-only">Previous</span>
                             </a>
                             <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                 <span class="carousel-control-custom-icon" aria-hidden="true">
                                     <i class="fas fa-chevron-right"></i>
                                 </span>
                                 <span class="sr-only">Next</span>
                             </a>
                         </div>
                     </div>
                     <!-- /.card-body -->
                 </div>
                 <!-- /.card -->
             </div>
             <!-- /.col -->
         </div>
     </section>

 </div>