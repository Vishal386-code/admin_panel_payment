/* resources\views\profile\show.blade.php */
$(document).ready(function() {
    $(".toggle-btn").click(function() {
        $(".form-box").addClass("hidden");
        $(".toggle-btn").removeClass("active");
        $($(this).data("target")).removeClass("hidden");
        $(this).addClass("active");
    });
});


