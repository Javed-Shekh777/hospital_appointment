const swiper = new Swiper(".mySwiper", {
    loop: true,
    speed: 600,
    autoplay: {
        delay: 5000,
    },
    slidesPerView: "auto",
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        type: "bullets",
        clickable: true,
    },
});

const filterIcon = document.getElementById("filter-icon");
const filterOptions = document.getElementById("doctor-filter");
const profileBtn = document.getElementById("profile-dropdown");
const profileMenus = document.getElementById("profile-dropdown-menus");
const sidebarBtn = document.getElementById("sidebarBtn");
const sidebar = document.getElementById("sidebar");

const showProfileFormBtn = document.getElementById("profile-form-btn")
const closeProfileFormBtn = document.getElementById("profile-form-close")

const showProfileForm = document.getElementById("profile-form")
const forum = document.getElementById("forum")






window.addEventListener("DOMContentLoaded",()=>{

    profileBtn?.addEventListener("click",()=>{
        profileMenus.classList.toggle("active");
    })
    filterIcon?.addEventListener("click", () => {
        filterOptions.classList.toggle("active");
    });
    
    
    sidebarBtn?.addEventListener("click",()=>{
        sidebar.classList.toggle("active");
    })
     
     
    
    showProfileFormBtn?.addEventListener("click",()=>{
        showProfileForm.classList.add('active');
        forum.classList.remove('active');
    });
    
    closeProfileFormBtn?.addEventListener("click",()=>{
        showProfileForm.classList.remove('active');
        forum.classList.add('active');
    });
        
})
 