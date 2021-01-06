$(document).ready(function() {
	var page_link = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
	$("#mySidenav a").each(function() {
		if ($(this).attr("href") == page_link)
			//$(this).css({'background-color':'#0f2f54'});
			$(this).css({
				'background-color': '#0f2f54',
				'border-left': '5px solid #FF8C00',
				'color': 'white'
			});
	});
	$("#mySidenav").css({
		'left': '0px',
		'transition': 'none'
	});
	$("#main").css({'margin-left': '250px',
					'transition': 'none'	
	});

});