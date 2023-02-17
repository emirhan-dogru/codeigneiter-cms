$(document).ready(function () {
  // remove button işlemleri
  $(".content-container , .image_list_container").on(
    "click",
    ".btn-remove",
    function () {
      const data_url = $(this).data("url");
      Swal.fire({
        title: "Emin misiniz?",
        text: "Bu işlemi geri alamayacaksınız!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sil",
        cancelButtonText: "İptal",
      }).then((result) => {
        if (result.isConfirmed) {
          //Swal.fire("Deleted!", "Your file has been deleted.", "success");
          window.location.href = data_url;
        }
      });
    }
  );

  //switchery aktif udumunu değiştirme
  $(".content-container , .image_list_container").on(
    "change",
    ".isActive",
    function () {
      const data = $(this).prop("checked");
      const data_url = $(this).data("url");

      if (typeof data != "undefined" && typeof data_url != "undefined") {
        $.post(data_url, { data: data }, (res) => {});
      }
    }
  );

  $(".image_list_container").on("change", ".isCover", function () {
    const data = $(this).prop("checked");
    const data_url = $(this).data("url");

    if (typeof data != "undefined" && typeof data_url != "undefined") {
      $.post(data_url, { data: data }, (res) => {
        $(".image_list_container").html(res);

        $("[data-switchery]").each(function () {
          var $this = $(this),
            color = $this.attr("data-color") || "#188ae2",
            jackColor = $this.attr("data-jackColor") || "#ffffff",
            size = $this.attr("data-size") || "default";

          new Switchery(this, {
            color: color,
            size: size,
            jackColor: jackColor,
          });
        });

        $(".sortable").sortable();
      });
    }
  });

  //ürünlerin sırasını değiştirme işlemi
  $(".sortable").sortable();
  $(".content-container , .image_list_container").on(
    "sortupdate",
    ".sortable",
    function (event, ui) {
      const data = $(this).sortable("serialize");
      const data_url = $(this).data("url");

      $.post(data_url, { data }, (res) => {});
    }
  );

  //dropzone sayfa yenilemeden resimlerin tabloda gösterilmesi
  const uploadSection = Dropzone.forElement("#dropzone");
  uploadSection.on("complete", function (file) {
    const data_url = $("#dropzone").data("url");
    $.post(data_url, {}, (res) => {
      $(".image_list_container").html(res);

      $("[data-switchery]").each(function () {
        var $this = $(this),
          color = $this.attr("data-color") || "#188ae2",
          jackColor = $this.attr("data-jackColor") || "#ffffff",
          size = $this.attr("data-size") || "default";

        new Switchery(this, {
          color: color,
          size: size,
          jackColor: jackColor,
        });
      });

      $(".sortable").sortable();
    });
  });
});
