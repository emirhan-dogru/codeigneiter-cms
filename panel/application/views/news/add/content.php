<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Haber Ekle
            <a href="#" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?= base_url("news/save") ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Başlık</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Başlık" name="title">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Haber Türü</label>
                        <select name="news_type" class="form-control news-type-select">
                            <option value="image">Resim</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
                    <div class="form-group image-content">
                        <label for="exampleInputEmail1">Resim Seçiniz</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" placeholder="Resim Seçiniz" name="img_url">
                    </div>
                    <div class="form-group video-content">
                        <label for="exampleInputEmail1">Video Url</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Video linkini buraya giriniz." name="video_url">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("video_url"); ?></small>
                        <?php } ?>
                    </div>
            </div>

            <button type="submit" class="btn btn-primary btn-md">Kaydet</button>
            <a href="<?= base_url("news") ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
            </form>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->
</div>