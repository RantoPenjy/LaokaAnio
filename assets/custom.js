jQuery(function(){
    $("#randomBtnSpinner").hide();
    $("#submitBtnSpinner").hide();
    $("#randomBtn").on('click', function (e) {
        e.preventDefault();
        $("#randomBtnSpinner").removeAttr('hidden').show();
        $("#randomBtnText").hide();
        $.ajax({
            url: window.location.origin + "/plat/random",
            type: "GET",
            success: function (response) {
                $("#randomBtnText").show().text('Hisafidy hafa');
                $("#randomBtnSpinner").hide();
                let result = "👉 " + response + " 👈";
                $("#randomResult").addClass('animate__animated animate__zoomIn').text(result);
                $("#randomResult").css("opacity", 1);
                /*anime({
                    targets: ["#randomResult", "#showRecipeLink"],
                    opacity: [0, 1],
                    duration: 1000,
                    easing: 'easeInOutQuad',
                })*/
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log('Ajax request failed.');
            }
        })
    })
})
