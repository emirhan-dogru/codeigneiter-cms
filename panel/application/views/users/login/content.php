<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="index.html">
            <span><i class="fa fa-gg"></i></span>
            <span>CMS</span>
        </a>
    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="login-form">
        <h4 class="form-title m-b-xl text-center">Yönetim Paneli - Giriş Yap</h4>
        <form action="<?= base_url('auth/do_login') ?>" method="post">
            <div class="form-group">
                <input id="sign-in-email" type="email" class="form-control" placeholder="Email Adresi" name="email">
                <small class="input-form-error"><?= form_error('email') ?></small>
            </div>

            <div class="form-group">
                <input id="sign-in-password" type="password" class="form-control" placeholder="Parola" name="password">
                <small class="input-form-error"><?= form_error('password') ?></small>
            </div>

            <input type="submit" class="btn btn-primary" value="Giriş Yap">
        </form>
    </div><!-- #login-form -->

    <div class="simple-page-footer">
        <p><a href="password-forget.html">Şifremi Unuttum ?</a></p>
    </div><!-- .simple-page-footer -->


</div>