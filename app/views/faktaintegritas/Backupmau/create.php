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
                        <input type="text" class="form-control" placeholder="masukkan Alamat..." name="alamat">
                    </div>
                    <div class="form-group">
                        <label>Hari</label>
                        <input type="date" class="form-control" placeholder="masukkan Hari..." name="hari">
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="number" class="form-control" placeholder="masukkan Nomor Telepon..." name="nomor_telepon">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Berangkat</label>
                        <input type="date" class="form-control" placeholder="masukkan Tanggal Berangkat..." name="tanggal_berangkat">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pulang</label>
                        <input type="date" class="form-control" placeholder="masukkan Tanggal Pulang..." name="tanggal_pulang">
                    </div>
                    <div class="form-group">
                        <label>Tempat Tujuan</label>
                        <input type="text" class="form-control" placeholder="masukkan Tempat Tujuan..." name="tempat_tujuan">
                    </div>
                    <div class="form-group">
                        <label>File Upload</label>
                        <input type="file" class="form-control" placeholder="masukkan Upload Berkas SPPD..." name="fileupload">
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