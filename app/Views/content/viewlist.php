<?= $this->extend('templates/header'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">

            Daftar Kegiatan : <br>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nomor Kegiatan</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    <?php foreach ($list as $t) : ?>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            <?= $t['idkegiatan']; ?>
                        </th>
                        <td>
                            <?= $t['kegiatan']; ?>
                        </td>
                        <td>
                            <?= $t['status']; ?>
                        </td>
                        <td>
                            <a href="/home/edit/<?= $t['idkegiatan']; ?>">selesai</a>
                            <a href="/home/delete/<?= $t['idkegiatan']; ?>">hapus</a>
                        </td>

                    </tr>
                </tbody>
            <?php endforeach; ?>
            </table>

        </div>
    </div>
</div>
<?= $this->endsection(); ?>