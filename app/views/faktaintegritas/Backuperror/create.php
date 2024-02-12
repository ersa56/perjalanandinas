<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $data['title']; ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $data['title']; ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url; ?>/faktaintegritas/simpanFaktaIntegritas" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Masukkan Alamat..." name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Hari</label>
                        <input type="date" class="form-control" name="hari" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="tel" class="form-control" placeholder="Masukkan Nomor Telepon..." name="nomor_telepon" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Berangkat</label>
                        <input type="date" class="form-control" name="tanggal_berangkat" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pulang</label>
                        <input type="date" class="form-control" name="tanggal_pulang" required>
                    </div>
                    <div class="form-group">
                        <label>Tempat Tujuan</label>
                        <input type="text" class="form-control" placeholder="Masukkan Tempat Tujuan..." name="tempat_tujuan" required>
                    </div>
                    <div class="form-group">
                        <label>File Upload</label>
                        <input type="file" class="form-control" name="fileupload" required>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->