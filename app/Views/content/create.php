<?= $this->extend('templates/header'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2>APLIKASI TO-DO LIST</h2>
            Masukkan Kegiatan : <br>
            <form action="/home/save" method="post">
                <input name="kegiatan" type="text" style="width: 23%;" placeholder="Mohon masukkan kegiatan anda!">
                <input name="tombol" type="submit" value="Tambahkan"><br><br>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>