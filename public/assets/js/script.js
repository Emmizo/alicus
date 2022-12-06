document.addEventListener("DOMContentLoaded", function (event) {
    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId);

        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener("click", () => {
                nav.classList.toggle("show");
                toggle.classList.toggle("bx-x");
                bodypd.classList.toggle("body-pd");
                headerpd.classList.toggle("body-pd");
            });
        }
    };

    showNavbar("header-toggle", "nav-bar", "body-pd", "header");

    const linkColor = document.querySelectorAll(".nav_link");

    function colorLink() {
        if (linkColor) {
            linkColor.forEach((l) => l.classList.remove("active"));
            this.classList.add("active");
        }
    }
    linkColor.forEach((l) => l.addEventListener("click", colorLink));
});
$(document).on("change", ".select2class", function () {
    var select = $(this).val();
    if (select == "Other") {
        $("#myModalClass").modal("show");
    } else {
        $("#myModalClass").modal("hide");
    }
});

$(document).on("change", ".select2size", function () {
    var select = $(this).val();
    if (select == "Other") {
        $("#myModalSize").modal("show");
    } else {
        $("#myModalSize").modal("hide");
    }
});
$(document).on("change", ".select2Specific", function () {
    var select = $(this).val();
    if (select == "Other") {
        $("#myModalSpecific").modal("show");
    } else {
        $("#myModalSpecific").modal("hide");
    }
});

$(document).on("change", ".select2Heat", function () {
    var select = $(this).val();
    if (select == "Other") {
        $("#myModalHeat").modal("show");
    } else {
        $("#myModalHeat").modal("hide");
    }
});

$(document).on("change", ".select2Component", function () {
    var select = $(this).val();
    if (select == "Other") {
        $("#myModalComponent").modal("show");
    } else {
        $("#myModalComponent").modal("hide");
    }
});

$(document).on("change", ".select2Certificate", function () {
    var select = $(this).val();
    if (select == "Other") {
        var component = $("#component-id").val();
        $("#component_id").val(component);
        $("#myModalCertificate").modal("show");
    } else {
        $("#myModalCertificate").modal("hide");
    }
});

$(document).on("click", ".select2edit", function () {
    $("#myModalEdit").modal("show");
});

function searchData() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            console.log(txtValue);
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

//slider
$(".slider").slick({
    infinite: false,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
    ],
});

$(".slick-slide.slick-current").addClass("active");
$(document).on("click", ".slider li a", function (e) {
    e.stopPropagation();
    e.preventDefault();
    var Id = $(this).attr("href");
    $(".slick-slide").removeClass("active");
    $(this).closest(".slick-slide").addClass("active");
    $(".tab-content-section .tab-content").not(Id).removeClass("active");
    if (Id) {
        $(Id).addClass("active");
    }
});
