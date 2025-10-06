document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('#flash-container .flash').forEach(function(flash) {
        setTimeout(function() {
            flash.style.opacity = '0';
            setTimeout(function() { flash.remove(); }, 500);
        }, 3000);
    });
});