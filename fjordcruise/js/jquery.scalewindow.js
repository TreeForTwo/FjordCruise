function ResizeTitle() {
	var mintitlewidth = 450
      var newwidth = $(window).width(); 
      var titlewidth = Math.max( newwidth - $("#titleleft").width() - $("#titleright").width(), mintitlewidth);
      newwidth = Math.max( newwidth, titlewidth + $("#titleleft").width() + $("#titleright").width() );
      $("#titlewrap").width(newwidth);
      $("#titlecenter").width(titlewidth);
}

function CenterNav() {
	var newwidth = Math.max( $(window).width(), $("#titlewrap").width() );
	var newmargin = ( newwidth - $("#navwrap ul").width() ) / 2;
	$("#navwrap ul").css("margin-left", newmargin + 'px');
	$("#navwrap").width(newwidth);
}