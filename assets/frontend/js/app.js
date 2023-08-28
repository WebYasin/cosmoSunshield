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
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        600: {
          slidesPerView: 2,
        },
        900: {
          slidesPerView: 4,
        },
      }
    });


    //Product Slider Small
    var productSwiperSmall = new Swiper(".product-slider.small", {
      loop: false,
      slidesPerView: 4,
      spaceBetween: 50,
      navigation: {
          nextEl: ".product-next",
          prevEl: ".product-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 2,
        },
        600: {
          slidesPerView: 4,
        },
        900: {
          slidesPerView: 4,
        },
      }
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

    //HTML Video Popup
    const myModalVideo = new bootstrap.Modal('#video-popup-2')
    const myModalVideo2 = document.getElementById('video-popup-2')
    $(".html-popup-video-btn").click(function(){
      let videoId = $(this).attr("data")
      $("#video-popup-2 video").attr("src",`${videoId}`)
      myModalVideo.show()
    })

    myModalVideo2.addEventListener('hidden.bs.modal', event => {
      $("#video-popup-2 video").attr("src",'')
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
      breakpoints: {
        0: {
          spaceBetween: 20,
        },
        600: {
          spaceBetween: 45,
        },
        900: {
          spaceBetween: 45,
        },
      }
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
      breakpoints: {
        0: {
          slidesPerView: 1.4,
        },
        600: {
          slidesPerView: 1.9,
        },
        900: {
          slidesPerView: 1.9,
        },
      }
    });

    //Sub Product Slider
    var subProductSwiper = new Swiper(".sub-product-slider", {
      loop: true,
      slidesPerView: 4,
      autoplay: true,
      spaceBetween: 20,
      navigation: {
        nextEl: ".product-next-2",
        prevEl: ".product-prev-2",
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        600: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
        1120: {
          slidesPerView: 4,
        },
      }
    });

    //Benefit Slider
    var benefitSwiper = new Swiper(".benefit-sliders", {
      loop: true,
      slidesPerView: 4,
      autoplay: true,
      spaceBetween: 0,
      navigation: {
        nextEl: ".product-next-2",
        prevEl: ".product-prev-2",
      },
      breakpoints: {
        0: {
          slidesPerView: 2,
        },
        600: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
        1120: {
          slidesPerView: 4,
        },
      }
    });



    //Men Toggle
    $(".menu-toggle").click(function(){
      $("header .navigation").toggleClass("open")
    })

    $(document).on('keyup',"#keyword",function(){
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
})
