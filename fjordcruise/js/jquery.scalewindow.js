function ResizeTitle() {
      var newwidth = $(window).width();
      var titlewidth = newwidth - $("#titleleft").width() - $("#titleright").width();
      $("#titlewrapper").width(newwidth);
      $("#titlecenter").width(titlewidth);
}