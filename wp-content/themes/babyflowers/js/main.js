// JavaScript Document
jQuery(function($){
	
	$(document).ready(function(e) {
	let dato = $("body").height();

	$("#iproducto").css("height",dato);
	
	  
    });
	
	var path = location.pathname;
	
	if(path==="/paraninas/"){
		$(".nav li").removeClass("active");
		$(".nav li:first-child").addClass("active");
	}
	if(path==="/paraninos/"){
		$(".nav li").removeClass("active");
		$(".nav li:nth-child(2)").addClass("active");
	}
	if(path==="/como-comprar/"){
	   $(".nav li").removeClass("active");
		$(".nav li:nth-child(3)").addClass("active");
	 }
	
	if(path==="/por-que-baby-flowers/"){
		$(".nav li").removeClass("active");
		$(".nav li:last-child").addClass("active");
		
	}

});