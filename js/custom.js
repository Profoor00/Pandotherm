/*---------------------------------------------------------------------
    File Name: custom.js
---------------------------------------------------------------------*/

$(function () {
    "use strict";

    /* Preloader */
    setTimeout(function () {
        $('.loader_bg').fadeToggle();
    }, 1500);

    /* Tooltip */
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    /* Mouseover */
    $(document).ready(function () {
        $(".main-menu ul li.megamenu").mouseover(function () {
            if (!$(this).parent().hasClass("#wrapper")) {
                $("#wrapper").addClass('overlay');
            }
        });
        $(".main-menu ul li.megamenu").mouseleave(function () {
            $("#wrapper").removeClass('overlay');
        });
    });

    /* Toggle sidebar */
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });

    /* Product slider */
    $('#blogCarousel').carousel({
        interval: 5000
    });
    /* Kereső funkciók */
        function toggleSearch() {
            var searchContainer = document.getElementById('searchContainer');
            var searchInput = document.getElementById('searchInput');
            
            if (searchContainer.style.display === "none" || searchContainer.style.display === "") {
                searchContainer.style.display = "flex";
                searchInput.focus(); // Fókuszál a keresőmezőre
            } else {
                searchContainer.style.display = "none";
            }
        }
    
        function performSearch() {
            var input = document.getElementById('searchInput').value;
            if (input) {
                // Itt lehetne a keresési logikát megvalósítani, pl. átirányítani egy keresési oldalra
                window.location.href = 'search.html?q=' + encodeURIComponent(input);
            } else {
                alert("Kérlek, adj meg egy keresési kifejezést.");
            }
        }
    });

    function toggleFavorite(element) {
        element.classList.toggle('favorited');
     }
     
     $(document).ready(function() {
        $('#comparisonForm').on('submit', function(e) {
            e.preventDefault();
            const product1 = $('#product1').val();
            const product2 = $('#product2').val();
            $('#comparisonResult').html(`
                <h3>Összehasonlítás Eredménye:</h3>
                <p>Első termék: ${$('#product1 option:selected').text()}</p>
                <p>Második termék: ${$('#product2 option:selected').text()}</p>
            `);
        });
    });