jQuery(document).ready(function($){
    //Solution hover video
    // $(".solution-block").mouseenter(function(){
    //     $(this).find("video").get(0).play();
    // })
    // $(".solution-block").mouseleave(function(){
    //     $(this).find("video").get(0).pause();
    // })

    //Testimonial Slider
    var testimoniaSwiper = new Swiper(".testimonial", {
        loop: false,
        navigation: {
            nextEl: ".test-next",
            prevEl: ".test-prev",
          },
    });

    //Product Slider
    var productSwiper = new Swiper(".product-slider", {
      loop: false,
      slidesPerView: 4,
      navigation: {
          nextEl: ".product-next",
          prevEl: ".product-prev",
      },
    });

    //Video Popup
    const myModalAlternative = new bootstrap.Modal('#videoPopup')
    const myModalAlternative2 = document.getElementById('videoPopup')
    $(".video-popup").click(function(){
      let videoId = $(this).attr("data-video")
      $("#videoPopup iframe").attr("src",`https://www.youtube.com/embed/${videoId}?autoplay=1&playlist=${videoId}`)
      myModalAlternative.show()
    })

    myModalAlternative2.addEventListener('hidden.bs.modal', event => {
      $("#videoPopup iframe").attr("src",``)
    })

    //Youtube Video Btn
    $(".youtube-video-btn, .video-my-btn").click(function(){
      let videoId = $(this).attr("data")
      $(this).parent().find("iframe").attr("src",`https://www.youtube.com/embed/${videoId}?autoplay=1&playlist=${videoId}`)
      $(this).parent().find("iframe").addClass("d-block")
      $(this).parent().find("video").attr("src",`${videoId}`)
      $(this).parent().find("video").addClass("d-block")
    })

    //Benefit View
    $(".benefit-block").click(function(){
      $(this).addClass("active")
      $(this).siblings().removeClass("active")
    })

    scrollCue.init();

    //Featured Blog Slider
    var productSwiper = new Swiper(".featured-blog-slider", {
      loop: true,
      autoplay: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true
      }
    });

    //Industry Slider
    var industrySwiper = new Swiper(".industry-slider", {
      loop: true,
      slidesPerView: 'auto',
      autoplay: true,
      spaceBetween: 45,
      centeredSlides: true,
    });

    //Work Culture Slider
    var workSwiper = new Swiper(".work-culture-slider", {
      loop: true,
      slidesPerView: 1.9,
      autoplay: true,
      spaceBetween: 20,
      navigation: {
        nextEl: ".work-next",
        prevEl: ".work-prev",
      },
    });



    })


$(document).on('keyup',"#search",function(){
    let search = $(this).val();
    var base = $('#base').data('base');
    if(search)
    {

        $.ajax({
        url:    base+'searchData',
        method:   "POST",
        data:   {search:search},
        success:function(res){
           if(res)
           {
                $('#searchingData').removeClass('d-none');
                $('#searchingData').html(res);

           }else{
              $('#searchingData').addClass('d-none');
           }
        }
    });



    }else{
        $('#searchingData').addClass('d-none');
    }
})
