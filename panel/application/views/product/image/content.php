<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form data-url="<?= base_url("product/refresh_image_list/$product->id") ?>" action="<?= base_url("product/image_upload/$product->id") ?>" id="dropzone" class="dropzone" data-plugin="dropzone" data-options="{ url: '<?= base_url("product/image_upload/$product->id") ?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Yüklemek istediğiniz resimleri buraya sürükleyiniz</h3>
                        <p class="m-b-lg text-muted">(Yükleme için dosyalarınızı sürükleyiniz yada buraya tıklayınız)</p>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>

<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <strong><?= $product->title ?></strong> kaydına ait resimler
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body image_list_container">
                <?php $this->load->view("$viewFolder/$subViewFolder/render_elements/image_list"); ?>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>