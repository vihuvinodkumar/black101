$(function () {
    var animationend = true;
    var currentEle = "topEle";

    /**
     * handle crousel mousewheel event
     */
    $(".carousel").on("mousewheel", function (e) {
        if (animationend && e.deltaY < 0 && currentEle === "bottomEle") return;
        if (animationend && e.deltaY > 0 && currentEle === "topEle") return;

        if (animationend) {
            if (e.deltaY < 0) {
                $(".carousel").addClass("bottom");
                currentEle = "bottomEle";
            } else {
                $(".carousel").removeClass("bottom");
                currentEle = "topEle";
            }
        }

        animationend = false;
    });

    /**
     * handle scroll on mobiles browsers
     */
    $(".carousel").on("scrollstart", function (e) {
        var windowHeight = Math.round($(window).height() * 2.05);
        var transformedEle = Math.round(
            parseInt($(".carousel-content").css("transform").split(",")[5]) * -1
        );

        if (!transformedEle) {
            transformedEle = 0;
        }

        if (currentEle === "topEle" && transformedEle === 0) {
            if (animationend) {
                $(".carousel").addClass("bottom");
            }
        }

        if (currentEle === "bottomEle" && transformedEle >= windowHeight - 50) {
            if (animationend) {
                $(".carousel").removeClass("bottom");
            }
        }

        currentEle === "topEle"
            ? (currentEle = "bottomEle")
            : (currentEle = "topEle");
    });

    $(".carousel .carousel-content").on(
        "transitionend webkitTransitionend oTransitionend",
        function (e) {
            if ($(e.target).hasClass("carousel-content")) {
                animationend = true;
                console.log("end");
            }
        }
    );
});
