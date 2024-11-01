/**
 * WooCommerce Mustistep Checkout by BoostPlugins
 */
(function($){

    "use strict";

    $(window).load(function(){
        $(".bpwcmscPageLoader").fadeOut("slow");
    });

    $(document).ready(function($) {
        
    	$("#content div.tab-pane").css("display","none");
        $("#myTab li:first-child").addClass("current");
        $("#myTab li:first-child").removeClass("disabled");
        $("#myTab li:first-child").addClass("traversed done");
        $("#myTab li:last-child").addClass("last");
        $("#content div.tab-pane:first-child").addClass("current");
        $("#content div.current").css("display", "block");
        $("#content div.tab-pane:first-child").addClass("traversed done");
        $("#content div.tab-pane:last-child").addClass("last");

        $("form.checkout .validate-required").addClass("bpwcmsc-validate-required");

        if( $(".horizontal").length > 0 ){
        	var li = $("ul#myTab li").length;
	        $("ul#myTab li").attr("style","width: "+100/li+"%");
	        if($("div#login-step").length < 1 && $("div#coupon-step").length < 1) {
	        	$("form.checkout").css("display","block");
	        }
        }

        manipulateActions();

        $("#myTab li a").click(function(e){
        	e.preventDefault();
        	
        	var clickedIndex = $(this).parent().index(); 
        	var currentIndex = getCurrentIndex();
        	if(clickedIndex < currentIndex || $(this).parent().hasClass("traversed")) {
        		$("#myTab li").removeClass("current");
	        	$("#content div.tab-pane").removeClass("current");
	        	$(this).parent().addClass("current");
	        	$("#content div.tab-pane").eq(clickedIndex).addClass("current");
	        	if( $("#content div.current").attr("id") == "order-step" ) {
                    drawReviewTable();
                    setCustomerDetailsReview();
                }
                manipulateActions();
        	} else {
        		return false;
        	}        	
        });
        $("#skip, #next").on("click", function(e){
        	e.preventDefault();

        	var $curTab = $("ul#myTab li.current");
        	var $curContent = $("#content div.current");

        	// Check if current step is review order step
        	// console.log($curContent.attr("id"));
        	// console.log();
        	if( $curContent.attr("id") == "order-step" ) {
        		drawReviewTable();
        		setCustomerDetailsReview();
        	}

        	// Validation        
            // console.log(validateCheckoutFields()); 	
    		if( ! validateCheckoutFields() ) {
    			
    			if ( ! $("#ship-to-different-address-checkbox").is(":visible") || ( $("#ship-to-different-address-checkbox").is(":visible") && $("#ship-to-different-address-checkbox").is(":checked") ) ) {
    				$curTab.addClass("error");
        			$curContent.addClass("error");
        			scrollToTop();
    				return false;
    			} else {
    				$curTab.removeClass("error");
        			$curContent.removeClass("error");
        			scrollToTop();
    				return true;
    			}
    		} else {
    			$curTab.removeClass("error");
    			$curContent.removeClass("error");
    			scrollToTop();
    		}
        	
        	// If validation success allow step change        	
        	
        	$curTab.next().removeClass("disabled");
        	$curContent.next().removeClass("disabled");

        	$curTab.next().addClass("current traversed done");
        	$curContent.next().addClass("current traversed done");

        	$curTab.removeClass("current");
        	$curContent.removeClass("current");
        	
        	manipulateActions();
        	scrollToTop();
        });

        $("#prev").click(function(e) {
        	e.preventDefault();

        	var $curTab = $("ul#myTab li.current");
        	var $curContent = $("#content div.current");        	

        	$curTab.prev().addClass("current");
        	$curContent.prev().addClass("current");

        	$curTab.removeClass("current");
        	$curContent.removeClass("current");

        	manipulateActions();
        	scrollToTop();
        });

        $("#last").click(function(e){
        	e.preventDefault();
        	$("#place_order").trigger("click");
        });

        // Login form
        $(".woocommerce-form-login").on("submit",function(e){
        	e.preventDefault();
        	if($("#user_pass_required").length > 0){
        		$("#user_pass_required").remove();
        		$("#username, #password").removeClass("error-field");
        	}
        	if(validateLoginFields() !== "invalid"){
                $(".bpwcmscPageLoader").show();
        		var user = $("#username").val(),
        		password = $("#password").val(),
        		remember = $("#rememberme").is(":checked"),
        		security = bpwcmsc_steps.bpwcmsc_login_nonce,
        		ajaxurl = bpwcmsc_steps.ajaxurl;

        		$.ajax({        			
        			type: "POST",
        			url: ajaxurl,
        			data: {
        				action: "boostpluigns_login",
        				user: user,
        				password: password,
        				remember: remember,
        				security: security
        			},
        			success: function(response){
                        $(".bpwcmscPageLoader").hide();
        				var err;
        				switch(response) {
        					case "success" : 
        						location.reload();
    							break;
							case "Logged" : 
								err = '<label id="user_pass_required" class="error-label">User already logged-in.</label>';
								$(err).prependTo("form.login");
							break;
							case "User required" : 
								err = '<label id="user_pass_required" class="error-label">Username/Password required</label>';
								$(err).prependTo("form.login");
							break;
							case "password required" : 
								err = '<label id="user_pass_required" class="error-label">Username/Password required</label>';
								$(err).prependTo("form.login");
							break;
							case "error" : 
								err = '<label id="user_pass_required" class="error-label">Incorrect username/password.</label>';
								$(err).prependTo("form.login");
							break;
        				}
        			},
        			error: function(response){
        				alert(response);
        			}
        		});
        	}
        });

        // User Registration
        $(".register").on("submit", function(e){
        	e.preventDefault();

        	if($("#reg_user_pass_required").length > 0){
        		$("#reg_user_pass_required").remove();
        		$("#reg_email, #reg_password").removeClass("error-field");
        	}

        	if(validateRegisterFields() !== "invalid") {
                $(".bpwcmscPageLoader").show();                
        		var email = $("#reg_email").val(),
        		password = $("#reg_password").val(),
        		security = bpwcmsc_steps.bpwcmsc_register_nonce,
        		ajaxurl = bpwcmsc_steps.ajaxurl;

        		$.ajax({
	        		type: "POST",
	        		url: ajaxurl,
	        		data: {
	        			action: "boostpluigns_registration",
	    				email: email,
	    				password: password,        				
	    				security: security
	        		},
	        		success: function(response){
                        $(".bpwcmscPageLoader").hide();
	        			var err,resp;
	        			resp = (response.indexOf("-") > -1) ? response.substr(0,response.indexOf("-")) : response;

        				switch(resp) {
        					case "success" : 
        						window.location.href = response.substr(response.indexOf("-")+1);
    							break;
							case "Logged" : 
								err = '<label id="reg_user_pass_required" class="error-label">User already logged-in, Log out and register</label>';
								$(err).prependTo("form.register");
							break;
							case "User required" : 
								err = '<label id="reg_user_pass_required" class="error-label">Username/Password required</label>';
								$(err).prependTo("form.register");
							break;
							case "password required" : 
								err = '<label id="reg_user_pass_required" class="error-label">Username/Password required</label>';
								$(err).prependTo("form.register");
							break;
							case "Invalid User" : 
								err = '<label id="reg_user_pass_required" class="error-label">Invalid Username</label>';
								$(err).prependTo("form.register");
							break;
							case "user exist" : 
								err = '<label id="reg_user_pass_required" class="error-label">Username already taken</label>';
								$(err).prependTo("form.register");
							break;
        				}
	        		},
	        		error: function(response){
	        			alert(response);
	        		}
	        	});
        	}
        });

        // Disable enter key form submission

        $(".checkout, .register, .woocommerce-form-login").on("keydown", function(e){
        	var keyCode = e.keyCode || e.which;
			if (keyCode === 13) { 
			    e.preventDefault();
			    return false;
			}
        });

        if (bpwcmsc_steps.zipcode_validation == 'yes') {

            $("#billing_postcode").on("blur", function(){
                if( $("#billing_country").val() != "" && $("#billing_postcode").val() != "" ) {
                    if($("#billing_country_error").length)
                        $("#billing_country_error").remove();

                    if(!$("#billing_postcode_error").length)
                        $("#billing_postcode_error").remove();

                    validatePostCode( "billing" );
                } else {
                    $("#billing_country").addClass("error-field");
                    $("#billing_postcode").addClass("error-field");
                    var err = '<label id="billing_country_error" class="error-label">' + bpwcmsc_steps.error_msg + '</label>';
                    if(!$("#billing_country_error").length)
                        $(this).parent(".bpwcmsc-validate-required").append(err);

                    if(!$("#billing_postcode_error").length)
                        $(this).parent(".bpwcmsc-validate-required").append(err);
                }
            });

            $("#shipping_postcode").on("blur", function(){
                // if($("#ship-to-different-address-checkbox").is(":visible") && $("#ship-to-different-address-checkbox").is(":checked")){
                    if( $("#shipping_country").val() != "" && $("#shipping_postcode").val() != "" ) {
                        if($("#shipping_country_error").length)
                            $("#shipping_country_error").remove();

                        if(!$("#shipping_postcode_error").length)
                            $("#shipping_postcode_error").remove();

                        validatePostCode( "shipping" );
                    } else {
                        $("#shipping_country").addClass("error-field");
                        $("#shipping_postcode").addClass("error-field");
                        var err = '<label id="shipping_country_error" class="error-label">' + bpwcmsc_steps.error_msg + '</label>';
                        if(!$("#shipping_country_error").length)
                            $(this).parent(".bpwcmsc-validate-required").append(err);

                        if(!$("#shipping_postcode_error").length)
                            $(this).parent(".bpwcmsc-validate-required").append(err);
                    }
                // }
            });
        }

        $("#billing_email").on("blur input", function(){
        	var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
            var msg = '<label id="billing_email_error" class="error-label">' + bpwcmsc_steps.email_error_msg + '</label>';
            if ( ! pattern.test( $(this).val()  ) ) {
                if(!$("#billing_email_error").length)
                    $(msg).insertAfter($(this));
                return false;
            } else {
                $("#billing_email_error").remove();
                return true;            
            }
        });
        
        $("#billing_phone").on("paste drop", function(e){
            var msg = '<label id="billing_phone_error" class="error-label">' + bpwcmsc_steps.phone_error_msg + '</label>';
            var ret = valdatePhone(e);
            // return ret;
            if(ret){
                if($("#billing_phone_error").length){
                    $(this).removeClass("error-field");
                    $("#billing_phone_error").remove();
                    return ret;
                }
            } else {
                if(!$("#billing_phone_error").length){
                    $(this).addClass("error-field");
                    $(msg).insertAfter($(this));
                    return ret;
                }  
            }
        });
        $("#billing_phone").on("keypress", function(e){
        	var msg = '<label id="billing_phone_error" class="error-label">' + bpwcmsc_steps.phone_error_msg + '</label>';
        	var ret = valdatePhone(e);
            return ret;
        });
        /**
         * Register and Login hide / show 
         */
        $("#hide-register").hide();
        $("#bpwcmsc-login").hide();
        var delay = 500;
        $("#bpwcmsc-register").click(function(){
            $("#bpwcmsc-register").hide();
            $("#hide-register").slideDown(delay);
            $("#hide-login").slideUp(delay);
            setTimeout(function(){
                $("#bpwcmsc-login").show()
            },delay+1);            
        });
        $("#bpwcmsc-login").click(function(){            
            $("#bpwcmsc-login").hide();            
            $("#hide-login").slideDown(delay);
            $("#hide-register").slideUp(delay);
            setTimeout(function(){
                $("#bpwcmsc-register").show()
            },delay+1);            
        });
    });

function getCurrentIndex(){
	return $("#myTab li.current").index();
}
function valdatePhone(e){
    var specialKeys = new Array();
    specialKeys.push(8);
    var keyCode = e.which ? e.which : e.keyCode
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}
function scrollToTop(){
	var position = $("#bpwcmscSteps").offset().top;
	// console.log(position);
	$("html, body").animate({
		scrollTop: position
	},500);
	return false;
}
function manipulateActions(){
    $("#content div.tab-pane").css("display","none");
    $("#content div.current").css("display", "block");
	if( getCurrentIndex() == 0 /*&& $("#coupon-step.current").length < 1*/ && $("#login-step.current").length > 0 ){
    	$("ul#pagination li#skip").css("display","block");
    	$("ul#pagination li#next").css("display","none");
    	$("ul#pagination li#prev").css("display","none");
    } else if(getCurrentIndex() == 0 && $("#login-step.current").length < 1/*&& $("#coupon-step").length > 0*/ ){
    	$("ul#pagination li#skip").css("display","none");
    	$("ul#pagination li#prev").css("display","none");
    	$("ul#pagination li#next").css("display","block");
    } else if ( getCurrentIndex() == $(".last").index() ){
    	$("ul#pagination li#next").css("display","none");
    	$("ul#pagination li#prev").css("display","block");
    	$("ul#pagination li#last").css("display","block");
    } else {
    	$("ul#pagination li#skip").css("display","none");
    	$("ul#pagination li#prev").css("display","block");
    	$("ul#pagination li#next").css("display","block");
    	$("ul#pagination li#last").css("display","none");
    }
}

function validateCheckoutFields(){
	var err,labid,status=0;
	if( ! $("#createaccount").is(":checked") ){
		$("#account_password_field").removeClass("bpwcmsc-validate-required");
	} else {
        $("#account_password_field").addClass("bpwcmsc-validate-required");
    } 
	if ( ! $("#ship-to-different-address-checkbox").is(":checked") ) {
		$("div.shipping_address p").each(function(){
			$(this).removeClass("bpwcmsc-validate-required");
		});
	} else {
		$("div.shipping_address p.validate-required").each(function(){
			$(this).addClass("bpwcmsc-validate-required");
		});
	}
	$("#content div.current .bpwcmsc-validate-required").each(function(){
		if( $(this).find(":input").val() == "" ) {
			labid = $(this).find(":input").attr("id") + "_error";
			err = '<label id="' + labid + '" class="error-label">' + bpwcmsc_steps.error_msg + '</label>';
			if( ! $("#"+labid).length > 0 ){
				$(this).append(err);
			}
			$(this).find(":input").addClass("error-field");
			status++;
		} else {
			labid = $(this).find(":input").attr("id") + "_error";
			$(this).find("#"+labid).remove();
			$(this).find(":input").removeClass("error-field");
		}
	});
	// console.log(status);

	if($(".terms").is(":visible") || $("#terms").is(":visible") ){
		if(! $("#terms").is(":checked")) {
			$(".checkbox").addClass("term-error");
			err = '<label id="term-error" class="error-label">' + bpwcmsc_steps.terms_error + '</label>';
			if(! $("#term-error").length)
                $(".checkbox").closest("p").append(err);
			status++;
		} else {
			$(".checkbox").removeClass("term-error");
			$("#term-error").remove();			
		}
	}
	// console.log(Math.abs(status));
    status = valdateEmail() ? status : status++;
	return (Math.abs(status)>0) ? false : true;
}

function validateLoginFields(){
	var status="valid";
	var err = '<label id="user_pass_required" class="error-label">Username/Password required</label>';
	if ( $("#username").val() == "" ) {
		$("#username").addClass("error-field");
		status="invalid";
	}
	if ( $("#password").val() == "" ) {
		$("#password").addClass("error-field");
		status="invalid";
	}
	if(status=="invalid"){
		$(err).prependTo("form.login");
	}
	return status;
}

function validateRegisterFields(){
	var status="valid";
	var err = '<label id="reg_user_pass_required" class="error-label">Username/Password required</label>';
	if ( $("#reg_email").val() == "" ) {
		$("#reg_email").addClass("error-field");
		status="invalid";
	}
	if ( $("#reg_password").val() == "" ) {
		$("#reg_password").addClass("error-field");
		status="invalid";
	}
	if(status=="invalid"){
		$(err).prependTo("form.register");
	}
	return status;
}

function validatePostCode(whichcode){
    $(".bpwcmscPageLoader").show();
    $.ajax({
        type: "POST",
        url: bpwcmsc_steps.ajaxurl,
        data: {
            action: "zip_validation",
            country: $("#"+whichcode+"_country").val(),
            postcode: $("#"+whichcode+"_postcode").val()
        },
        success: function(response){
            $(".bpwcmscPageLoader").hide();
            if(response == false){
                $("#"+whichcode+"_postcode").addClass("error-field");
                if(!$("#"+whichcode+"_postcode_error").length)
                    $("#"+whichcode+"_postcode").parent(".bpwcmsc-validate-required").append('<label id="' + "#" + whichcode + '"_postcode_error" class="error-label">' + bpwcmsc_steps.zipcode_error_msg + '</label>');
                return false;
            } else {
                if($("#"+whichcode+"_postcode_error").length)
                    $("#"+whichcode+"_postcode_error").remove();
                return true;
            }
        },
        error: function(response){

        }
    });
}

function valdateEmail(){
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    var msg = '<label id="billing_email_error" class="error-label">' + bpwcmsc_steps.email_error_msg + '</label>';
    if ( ! pattern.test( $(this).val()  ) ) {
        if(!$("#billing_email_error").length)
            $(msg).insertAfter($(this));
        return false;
    } else {
        $(this).parent("bpwcmsc-validate-required").find("#billing_email_error").remove();
        return true;            
    }
}

function drawReviewTable() {
    var reviewTable = $('.woocommerce-checkout-review-order-table')
    				.first()
    				.clone()
    				.removeClass('woocommerce-checkout-review-order-table')
    				.addClass('review-table');
     
    var ShippingMethod = '';
    if ($(reviewTable).find('td[data-title="Shipping"]').length) { 
        if ($(reviewTable).find("#shipping_method").length) {
            ShippingMethod = $(reviewTable).find('.shipping_method:checked').siblings('label').text();
        } else {
            ShippingMethod = $(reviewTable).find('td[data-title="Shipping"]').text();
        }
        if($(reviewTable).find(".woocommerce-remove-coupon").length){
            $(".woocommerce-remove-coupon").remove();
        }
        $(reviewTable).find('td[data-title="Shipping"]').empty().text(ShippingMethod);
    }
    $('.bpwcmsc-review-order-details').html(reviewTable);
}

$(document).ajaxComplete(function(event,xhr,settings) {
    var str = settings.url.split("=");
    if( str[1] == "update_order_review" && $("#content div.current").attr('id') == 'review-order-step' ) {
        drawReviewTable();
    }
});

function setCustomerDetailsReview() {
       
    var billing_first_name = $("#billing_first_name").val(), 
    	billing_last_name = $("#billing_last_name").val(), 
    	billing_company = $("#billing_company").val(), 
    	billing_email = $("#billing_email").val(), 
    	billing_phone = $("#billing_phone").val(), 
    	billing_city = $("#billing_city").val(), 
    	billing_state = $("#billing_state").is("select") ? $("#billing_state option:selected").text() : $("#billing_state").val(), 
    	billing_country = $("#billing_country option:selected").text(),
    	billing_postcode = $("#billing_postcode").val(), 
    	billing_address = $("#billing_address_1").val() + " " + $("#billing_address_2").val();
    var $html;
    $html = (billing_first_name != "" || billing_last_name != "") ? "<p>" + billing_first_name + " " + billing_last_name + "</p>" : "";
    $html += (billing_company != "") ? "<p>" + billing_company + "</p>" : "";
    $html += (billing_address != "") ? "<p>" + billing_address + "</p>" : "";
    $html += (billing_city != "") ? "<p>" + billing_city + "</p>" : "";
    $html += (billing_state != "" || billing_country ) ? "<p>" + billing_state + " " + billing_country + "</p>" : "";
    $html += (billing_postcode != "") ? "<p>" + billing_postcode + "</p>" : "";    

    //Billing Address                         
    $('.bpwcmsc-billing-address').html($html);
    
    //Email
    $('.bpwcmsc-customer-email').html(billing_email);
    
    //Phone
    $('.bpwcmsc-customer-phone').html(billing_phone);

    if ($("#ship-to-different-address-checkbox").is(":checked")) {
        
        //shipping details
        var shipping_first_name = $("#shipping_first_name").length ? $("#shipping_first_name").val() : '',
            shipping_last_name = $("#shipping_last_name").length ? $("#shipping_last_name").val() : '',
            shipping_company = $("#shipping_company").length ? $("#shipping_company").val() : '',
            shipping_state = $("#shipping_state").length ? ($("#shipping_state").is("select") ? $("#shipping_state option:selected").text() : $("#shipping_state").val()) : '',
            shipping_city = $("#shipping_city").length ? $("#shipping_city").val() : '',
            shipping_country = $("#shipping_country").length ? $("#shipping_country option:selected").text() : '',            
            shipping_postcode = $("#shipping_postcode").length ? $("#shipping_postcode").val() : '',
            shipping_address = $("#shipping_address_1").val() + " " + $("#shipping_address_2").val();
        $html = "";
        $html += (shipping_first_name!="" || shipping_last_name!="") ? "<p>" + shipping_first_name + " " + shipping_last_name + "</p>" : "";
        $html += (shipping_company!="") ? "<p>" + shipping_company + "</p>" : "";
        $html += (shipping_address!="") ? "<p>" + shipping_address + "</p>" : "";
        $html += (shipping_city!="") ? "<p>" + shipping_city + "</p>" : "";
        $html += (shipping_state!="" || shipping_country!="") ? "<p>" + shipping_state + ", " + shipping_country + "</p>" : "";
        $html += (shipping_postcode!="") ? "<p>" + shipping_postcode + "</p>" : "";             
        //Shipping Address
        $('.bpwcmsc-shipping-address').html($html);            
               
    } else {
        //Shipping Address
        $(".bpwcmsc-shipping-address").html($html);
    }
}
})(jQuery);