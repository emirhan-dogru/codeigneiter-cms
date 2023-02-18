$(document).ready(() => {
  $(".news-type-select").on("change", () => {
    if ($(".news-type-select").val() === "image") {
      $(".video-content").hide();
      $(".image-content").fadeIn();
    } else if ($(".news-type-select").val() === "video") {
      $(".image-content").hide();
      $(".video-content").fadeIn();
    }
  });
});
