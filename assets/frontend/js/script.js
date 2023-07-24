$("document").ready(function(){
/****Start****/

//Header Search
$(".search-btn").click(function(){
    $(this).find("i").toggleClass("la-search la-times");
    $(".header-search").toggleClass("expand");
});

//Menu Toggle
$(".menu-toggle").click(function(){
    $(".mega-menu").fadeIn();
    $("html").css("overflow","hidden");
});

$(".menu-bars.close").click(function(){
    $(".mega-menu").fadeOut();
    $("html").css("overflow","initial");
});

//Tab
$(".tab-btn").click(function(){
	var tab_data = $(this).attr("data");
    var tab_name = $(this).attr("data-tab");
	$(this).addClass("active");
	$(`.tab-btn[data=${tab_data}]`).not($(this)).removeClass("active");
    if(tab_name == '*'){
        $(`.tab-content[data=${tab_data}]`).addClass("show");
    }else{
        $(`.tab-content[data=${tab_data}]`).removeClass("show");
        $(`.tab-content[data=${tab_data}][data-tab=${tab_name}]`).addClass("show");
    }


    var id_name = $(this).attr("data-id");
    if (typeof id_name !== 'undefined' && id_name !== false) {
         $('html, body').animate({
            scrollTop: $("#"+id_name+"").offset().top - 150
        }, 100);
     }

});

//Hover Tab
$(".hover-tab").mouseenter(function(){
    var tab_name = $(this).attr("data");
    $(".hover-tab").removeClass("active");
    $(this).addClass("active");
    $(".hover-tab-content").hide();
    $(".hover-tab-content[data='"+tab_name+"']").show();
});

//Select2
$('.select2').select2({
	minimumResultsForSearch: -1
});

var list = $(".select2-search").select2({
  closeOnSelect: false
 }).on("select2:closing", function(e) {
  e.preventDefault();
 }).on("select2:closed", function(e) {
  list.select2("open");
 });
 list.select2("open");

//Recommended Slider
$('.recommended-slider').owlCarousel({
    loop:true,
    margin:0,
    nav:true,
    dots:false,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});

//Brand Slider
$('.brand-slider').owlCarousel({
    loop:true,
    margin:20,
    nav:true,
    dots:false,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:4
        },
        1000:{
            items:6
        }
    }
});

//How it Work Slider
$('.how-it-work-slider').owlCarousel({
    loop:true,
    margin:30,
    nav:false,
    dots:true,
    autoplay:false,
    items:1

});

//Faq
$(".faq-head").click(function(){
    $(this).parent().toggleClass("show");
    $(this).next().slideToggle();
    if(!$(this).parents(".faq-section").hasClass("all-open")){
        $(".single-faq").not($(this).parent()).removeClass("show");
        $(this).parents(".faq-section").find(".faq-content").not($(this).next()).slideUp();
    }
});

//AOS
AOS.init({
   once: true
});

//Scroll Top & Fixed Header
$(window).scroll(function(){
    var scroll = $(window).scrollTop();
    if(scroll > 40){
        $("html").addClass("screen-scrolled");
    }else{
        $("html").removeClass("screen-scrolled");
    }
});
$(".scroll-top").click(function(){
    $("html, body").animate({
        scrollTop: "0"
    },100);
});

//Customer Review Slider
$('.customer-review-slider').owlCarousel({
    loop:true,
    margin:20,
    nav:true,
    dots:false,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});

//Addtional Cover Slider
$('.addtional-slider').owlCarousel({
    loop:true,
    margin:70,
    nav:true,
    dots:false,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});

//Filter Block
$(".filter-head").click(function(){
    $(this).parent().toggleClass("active");
    $(this).parent().find(".filter-content").slideToggle();
});

//Remove Filter item
$(".single-tag i").click(function(){
    $(this).parent().remove();
});

//Add Compare
$(".add-compare").click(function(){
    var compare_items = $(".add-compare:checked").length;
    if(compare_items > 4){
        alert("You are allowed to select only 4 cars at a time.");
        return false;
    }
    if(compare_items > 0){
        $(".compare-section").addClass("show");
    }else{
        $(".compare-section").removeClass("show");
    }
});

//Remove Compare Item
$(".remove-item").click(function(){
    $(this).parents(".compare-item").remove();
    var total_compare_item = $(".compare-item").length;
    if(total_compare_item == 1){
        $(".compare-section").removeClass("show");
        $(".new-car-finder").removeClass("show");
    }
});

//Show Hide add item
$(".add-new-car-item").click(function(){
    $(".new-car-finder").addClass("show");
});
$(".hide-item").click(function(){
    $(".new-car-finder").removeClass("show");
});

//Remove all compare item
$(".hide-compare-row").click(function(){
    $(".compare-list .compare-item").not($(".compare-list .compare-item").last()).remove();
    $(".compare-section").removeClass("show");
});

//Similar Car Slider
$('.similar-car-slider').owlCarousel({
    loop:true,
    margin:0,
    nav:true,
    dots:false,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:2
        }
    }
});

//Review Text Expand
$(".expand-text").click(function(){
    $(this).parent().toggleClass("show");
    var newText = ($(this).text() == 'Read More') ? 'Read Less':'Read More';
    $(this).text(newText);
});


//Customer Slider
$('.customer-slider').owlCarousel({
    loop:true,
    margin:100,
    nav:true,
    dots:false,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:2
        }
    }
});

//Statistics Slider
$('.statistics-slider').owlCarousel({
    loop:true,
    margin:0,
    nav:true,
    dots:false,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});


//Edit Data
$(".edit-data").click(function(){
    var form_name = $(this).attr("data");
    $(".form-data[data='"+form_name+"'] .edit-field").prop("disabled",false);
    $(".form-data[data='"+form_name+"'] .profile-box").addClass("edit-image");
    $(".save-data[data='"+form_name+"']").removeClass("d-none");
    $(".edit-row[data='"+form_name+"']").addClass("d-none");
});

//OTP field
$(".otp-num-enter input").keyup(function(){
    var otp_lght = $(this).val().length;
    if(otp_lght == 1){
        $(this).next().focus();
    }
});

$(".enter-otp-mob").keyup(function(){
    var mob_lgth = $(this).val().length;
    if(mob_lgth == 10){
        $(this).parent().find(".send-otp").removeClass("d-none");  
    }else{
        $(this).parent().find(".send-otp").addClass("d-none");  
    }
});

$(".send-otp").click(function(){
    $(this).parents(".tab-content").find(".otp-enter-form").removeClass("d-none");
    $(this).parents("form").addClass("d-none");
});

$(".back-to-from").click(function(){
    $(this).parents(".tab-content").find(".otp-enter-form").addClass("d-none");
    $(this).parents(".tab-content").find("form").first().removeClass("d-none");
});

//Cart Item Delete
$(".delete-item").click(function(){
    $(this).parents(".table-row").remove();
});

//Shipping Same as Billing
$("#shipping-billing-same").change(function(){
    if($(this).is(':checked')){
        $(".shipping-address-form").addClass("d-none");
    }else{
        $(".shipping-address-form").removeClass("d-none");
    }
});

//Select All Checkbox
$(".select-all-checkbox").change(function(){
    var checkbox_row = $(this).attr("data-for");
    if($(this).is(':checked')){
        $("input[type='checkbox'][data-get='"+checkbox_row+"']").prop("checked",true);
    }else{
        $("input[type='checkbox'][data-get='"+checkbox_row+"']").prop("checked",false);
    }
});

//Car Detail Accordian
$(".car-detail .detail-head span").click(function(){
    $(this).parent().next().toggle();
    $(this).find("i").toggleClass("la-angle-down la-angle-up");
});










/****End****/
});