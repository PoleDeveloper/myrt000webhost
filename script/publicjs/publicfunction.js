
/* disable scroll s */
function disableScroll() { 
    // Get the current page scroll position 
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
  
        // if any scroll is attempted, set this to the previous value 
        window.onscroll = function() { 
            window.scrollTo(scrollLeft, scrollTop);
        }; 
}
function enableScroll() { 
    window.onscroll = function() {}; 
}
/* disable scroll e */

/* save screen position s */
var pjs_last_screen_position_left = null;
var pjs_last_screen_position_top = null;

function get_last_screen_position() {
    localStorage.setItem("pjs_last_screen_position_left", window.pageXOffset || document.documentElement.scrollLeft);
    localStorage.setItem("pjs_last_screen_position_top", window.pageYOffset || document.documentElement.scrollTop);
}
function set_last_screen_position() {
    if (localStorage.pjs_last_screen_position_top != null) {
        window.scrollTo({
            top: localStorage.pjs_last_screen_position_top,
            left: localStorage.pjs_last_screen_position_left,
            behavior: 'smooth'
        });
    }
}
/* save screen position e */

/* redirect link s */
function redirect_link(link) {
    form1op("Peringatan!", "<div class='alert alert-danger'>Kami Tidak Mengetahui Link ini <br><br>"+link+"<br><br> Jika Anda Percaya dan menurut anda link tersebut Aman, Silahkan Klik tombol Buka Link Dibawah</div>", "<a href='"+link+"' target='_blank'><button class='btn btn-success'>Buka Link</button>");
}
/* redirect link e */