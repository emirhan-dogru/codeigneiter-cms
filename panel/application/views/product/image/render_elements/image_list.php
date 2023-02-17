<?php if (empty($product_images)) { ?>
    <div class="alert alert-info text-center">
        <p>Burada herhangi bir resim bulunmamaktadır.</p>
    </div>
<?php } else { ?>
    <table class="table table-bordered table-striped table-hover pictures-list">
        <thead>
            <th><i class="fa fa-reorder"></i></th>
            <th class="w50">#id</th>
            <th>Görsel</th>
            <th>Adı</th>
            <th>Durumu</th>
            <th>Kapak</th>
            <th>İşlem</th>

        </thead>
        <tbody class="sortable" data-url="<?= base_url('product/imageRankSetter'); ?>">
            <?php foreach ($product_images as $product_image) { ?>
                <tr id="order-<?= $product_image->id ?>">
                    <td class="order"><i class="fa fa-reorder"></i></td>
                    <td class="w100 text-center">#<?= $product_image->id ?></td>
                    <td class="w100 text-center">
                        <img width="50" src="<?= base_url("uploads/$viewFolder/$product_image->img_url") ?>" alt="<?= $product_image->img_url ?>">
                    </td>
                    <td><?= $product_image->img_url ?></td>
                    <td class="w100 text-center">
                        <input class="isActive" data-url="<?= base_url("product/imageisActiveSetter/$product_image->id") ?>" type="checkbox" data-switchery data-color="#10c469" <?= $product_image->isActive ? 'checked' : '' ?> />
                    </td>
                    <td class="w100 text-center">
                        <input class="isCover" data-url="<?= base_url("product/isCoverSetter/$product_image->id/$product_image->product_id") ?>" type="checkbox" data-switchery data-color="#ff5b5b" <?= $product_image->isCover ? 'checked' : '' ?> />
                    </td>
                    <td class="w100 text-center">
                        <button data-url="<?= base_url("product/imageDelete/$product_image->id/$product_image->product_id") ?>" class="btn btn-sm btn-danger btn-remove"><i class="fa fa-remove"></i> Sil</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>