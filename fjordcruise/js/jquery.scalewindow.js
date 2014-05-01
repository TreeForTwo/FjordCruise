function ResizeTitle() {
      var newwidth = $(window).width();
      var titlewidth = newwidth - $("#titleleft").width() - $("#titleright").width();
      $("#titlewrapper").width(newwidth);
      $("#titlecenter").width(titlewidth);
}

function CenterNav() {
	var newmargin = ( $(window).width() - $("#navwrap ul").width() ) / 2;
	$("#navwrap ul").css("margin-left", newmargin + 'px');
}