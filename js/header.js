var currentMenu = null;
function dropdown(anOption){
	if (currentMenu != anOption || $('#' + anOption + '_li').hasClass('open') == false){
		currentMenu = anOption;
		$('#' + anOption).click();
		$('#' + anOption + '_menu').css('opacity', 0).fadeTo(700, 1.0);
	}
}

function dropdownSinMenu(anOption){
	if (currentMenu != anOption || $('#' + anOption + '_li').hasClass('open') == false){
		$('#' + currentMenu + '_li').removeClass('open');
		currentMenu = anOption;
		//$('#' + anOption).click();

		$('#' + anOption + '_li').addClass('open');
		$('#' + anOption + '_menu').css('opacity', 0).fadeTo(700, 1.0);
	}
}

function navegar(unaUrl){
	location.href = unaUrl;
}