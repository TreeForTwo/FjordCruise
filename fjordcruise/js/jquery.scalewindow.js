function ResizeTitle() {
	var mintitlewidth = 350
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

function ScaleContent() {
	var newwidth = $(window).width();
	var wrapwidth = Math.max( $(window).width() * 0.15 + 600, 700 )
	$("#contentwrap").width(wrapwidth);
	$("#content").width( wrapwidth ); 

	/* Just do the background resizing here */
	var background = $("#backgroundgradient");
	var backgroundheight = Math.min( $(window).height(), 600 );
	background.height(backgroundheight);
}

function ScaleIndex() {
	if ( $("#indeximage") ) {
		$("#indeximage img").width( $("nav").width() );
		$("#indeximage img").height( $(window).height() );
		$("#indeximage").width( $("nav").width() );
		$("#indeximage").height( $(window).height() );

		$("#indextext").css("left", ( $("nav").width() - $("#indextext").width() ) / 2 );
	}
}