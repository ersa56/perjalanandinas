<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman Jabatan</h1>
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
            <form role="form" action="<?= base_url; ?>/jabatan/updateJabatan" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['tb_jabatan']['id']; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Jabatan</label>
                        <input type="text" class="form-control" placeholder="masukkan Nama Jabatan..." name="nama_jabatan" value="<?= $data['tb_jabatan']['nama_jabatan']; ?>">
                        <label>Tanggung Jawab</label>
                        <input type="text" class="form-control" placeholder="masukkan gugus jabatan..." name="tanggung_jawab" value="<?= $data['tb_jabatan']['tanggung_jawab']; ?>">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control" placeholder="masukkan nama jabatan..." name="deskripsi" value="<?= $data['tb_jabatan']['deskripsi']; ?>">
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