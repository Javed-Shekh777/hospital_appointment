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

window.addEventListener("DOMContentLoaded", () => {
    // Variables
    const filterIcon = document.getElementById("filter-icon");
    const filterOptions = document.getElementById("doctor-filter");
    const profileBtn = document.getElementById("profile-dropdown");
    const profileMenus = document.getElementById("profile-dropdown-menus");
    const sidebarBtn = document.getElementById("sidebarBtn");
    const sidebar = document.getElementById("sidebar");

    const showProfileFormBtn = document.getElementById("profile-form-btn");
    const closeProfileFormBtn = document.getElementById("profile-form-close");

    const showProfileForm = document.getElementById("profile-form");
    const forum = document.getElementById("forum");

    profileBtn?.addEventListener("click", () => {
        profileMenus.classList.toggle("active");
    });
    filterIcon?.addEventListener("click", () => {
        filterOptions.classList.toggle("active");
    });

    sidebarBtn?.addEventListener("click", () => {
        sidebar.classList.toggle("active");
    });

    showProfileFormBtn?.addEventListener("click", () => {
        showProfileForm.classList.add("active");
        forum.classList.remove("active");
    });

    closeProfileFormBtn?.addEventListener("click", () => {
        showProfileForm.classList.remove("active");
        forum.classList.add("active");
    });

    document.getElementById("role")?.addEventListener("change", function (e) {
        if (e.target?.value === "doctor") {
            document.getElementById("roleDoctorMax").style.display = "flex";
            document.getElementById("roleDoctorAbout").style.display = "flex";
            document.getElementById("education").style.display = "flex";
            document.getElementById("addSlots").style.display = "block";
        }
    });

    document.getElementById("add_slot")?.addEventListener("click", function () {
        console.log("gdsfdsf");
        let slotContainer = document.getElementById("slot_container");
        let slotRow = document.createElement("div");
        slotRow.classList.add("row", "mt-2");

        slotRow.innerHTML = `
           <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="slot_date" class="form-label">Available Date</label>
                                <input type="date" class="form-control" name="slot_date[]" id="slot_date">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="slot_start_time" class="form-label">Start Time</label>
                                <input type="time" class="form-control" name="slot_start_time[]" id="slot_start_time">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="slot_end_time" class="form-label">End Time</label>
                                <input type="time" class="form-control" name="slot_end_time[]" id="slot_end_time">
                            </div>
                        </div>
            <div class="col-lg-12 mb-3">
                <button type="button" class="btn btn-danger remove_slot">Remove</button>
            </div>
        `;

        slotContainer.appendChild(slotRow);
    });

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove_slot")) {
            e.target.parentElement.parentElement.remove();
        }
    });


    document.getElementById("payHere")?.addEventListener("click",function(e){
        e.target.style.display = "none";
        document.querySelectorAll(".pay").forEach(function(pay){
            pay.style.display = "inline-block";
        })

    })
});

// function selectDate(element, date) {
//     // Sabhi dates se 'active' class hatao
//     document
//         .querySelectorAll(".date .col-auto")
//         .forEach((el) => el.classList.remove("active"));

//     // Selected date ko active banao
//     element.classList.add("active");

//     // AJAX se slots fetch karo
//     fetch(`/get-slots/${date}`)
//         .then((response) => response.json())
//         .then((slots) => {
//             let timeContainer = document.getElementById("time-slots");
//             timeContainer.innerHTML = ""; // Purane slots hatao

//             // Naye slots dikhane ke liye loop
//             slots.forEach((slot) => {
//                 let slotElement = document.createElement("div");
//                 slotElement.classList.add("col-auto");
//                 slotElement.setAttribute(
//                     "onclick",
//                     `selectTime(this, '${slot.start_time}')`
//                 );
//                 slotElement.innerHTML = `<p class="t">${formatTime(
//                     slot.start_time
//                 )}</p>`;
//                 timeContainer.appendChild(slotElement);
//             });
//         });
// }

// // Time format function
// function formatTime(time) {
//     let [hours, minutes] = time.split(":");
//     let ampm = hours >= 12 ? "PM" : "AM";
//     hours = hours % 12 || 12;
//     return `${hours}:${minutes} ${ampm}`;
// }

// function selectTime(element, time) {
//     let timeParts = time.split(" ");
//     let hoursMinutes = timeParts[0].split(":");
//     let hours = parseInt(hoursMinutes[0]);
//     let minutes = hoursMinutes[1];
//     let ampm = timeParts[1];

//     // Convert to 24-hour format
//     if (ampm === "PM" && hours !== 12) {
//         hours += 12;
//     } else if (ampm === "AM" && hours === 12) {
//         hours = 0;
//     }

//     let formattedTime = `${hours.toString().padStart(2, "0")}:${minutes}:00`;

//     document.getElementById("selectedTime").value = formattedTime;

//     document
//         .querySelectorAll(".time .col-auto")
//         .forEach((el) => el.classList.remove("active"));
//     element.classList.add("active");
// }
{
    /* <input type="hidden" value="" name="day" id="selectedDay">
<input type="hidden" value="" name="date" id="selectedDate">
<input type="hidden" value="" name="time" id="selectedTime">
<input type="hidden" name="patient_id" value="{{ auth()->user()->id }}"> */
}
{
    /* <input type="hidden" name="doctor_id" value="{{ $doctor->id }}"> */
}

function selectDate(element, date,slotId) {
    console.log(date);
    document
        .querySelectorAll(".date .col-auto")
        .forEach((el) => el.classList.remove("active"));

    element.classList.add("active");

    document.getElementById("selectedDate").value = date;
    document.getElementById("selectedDay").value = element
        .querySelector(".day")
        .textContent.trim();

    document.getElementById("slotId").value = slotId;    
    document
        .querySelectorAll(".time-slots")
        .forEach((el) => (el.style.display = "none"));
    document.querySelector(`.time-slots[data-date="${date}"]`).style.display =
        "flex";
    document.getElementById("selectedTime").value = "";
}

function selectTime(element, time) {
    document
        .querySelectorAll(".time .col-auto")
        .forEach((el) => el.classList.remove("active"));
    element.classList.add("active");

    let timeParts = time.split(" ");
    let hoursMinutes = timeParts[0].split(":");
    let hours = parseInt(hoursMinutes[0]);
    let minutes = hoursMinutes[1];
    let ampm = timeParts[1];

    // Convert to 24-hour format
    if (ampm === "PM" && hours !== 12) {
        hours += 12;
    } else if (ampm === "AM" && hours === 12) {
        hours = 0;
    }

    let formattedTime = `${hours.toString().padStart(2, "0")}:${minutes}:00`;

    document.getElementById("selectedTime").value = formattedTime;
}
