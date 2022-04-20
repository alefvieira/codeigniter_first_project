var swiper1 = new Swiper(".mySwiper1", {
    slidesPerView: 6,
    spaceBetween: 30,
    slidesPerGroup: 3,
    loop: true,
    loopFillGroupWithBlank: true,
    pagination: {
    el: ".swiper-pagination",
    clickable: true,
    },
    // navigation: {
    // nextEl: ".swiper-button-next",
    // prevEl: ".swiper-button-prev",
    // },
});

var swiper = new Swiper(".mySwiper", {
    navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
    },
});
