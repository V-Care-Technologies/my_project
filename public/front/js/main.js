new Swiper('.banner-swiper', { 
    loop: true,
    autoplay:true,
    //   navigation: {
    //     nextEl: ".swiper-button-next8",
    //     prevEl: ".swiper-button-prev8",
    //   }, 
    slidesPerView: 1,
    spaceBetween: 20, 
}); 
// new Swiper('.category-swiper', {
//     loop: true,
//     navigation: {
//         nextEl: ".swiper-button-next7",
//         prevEl: ".swiper-button-prev7",
//      }, 
//     paginationClickable: true,
//     slidesPerView:2, 
//     spaceBetween: 5,
//     breakpoints: {
//          767: {
//             slidesPerView: 2,
//             spaceBetween: 5,
//         },
//         991: {
//             slidesPerView: 3,
//             spaceBetween: 30
//         }, 
//          1028: {
//             slidesPerView: 3,
//             spaceBetween: 30
//         },
//         1440: {
//             slidesPerView: 4,
//             spaceBetween: 30
//         },
       
//         1920: {
//             slidesPerView: 4,
//             spaceBetween: 30
//         },
        
        
//     }
// });

new Swiper('.blog-detail-swiper', {
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next10",
        prevEl: ".swiper-button-prev10",
     }, 
    paginationClickable: true, 
    breakpoints: {
         767: {
            slidesPerView: 2,
            spaceBetween: 5,
        },
        991: {
            slidesPerView: 2,
            spaceBetween: 30
        }, 
         1028: {
            slidesPerView: 2,
            spaceBetween: 30
        },
        1440: {
            slidesPerView: 4,
            spaceBetween: 30
        },
       
        1920: {
            slidesPerView: 4,
            spaceBetween: 30
        },
        
        
    }
});

// blog-detail-swiper
document.addEventListener("DOMContentLoaded", function () {

 new Swiper('.featured-swiper', {
    loop: true,
     navigation: {
        nextEl: ".swiper-button-next1",
        prevEl: ".swiper-button-prev1",
     }, 
    slidesPerView:2, 
    spaceBetween:12,
    paginationClickable: true, 
    breakpoints: {
        575: {
            slidesPerView: 2,
            spaceBetween: 5,
        },
                991: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
                1028: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
        
        1440: {
            slidesPerView: 4,
            spaceBetween: 30,
        },

        1920: {
            slidesPerView: 4,
            spaceBetween: 30,
        },

    }
});});
new Swiper('.offer-product-swiper', {
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next2",
        prevEl: ".swiper-button-prev2",
    },  
    slidesPerView:2, 
    spaceBetween:12,
    paginationClickable: true, 
    breakpoints: {
         575: {
            slidesPerView: 2,
            spaceBetween: 5,
        },
                991: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
                1028: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
        
        1440: {
            slidesPerView: 4,
            spaceBetween: 30,
        },

        1920: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
    }
});
new Swiper('.arrivals-product-swiper', {
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next3",
        prevEl: ".swiper-button-prev3",
    }, 
    slidesPerView:2, 
    spaceBetween:12,
    paginationClickable: true, 
    breakpoints: {
         575: {
            slidesPerView: 2,
            spaceBetween: 5,
        },
                991: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
                1028: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
        
        1440: {
            slidesPerView: 4,
            spaceBetween: 30,
        },

        1920: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
    }
});
new Swiper('.testimonial-swiper', {
    loop: true,
     navigation: {
        nextEl: ".swiper-button-next4",
        prevEl: ".swiper-button-prev4",
    },  
    spaceBetween: 50,
    paginationClickable: true,
});
new Swiper('.partners-swiper', {
    loop: true,
     navigation: {
        nextEl: ".swiper-button-next5",
        prevEl: ".swiper-button-prev5",
    },    
    paginationClickable: true,
    breakpoints: {
        1920: {
            slidesPerView: 5,
            spaceBetween: 30
        },
        1028: {
            slidesPerView: 4,
            spaceBetween: 30
        },
        991: {
            slidesPerView: 3,
            spaceBetween: 30
        },
        576: {
            slidesPerView: 2,
            spaceBetween: 10
        }
    }
});
new Swiper('.blog-swiper', {
    loop: true,
     navigation: {
        nextEl: ".swiper-button-next6",
        prevEl: ".swiper-button-prev6",
    },    
    paginationClickable: true,
    breakpoints: {
        1920: {
            slidesPerView: 2,
            spaceBetween: 30
        },
        1028: {
            slidesPerView: 2,
            spaceBetween: 30
        },
        991: {
            slidesPerView: 1,
            spaceBetween: 30
        },
        576: {
            slidesPerView: 1,
            spaceBetween: 10
        }
    }
});
// new Swiper('.blog-swiper', {
//     loop: false,
//     navigation: {
//         nextEl: ".swiper-button-next6",
//         prevEl: ".swiper-button-prev6",
//     },   
//     // nextButton: '.swiper-button-next6',
//     // prevButton: '.swiper-button-prev6',
//     paginationClickable: true,
//     easing: 'ease-in-out',
//     spaceBetween: 20,
//     breakpoints: {
//         1920: {
//             slidesPerView: 2,
//             spaceBetween: 30
//         },
//         1028: {
//             slidesPerView: 2,
//             spaceBetween: 30
//         },
//         991: {
//             slidesPerView: 1,
//             spaceBetween: 30
//         },
//         576: {
//             slidesPerView: 1,
//             spaceBetween: 10
//         }
//     }
// });


$(document).ready(function() { 
    
   var buttonPlus = $(".qty-btn-plus");
    var buttonMinus = $(".qty-btn-minus");
    
    var incrementPlus = buttonPlus.click(function() {
        var $n = $(this)
            .parent(".qty-container")
            .find(".input-qty");
        $n.val(Math.max(1, Number($n.val()) + 1)); // Ensure minimum value of 1
    });
    
    var incrementMinus = buttonMinus.click(function() {
        var $n = $(this)
            .parent(".qty-container")
            .find(".input-qty");
        var amount = Number($n.val());
        if (amount > 1) {
            $n.val(amount - 1);
        }
    });
   
   
   
   
    $(".form-radio").change(function() {
        if (this.value == "green") {
            $(".green_section").css("display", "inline-block");
            $(".yellow_section").css("display", "none");
            $(".blue_section").css("display", "none");
        } else if (this.value == "yellow") {
            $(".green_section").css("display", "none");
            $(".blue_section").css("display", "none");
            $(".yellow_section").css("display", "inline-block");
        } else if (this.value == "blue") {
            $(".green_section").css("display", "none");
            $(".yellow_section").css("display", "none");
            $(".blue_section").css("display", "inline-block");
        }
    });
    $(".form-radio1").change(function() {
        if (this.value == "60kg") {
            $(".sixty_kg_price").css("display", "inline-block");
            $(".eighty_kg_price").css("display", "none");
            $(".ninty_kg_price").css("display", "none");
            $(".hundred_kg_price").css("display", "none");
        } else if (this.value == "80kg") {
            $(".eighty_kg_price").css("display", "inline-block");
            $(".sixty_kg_price").css("display", "none");
            $(".ninty_kg_price").css("display", "none");
            $(".hundred_kg_price").css("display", "none");
        } else if (this.value == "90kg") {
            $(".ninty_kg_price").css("display", "inline-block");
            $(".sixty_kg_price").css("display", "none");
            $(".eighty_kg_price").css("display", "none");
            $(".hundred_kg_price").css("display", "none");
        } else if (this.value == "100kg") {
            $(".hundred_kg_price").css("display", "inline-block");
            $(".sixty_kg_price").css("display", "none");
            $(".ninty_kg_price").css("display", "none");
            $(".eighty_kg_price").css("display", "none");
        }
    });
    $(".filter_toggle").on("click", function() {
        $(".mobile_filter").css("display", "inline-block");
    })

    $(".close_icon").on("click", function() {
        $(".mobile_filter").css("display", "none");
    })
    // filter_toggle
    // if ($(window).width() < 991) {
    //   $(".sidebar").css("display", "none");
    //   $(".filter_toggle").on("click", function () {
    //     $(".sidebar").css("display", "inline-block");
    //   });
    //   $(".close_icon").on("click", function () {
    //     $(".sidebar").css("display", "none");
    //   });
    // } else {
    //   $(".sidebar").css("display", "inline-block");
    // }

    // Swiper: Slider
    $(".login_change").change(function() {
        if (this.value == "login") {
            $(".login_form").css("display", "inline-block");
            $(".login_breadcrub").css("display", "inline-block");
            $(".register_form").css("display", "none");
            $(".register_breadcrub").css("display", "none");
        } else if (this.value == "register") {
            $(".login_form").css("display", "none");
            $(".login_breadcrub").css("display", "none");
            $(".register_form").css("display", "inline-block");
            $(".register_breadcrub").css("display", "inline-block");
        }
    });
    $(".send_otp").on("click", function() {
        $(".submit_Otp").css("display", "block");
        $(".submit_email").css("display", "none");
    });

    $(".change_number").on("click", function() {
        $(".submit_email").css("display", "block");
        $(".submit_Otp").css("display", "none");
    });

    
   
  
  
  

    var loadFile = function(event) {
        var image = document.getElementById("output");
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    $(document).on("select2:open", () => {
        document.querySelector(".select2-search__field").focus();
    });
    $(".mySelect2").select2({});
    $(".input_search")
        .on("blur", function() {
            $("main").removeClass("input-desc-hover").addClass("input-desc");
        })
        .on("focus", function() {
            $("main").removeClass("input-desc").addClass("input-desc-hover");
        });

    $(".row").on("click", ".delete_icon1", function() {
        $(this).closest(".row").remove();
    });

    $("table").on("click", ".delete_icon", function() {
        $(this).closest("tr").remove();
    });

    $(".col-12").on("click", ".delete_icon", function() {
        $(this).closest(".product_row").remove();
    });

    $(function() {
        var siteSticky = function() {
            $(".js-sticky-header").sticky({
                topSpacing: 0,
            });
        };
        siteSticky();

        var siteMenuClone = function() {
            $(".js-clone-nav").each(function() {
                var $this = $(this);
                $this
                    .clone()
                    .attr("class", "site-nav-wrap")
                    .appendTo(".site-mobile-menu-body");
            });

            setTimeout(function() {
                var counter = 0;
                $(".site-mobile-menu .has-children").each(function() {
                    var $this = $(this);

                    $this.prepend('<span class="arrow-collapse collapsed">');

                    $this.find(".arrow-collapse").attr({
                        "data-bs-toggle": "collapse",
                        "data-bs-target": "#collapseItem" + counter,
                    });

                    $this.find("> ul").attr({
                        class: "collapse",
                        id: "collapseItem" + counter,
                    });

                    counter++;
                });
            }, 1000);

            $("body").on("click", ".arrow-collapse", function(e) {
                var $this = $(this);
                if ($this.closest("li").find(".collapse").hasClass("show")) {
                    $this.removeClass("active");
                } else {
                    $this.addClass("active");
                }
                e.preventDefault();
            });

            $(window).resize(function() {
                var $this = $(this),
                    w = $this.width();

                if (w > 768) {
                    if ($("body").hasClass("offcanvas-menu")) {
                        $("body").removeClass("offcanvas-menu");
                    }
                }
            });

            $("body").on("click", ".js-menu-toggle", function(e) {
                var $this = $(this);
                e.preventDefault();

                if ($("body").hasClass("offcanvas-menu")) {
                    $("body").removeClass("offcanvas-menu");
                    $this.removeClass("active");
                } else {
                    $("body").addClass("offcanvas-menu");
                    $this.addClass("active");
                }
            });

            // click outisde offcanvas
            $(document).mouseup(function(e) {
                var container = $(".site-mobile-menu");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    if ($("body").hasClass("offcanvas-menu")) {
                        $("body").removeClass("offcanvas-menu");
                    }
                }
            });
        };
        siteMenuClone();
    });
});




const rangeInput = document.querySelectorAll(".range-input input"),
    priceInput = document.querySelectorAll(".price-input input"),
    range = document.querySelector(".slider .progress");
let priceGap = 1000;

priceInput.forEach((input) => {
    input.addEventListener("input", (e) => {
        let minPrice = parseInt(priceInput[0].value),
            maxPrice = parseInt(priceInput[1].value);

        if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
            if (e.target.className === "input-min") {
                rangeInput[0].value = minPrice;
                range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
            } else {
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});

rangeInput.forEach((input) => {
    input.addEventListener("input", (e) => {
        let minVal = parseInt(rangeInput[0].value),
            maxVal = parseInt(rangeInput[1].value);

        if (maxVal - minVal < priceGap) {
            if (e.target.className === "range-min") {
                rangeInput[0].value = maxVal - priceGap;
            } else {
                rangeInput[1].value = minVal + priceGap;
            }
        } else {
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});
if ($(window).width() < 991) {
  $(".mobile_search_icon").click(function () {
    $(".search_form").toggleClass("d-none");
  });

  $('body').on('click', function (e) {
    if (!$(e.target).closest('.search_form, .mobile_search_icon').length) {
      $(".search_form").addClass("d-none");
    }
  });
}



// mobile_search_icon
// mobile_search_row
// Scroll Top 
const button = document.querySelector('.scroll_top_btn');
const displayButton = () => {
    window.addEventListener('scroll', () => {
        console.log(window.scrollY);

        if (window.scrollY > 100) {
            button.style.opacity = 1;
        } else {
            button.style.opacity = 0;
        }
    });
};
const scrollToTop = () => {
    button.addEventListener("click", () => {
        window.scroll({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
    });
};
displayButton();
scrollToTop();