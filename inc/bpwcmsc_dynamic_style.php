<?php
/**
 * Template allow back-end options to change colors on front.
 */
defined( 'ABSPATH' ) || exit;

if ( is_checkout() || defined('ICL_LANGUAGE_CODE') ) {
	$style = sanitize_text_field( get_option( 'boostpluigns_steps_style' ) );
	$bgactive = get_option('boostpluigns_color_active') ? sanitize_hex_color( get_option('boostpluigns_color_active') ) : sanitize_hex_color( '#2BA813' );
	$bgdisabled = get_option('boostpluigns_color_inactive') ? sanitize_hex_color( get_option('boostpluigns_color_inactive') ) : sanitize_hex_color( '#777777' );
	$bgdone = get_option('boostpluigns_color_completed') ? sanitize_hex_color( get_option('boostpluigns_color_completed') ) : sanitize_hex_color( '#2BA813' );
	$fontcolor = get_option('boostpluigns_color_font') ? sanitize_hex_color( get_option('boostpluigns_color_font') ) : sanitize_hex_color( '#2BA813' );
	$btncolor = get_option('boostpluigns_color_buttons') ? sanitize_hex_color( get_option('boostpluigns_color_buttons') ) : sanitize_hex_color( '#2BA813' );
	$btnfontcolor = get_option('boostpluigns_color_buttons_font') ? sanitize_hex_color( get_option('boostpluigns_color_buttons_font') ) : sanitize_hex_color( '#fff' );
	$inline_style = '';
	if ( 'style6' ==  $style ) { // bpwcmscstep6
		$inline_style = '#bpwcmscSteps .steps ul li.disabled .number { color:#ffffff; background:#ABABAB;}
			#bpwcmscSteps .steps ul li.disabled .checkmark { color:#ffffff; background-color:#ABABAB;}
			#bpwcmscSteps .steps ul li.disabled a { color: '.$fontcolor .';}
			#bpwcmscSteps .steps ul li.disabled:after,
			#bpwcmscSteps .steps ul li.disabled:before { display:none;}
			#bpwcmscSteps .steps ul li.current a { color: '.$fontcolor .'; }
			#bpwcmscSteps .steps ul li.done .number { color:#ffffff; background: '.$bgdone .'; font-size:0;}
			#bpwcmscSteps .steps ul li.done .checkmark { color:#ffffff; background-color: '.$bgdone .'; font-size:0;}
			#bpwcmscSteps .steps ul li.current .number { color:#ffffff; background: '.$bgactive .';}
			#bpwcmscSteps .steps ul li.current .checkmark { color:#ffffff; background-color: '.$bgactive .';}
			#bpwcmscSteps .steps ul li.done a { color: '.$fontcolor .';}
			#bpwcmscSteps .steps ul li.done .number img { display:block;}
			#bpwcmscSteps .steps ul li.done .checkmark img { display:block;}
			#bpwcmscSteps .steps ul li.done:after { background: '.$bgdone .';}
			#bpwcmscSteps .steps ul li.done:before { background: '.$bgdone .';}
			#bpwcmscSteps .steps ul li.current:before { background: '.$bgactive .';}
			#bpwcmscSteps .steps ul li.current:after { background: '.$bgactive .';}
			@media(max-width: 767px){
			    #bpwcmscSteps .steps ul{display: inline-block;}
			    #bpwcmscSteps > .steps > ul > li, .wizard.five-steps > .steps > ul > li{float: none;font-size: 14px;margin-left: 0;width: 100%;}
			    #bpwcmscSteps > .steps .actions.clearfix ul li{float: right;}
			    #bpwcmscSteps > .steps .actions.clearfix ul li:first-child{float: left;}
			    #bpwcmscSteps > .steps a,
			    #bpwcmscSteps > .steps a:hover,
			    #bpwcmscSteps > .steps a:active{text-align: left;}
			    #bpwcmscSteps .steps ul li a span.namebox{display: block;width: 100%;text-align: center;}
			    #bpwcmscSteps .steps ul li:before {display: none;}
			    #bpwcmscSteps .steps ul li:after{display: none;}
			    #bpwcmscSteps .steps ul li .number{margin:10px auto 0;}
			    #bpwcmscSteps.vertical > .steps,
			    #bpwcmscSteps.vertical > .content{width: 100%;margin: 0;padding: 0;clear:both;}
			    #bpwcmscSteps.vertical > .content{float:left;margin-bottom: 10px;}
			    #bpwcmscSteps.vertical .steps ul li .number{display: block;}
			}';
	} elseif ( 'style5' == $style ) { // bpwcmscstep5
		$inline_style = '#bpwcmscSteps .steps ul li.disabled .number { color:#ffffff; background: '.$bgdisabled .';}
			#bpwcmscSteps .steps ul li.disabled .checkmark { color:#ffffff; background-color: '.$bgdisabled .';}
			#bpwcmscSteps .steps ul li.disabled a { color: '.$fontcolor .';}
			#bpwcmscSteps .steps ul li.disabled:before { display:none;}
			#bpwcmscSteps .steps ul li.current a { color: '.$fontcolor .'; }
			#bpwcmscSteps .steps ul li.done .number { color:#ffffff; background: '.$bgdone .'; font-size:0;}
			#bpwcmscSteps .steps ul li.done .checkmark { color:#ffffff; background-color: '.$bgdone .'; font-size:0;}
			#bpwcmscSteps .steps ul li.current .number { color:#ffffff; background: '.$bgactive .';}
			#bpwcmscSteps .steps ul li.current .checkmark { color:#ffffff; background-color: '.$bgactive .';}
			#bpwcmscSteps .steps ul li.done a { color: '.$fontcolor .';}
			#bpwcmscSteps .steps ul li.done .imagebox{ display:block;}
			#bpwcmscSteps .steps ul li.done:before { display:block; background: '.$bgdone .';}
			#bpwcmscSteps .steps ul li.current:before { display:block; background: '.$bgactive .'; right:0%;}
			@media(max-width: 767px){
			    #bpwcmscSteps .steps ul{display: block;}
			    #bpwcmscSteps > .steps > ul > li, .wizard.five-steps > .steps > ul > li{float: none;font-size: 14px;margin-left: 0;width: 100%;}
			    #bpwcmscSteps > .steps .actions.clearfix ul li{float: right;}
			    #bpwcmscSteps > .steps .actions.clearfix ul li:first-child{float: left;}
			    #bpwcmscSteps > .steps a,
			    #bpwcmscSteps > .steps a:hover,
			    #bpwcmscSteps > .steps a:active{text-align: left;}
			    #bpwcmscSteps .steps ul li a span.namebox{display: block;width: 100%;text-align: center;}
			    #bpwcmscSteps .steps ul li .number:before {display: none;}
			    #bpwcmscSteps .steps ul li .number:after{display: none;}
			    #bpwcmscSteps.vertical > .steps,
			    #bpwcmscSteps.vertical > .content{width: 100%;margin: 0;padding: 0 20px 20px;clear:both;}
			    #bpwcmscSteps.vertical > .content{float:left;margin-bottom: 10px;}
			}';	
	} elseif ( 'style4' == $style ) { // bpwcmscstep4
		$bgdisabled = get_option('boostpluigns_color_inactive') ? sanitize_hex_color( get_option('boostpluigns_color_inactive') ) : sanitize_hex_color( '#ABABAB' );
		$inline_style = '#bpwcmscSteps .steps ul li.disabled .number { color:#ffffff; background: '.$bgdisabled .';}
			#bpwcmscSteps .steps ul li.disabled .checkmark { color:#ffffff; background-color: '.$bgdisabled .';}
			#bpwcmscSteps .steps ul li.disabled a { color: '.$fontcolor .';}
			#bpwcmscSteps .steps ul li.disabled .number:after,
			#bpwcmscSteps .steps ul li.disabled .number:before { display:none;}
			#bpwcmscSteps .steps ul li.current .number { color:#ffffff; background: '.$bgactive .';}
			#bpwcmscSteps .steps ul li.disabled .checkmark:after,
			#bpwcmscSteps .steps ul li.disabled .checkmark:before { display:none;}
			#bpwcmscSteps .steps ul li.current .checkmark { color:#ffffff; background-color: '.$bgactive .';}
			#bpwcmscSteps .steps ul li.current a { color: '.$fontcolor .'; }
			#bpwcmscSteps .steps ul li.done .number { color:#ffffff; background: '.$bgdone .'; font-size:0;}
			#bpwcmscSteps .steps ul li.done .checkmark { color:#ffffff; background-color: '.$bgdone .'; font-size:0;}
			#bpwcmscSteps .steps ul li.done a { color: '.$fontcolor .';}
			#bpwcmscSteps .steps ul li.done .number img { display:block;}
			#bpwcmscSteps .steps ul li.done .checkmark img { display:block;}
			#bpwcmscSteps .steps ul li.done .number:after { background: '.$bgdone .';}
			#bpwcmscSteps .steps ul li.done .number:before { background: '.$bgdone .';}
			#bpwcmscSteps .steps ul li.current .number:before { background: '.$bgactive .';}
			#bpwcmscSteps .steps ul li.current .number:after { background: '.$bgactive .';}
			#bpwcmscSteps .steps ul li.current .number { color:#ffffff; background: '.$bgactive .';}
			#bpwcmscSteps .steps ul li.done .checkmark:after { background: '.$bgdone .';}
			#bpwcmscSteps .steps ul li.done .checkmark:before { background: '.$bgdone .';}
			#bpwcmscSteps .steps ul li.current .checkmark:before { background: '.$bgactive .';}
			#bpwcmscSteps .steps ul li.current .checkmark:after { background: '.$bgactive .';}
			#bpwcmscSteps .steps ul li.current .checkmark { color:#ffffff; background-color: '.$bgactive .';}
			@media(max-width: 767px){
			    #bpwcmscSteps .steps ul{display: block;}
			    #bpwcmscSteps > .steps > ul > li, .wizard.five-steps > .steps > ul > li{float: none;font-size: 14px;margin-left: 0;width: 100%;}
			    #bpwcmscSteps > .steps .actions.clearfix ul li{float: right;}
			    #bpwcmscSteps > .steps .actions.clearfix ul li:first-child{float: left;}
			    #bpwcmscSteps > .steps a,
			    #bpwcmscSteps > .steps a:hover,
			    #bpwcmscSteps > .steps a:active{text-align: left;}
			    #bpwcmscSteps .steps ul li a span.namebox{display: block;width: 100%;text-align: center;}
			    #bpwcmscSteps .steps ul li .number:before {display: none;}
			    #bpwcmscSteps .steps ul li .number:after{display: none !important;}
			    #bpwcmscSteps.vertical > .steps,
			    #bpwcmscSteps.vertical > .content{width: 100%;margin: 0;padding: 0;clear:both;}
			    #bpwcmscSteps.vertical > .content{float:left;margin-bottom: 10px;}
			    #bpwcmscSteps.vertical .steps ul li .number{display: block;}
			}';		
	} elseif ( 'style3' == $style ) { // bpwcmscstep3
		$bgdisabled = get_option('boostpluigns_color_inactive') ? sanitize_hex_color( get_option('boostpluigns_color_inactive') ) : sanitize_hex_color( '#ABABAB' );
		$fontdis = get_option('boostpluigns_color_font') ? sanitize_hex_color( get_option('boostpluigns_color_font') ) : sanitize_hex_color( '#777777' );
		$inline_style = '#bpwcmscSteps .steps ul li.disabled .number { color:#ffffff; background: '.$bgdisabled.';}
			#bpwcmscSteps .steps ul li.disabled .checkmark { color:#ffffff; background-color: '.$bgdisabled.';}
            #bpwcmscSteps .steps ul li.disabled a { color: '.$fontdis.';}
            #bpwcmscSteps .steps ul li.current a { color: '.$fontcolor.'; }
            #bpwcmscSteps .steps ul li.done .number { color:#ffffff; background: '.$bgdone.'; font-size:0;}
            #bpwcmscSteps .steps ul li.done .checkmark { color:#ffffff; background-color: '.$bgdone.'; font-size:0;}
	    	#bpwcmscSteps .steps ul li.current .number { color:#ffffff; background: '.$bgactive.';}
	    	#bpwcmscSteps .steps ul li.current .checkmark { color:#ffffff; background-color: '.$bgactive.';}
            #bpwcmscSteps .steps ul li.done a { color: '.$fontcolor.'; }
			@media(max-width: 991px){
			    #bpwcmscSteps .steps ul li a { height:90px;}
			}
			@media(max-width: 767px){
			    #bpwcmscSteps .steps ul{display: block;}
			    #bpwcmscSteps > .steps > ul > li, .wizard.five-steps > .steps > ul > li{float: none;font-size: 14px;margin-left: 0;width: 100%;}
			    #bpwcmscSteps > .steps .actions.clearfix ul li{float: right;}
			    #bpwcmscSteps > .steps .actions.clearfix ul li:first-child{float: left;}
			    #bpwcmscSteps > .steps a,
			    #bpwcmscSteps > .steps a:hover,
			    #bpwcmscSteps > .steps a:active{text-align: left;}
			    #bpwcmscSteps .steps ul li a span.namebox{display: block;width: 100%;text-align: left;margin-left: 20px;}
			    #bpwcmscSteps .steps ul li .number { margin:0px auto;}
				#bpwcmscSteps .steps ul li a { height:60px;display:flex;padding: 10px;text-align: left;}
			    #bpwcmscSteps.vertical > .steps,
			    #bpwcmscSteps.vertical > .content{width: 100%;margin: 0;padding: 0;clear:both;}
			    #bpwcmscSteps.vertical > .content{float:left;margin-bottom: 10px;}
			    #bpwcmscSteps.vertical .steps ul li .number {margin: 0px 10px 5px auto;}
			    #bpwcmscSteps.vertical .steps ul li a:before {display: none;}
			    #bpwcmscSteps.vertical .steps ul li a span.namebox{display: inline;}
			}';		
	} elseif ( 'style2' == $style ) { // bpwcmscstep2
		$bgdisabled = get_option('boostpluigns_color_inactive') ? sanitize_hex_color( get_option('boostpluigns_color_inactive') ) : sanitize_hex_color( '#999999' );
		$fontcolor = get_option('boostpluigns_color_font') ? sanitize_hex_color( get_option('boostpluigns_color_font') ) : sanitize_hex_color( '#ffffff' );
		$fontdis = get_option('boostpluigns_color_font') ? sanitize_hex_color( get_option('boostpluigns_color_font') ) : sanitize_hex_color( '#777777' );
		$bgnum = get_option('boostpluigns_color_number') ? sanitize_hex_color( get_option('boostpluigns_color_number') ) : sanitize_hex_color( '#1E7E0B' );
		
		$inline_style = '#bpwcmscSteps .steps ul li.disabled .number { color:#ffffff; background: '.$bgnum.';}
			#bpwcmscSteps .steps ul li.disabled a { color: '.$fontdis.'; background: '.$bgdisabled.';}
			#bpwcmscSteps .steps ul li.disabled a:before { border-color:transparent transparent transparent #fff;}
			#bpwcmscSteps .steps ul li.disabled a:after { border-color: transparent transparent transparent  '.$bgdisabled.';}
			#bpwcmscSteps .steps ul li.current .number { color:#ffffff; background: '.$bgnum.';}
			#bpwcmscSteps .steps ul li.done .number { color:#ffffff; background: '.$bgnum.';}
			#bpwcmscSteps .steps ul li.done a { color: '.$fontcolor.'; background: '.$bgdone.';}
			#bpwcmscSteps .steps ul li.done a:before { border-color:transparent transparent transparent #fff;}
			#bpwcmscSteps .steps ul li.done a:after { border-color: transparent transparent transparent  '.$bgdone.';}
			#bpwcmscSteps .steps ul li.current a { color: '.$fontcolor.'; background: '.$bgactive.';}
			#bpwcmscSteps .steps ul li.current a:before { border-color:transparent transparent transparent #fff;}
			#bpwcmscSteps .steps ul li.current a:after { border-color: transparent transparent transparent  '.$bgactive.';}
			@media(max-width: 767px){
			    #bpwcmscSteps .steps ul{display: block;}
			    #bpwcmscSteps > .steps > ul > li, .wizard.five-steps > .steps > ul > li{float: none;font-size: 14px;margin-left: 0;width: 100%;}
			    #bpwcmscSteps > .steps .actions.clearfix ul li{float: right;}
			    #bpwcmscSteps > .steps .actions.clearfix ul li:first-child{float: left;}
			    #bpwcmscSteps > .steps a,
			    #bpwcmscSteps > .steps a:hover,
			    #bpwcmscSteps > .steps a:active{text-align: left;}
			    #bpwcmscSteps .steps ul li a span.namebox{display: block;width: 100%;}
			    #bpwcmscSteps .steps ul li a:before{display:none;}
			    #bpwcmscSteps .steps ul li.first a, #bpwcmscSteps .steps ul li:first-child a{padding-left:30px;}
			    #bpwcmscSteps.vertical > .steps,
			    #bpwcmscSteps.vertical > .content{width: 100%;margin: 0;padding: 0;clear:both;}
			    #bpwcmscSteps.vertical > .content{float:left;margin-bottom: 10px;}
			    #bpwcmscSteps.vertical .steps ul li.first a:before,
				#bpwcmscSteps.vertical .steps ul li:first-child a:before { display:none;}';
	} else { // bpwcmscstep1
		$inline_style = '#bpwcmscSteps .steps ul li.disabled .number { color:#ffffff; background:'.$bgdisabled.';}
			#bpwcmscSteps .steps ul li.disabled .checkmark { color:#ffffff; background-color:'.$bgdisabled.';}
			#bpwcmscSteps .steps ul li.disabled a { color:'.$fontcolor.'; }
			#bpwcmscSteps .steps ul li.disabled a:before { background:#777777;}
			#bpwcmscSteps .steps ul li.current a { color:'.$fontcolor.';}
			#bpwcmscSteps .steps ul li.done .number { color:#ffffff; background:'.$bgdone.';}
			#bpwcmscSteps .steps ul li.done .checkmark { color:#ffffff; background-color:'.$bgdone.';}
			#bpwcmscSteps .steps ul li.current .number { color:#ffffff; background:'.$bgactive.';}
			#bpwcmscSteps .steps ul li.current .checkmark{color:#ffffff; background-color:'.$bgactive.';}
			#bpwcmscSteps .steps ul li.done a { color:'.$fontcolor.';}
			#bpwcmscSteps .steps ul li.done a:before { background:'.$bgdone.';}
			#bpwcmscSteps .steps ul li.current a:before { background: '.$bgactive.';}
			@media(max-width: 767px){
			    #bpwcmscSteps > .steps > ul > li, .wizard.five-steps > .steps > ul > li{float: none;font-size: 14px;margin-left: 0;width: 100%;}
			    #bpwcmscSteps > .steps .actions.clearfix ul li{float: right;}
			    #bpwcmscSteps > .steps .actions.clearfix ul li:first-child{float: left;}
			    #bpwcmscSteps > .steps a,
			    #bpwcmscSteps > .steps a:hover,
			    #bpwcmscSteps > .steps a:active{text-align: left;}
			    #bpwcmscSteps .steps ul li a span.namebox{display: block;width: 100%;text-align: center;}
			    #bpwcmscSteps.vertical > .steps,
			    #bpwcmscSteps.vertical > .content{width: 100%;margin: 0;padding: 0;clear:both;}
			    #bpwcmscSteps.vertical > .content{float:left;margin-bottom: 10px;}
			    #bpwcmscSteps.vertical .steps ul li .number {margin: 0px 10px 5px auto;}
			    #bpwcmscSteps.vertical .steps ul li a:before {display: none;}
			    #bpwcmscSteps.vertical .steps ul li a span.namebox{display: inline;}
			}';
	}
	
	// <!-- Button color common to all style -->

	$inline_style .= '#bpwcmscSteps > .actions a, #bpwcmscSteps > .actions a:hover, #bpwcmscSteps > .actions a:active,
	#bpwcmscSteps form.login input.button, #bpwcmscSteps form.register input.button { background: '.$btncolor.'; color: '.$btnfontcolor.'; }
	button#bpwcmsc-register, button#bpwcmsc-login { background: '.$btncolor.'; color: '.$btnfontcolor.'; }';

	wp_add_inline_style( 'jquery-steps', $inline_style );

}
