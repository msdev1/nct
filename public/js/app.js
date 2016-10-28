$( ".accordion" ).accordion();
$( ".btn2" ).button();
$( ".radio" ).buttonset();
$( ".tab" ).tabs();
$( ".spinner" ).spinner();


$('.dropdown-toggle').dropdown();
//$( ".selectmenu" ).selectmenu();
//$( "#menu" ).menu();

	// $(document).pjax('a', '#pjax-container')
$(".alert").alert();


$('[data-toggle="tooltip"]').tooltip();
$(document).ready(function(){
$('.dropdown-submenu .dropdown').on("click", function(event){
	 event.stopPropagation();
	 event.preventDefault();
	$('.dropdown-submenu .dropdown').next('ul').slideUp();
	
	 $(this).next('ul').slideDown();
 });



$('.mainPanel').on("click", function(event){

$('.dropdown-submenu .dropdown').next('ul').slideUp();
 });



});

