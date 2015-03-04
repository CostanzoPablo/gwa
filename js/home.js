var currentMenu = null;
function dropdown(anOption){
	if (currentMenu != anOption || $('#' + anOption + '_li').hasClass('open') == false){
		currentMenu = anOption;
		$('#' + anOption).click();
		$('#' + anOption + '_menu').css('opacity', 0).fadeTo(700, 1.0);
	}
}