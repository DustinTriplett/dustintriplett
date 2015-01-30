jQuery(document).ready(function(){

	var $sidebar = jQuery('#sidebarDiv').height();
	var $maindiv = jQuery('#mainDiv_content').height();
	if ($sidebar > $maindiv) {
    jQuery('#mainDiv_content').css({'height': $sidebar});
	}

	var $recent = jQuery('div.widget div.recent');
	var $popular = jQuery('div.widget div.popular');
	var $random = jQuery('div.widget div.random');

	$recent.css("display","none");
	$random.css("display","none");

	jQuery('.tablinks ul li a').click(function(){
		jQuery('.tablinks ul li a.current').removeClass("current");
		jQuery(this).addClass("current");
	});

	jQuery('div.tablinks a.rec').click(function(){
		$recent.hide();
		$popular.hide();
		$random.hide();
		$recent.fadeIn('slow');
	});
	jQuery('div.tablinks a.pop').click(function(){
		$recent.hide();
		$popular.hide();
		$random.hide();
		$popular.fadeIn('slow');
	});
	jQuery('div.tablinks a.ran').click(function(){
		$recent.hide();
		$popular.hide();
		$random.hide();
		$random.fadeIn('slow');
	});

});