<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Ürün Listesi
            <a href="<?= base_url('product/new_form') ?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget p-lg">

            <?php if (empty($products)) { ?>
                <div class="alert alert-info text-center">
                    <p>Burada herhangi bir veri bulunamadı. Eklemek için lütfen <a href="<?= base_url('product/new_form') ?>">tıklayınız</a></p>
                </div>
            <?php } else { ?>

                <table class="table table-hover table-bordered table-striped content-container">
                    <thead>
                        <th><i class="fa fa-reorder"></i></th>
                        <th class="w50">#id</th>
                        <th>url </th>
                        <th>Başlık</th>
                        <th>Açıklama</th>
                        <th>Durumu</th>
                        <td>İşlem</td>
                    </thead>
                    <tbody class="sortable" data-url="<?= base_url('product/rankSetter'); ?>">
                        <?php foreach ($products as $product) { ?>
                            <tr id="order-<?= $product->id ?>">
                                <td class="order"><i class="fa fa-reorder"></i></td>
                                <td>#<?= $product->id ?></td>
                                <td><?= $product->url ?></td>
                                <td><?= $product->title ?></td>
                                <td><?= $product->description ?></td>
                                <td>
                                    <input class="isActive" data-url="<?= base_url("product/isActiveSetter/$product->id") ?>" type="checkbox" data-switchery data-color="#10c469" <?= $product->isActive ? 'checked' : '' ?> />
                                </td>
                                <td>
                                    <button data-url="<?= base_url("product/delete/$product->id") ?>" class="btn btn-sm btn-danger btn-remove"><i class="fa fa-remove"></i> Sil</button>
                                    <a href="<?= base_url("product/update_form/$product->id") ?>" class="btn btn-info btn-sm btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <a href="<?= base_url("product/image_form/$product->id") ?>" class="btn btn-success btn-sm"><i class="fa fa-image"></i> Resimler</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>