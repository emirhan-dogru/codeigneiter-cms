<?php

$alert = $this->session->userdata("alert");

if ($alert) {
    if ($alert['type'] == 'success') { ?>
        <script>
            iziToast.success({
                message: '<?= $alert['text'] ?>',
                position: 'topCenter'
            });
        </script>
    <?php } else { ?>
        <script>
            iziToast.error({
                message: '<?= $alert['text'] ?>',
                position: 'topCenter'
            });
        </script>
<?php  }
}

?>