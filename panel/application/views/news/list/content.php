<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Haber Listesi
            <a href="<?= base_url('news/new_form') ?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">

            <?php if (empty($newsData)) { ?>
                <div class="alert alert-info text-center">
                    <p>Burada herhangi bir veri bulunamadı. Eklemek için lütfen <a href="<?= base_url('news/new_form') ?>">tıklayınız</a></p>
                </div>
            <?php } else { ?>

                <table class="table table-hover table-bordered table-striped content-container">
                    <thead>
                        <th><i class="fa fa-reorder"></i></th>
                        <th class="w50">#id</th>
                        <th>url </th>
                        <th>Başlık</th>
                        <th>Açıklama</th>
                        <th>Haber Türü</th>
                        <th>Görsel</th>
                        <th>Durumu</th>
                        <td>İşlem</td>
                    </thead>
                    <tbody class="sortable" data-url="<?= base_url('news/rankSetter'); ?>">
                        <?php foreach ($newsData as $news) { ?>
                            <tr id="order-<?= $news->id ?>">
                                <td class="order"><i class="fa fa-reorder"></i></td>
                                <td>#<?= $news->id ?></td>
                                <td><?= $news->url ?></td>
                                <td><?= $news->title ?></td>
                                <td><?= $news->description ?></td>
                                <td><?= $news->news_type ?></td>
                                <td>Görsel alanı</td>
                                <td>
                                    <input class="isActive" data-url="<?= base_url("news/isActiveSetter/$news->id") ?>" type="checkbox" data-switchery data-color="#10c469" <?= $news->isActive ? 'checked' : '' ?> />
                                </td>
                                <td>
                                    <button data-url="<?= base_url("news/delete/$news->id") ?>" class="btn btn-sm btn-danger btn-remove"><i class="fa fa-remove"></i> Sil</button>
                                    <a href="<?= base_url("news/update_form/$news->id") ?>" class="btn btn-info btn-sm btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>