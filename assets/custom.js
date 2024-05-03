jQuery(function(){
    $("#randomBtnSpinner").hide();
    $("#submitBtnSpinner").hide();
    $("#randomBtn").on('click', function (e) {
        e.preventDefault();
        $("#randomBtnSpinner").removeAttr('hidden').show();
        $("#randomBtnText").hide();
        $("#showRecipeLink").hide();
        $.ajax({
            url: window.location.origin + "/plat/random",
            type: "GET",
            success: function (response) {
                setTimeout(function() {
                    $("#randomBtnText").show().text('Hisafidy hafa');
                    $("#randomBtnSpinner").hide();
                    let result;
                    if (window.innerWidth > 580) {
                        result = "👉 " + response + " 👈";
                    }
                    else {
                        result = response;
                    }
                    $("#randomResult").addClass('animate__animated animate__zoomIn').text(result);
                    $("#randomResult").css("opacity", 1);
                    $("#showRecipeLink").css("opacity", 1).css("cursor", "pointer").show();

                }, 2000);
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log('Ajax request failed.');
            }
        })
    })

    if ($(window).width() > 580) {
        console.log($("#randomResult").text())
    }
})
