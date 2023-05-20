window.onload = stopPreload();

function stopPreload() {
    setTimeout(function() {
        $('.preloader').remove();
    }, 3000);
}