(function () {
    // Variables
    var $curve = document.getElementById("curve");
    var last_known_scroll_position = 0;
    var defaultCurveValue = 350;
    var curveRate = 3;
    var ticking = false;
    var curveValue;

    // Handle the functionality
    function scrollEvent(scrollPos) {
        if (scrollPos >= 0 && scrollPos < defaultCurveValue) {
            curveValue = defaultCurveValue - parseFloat(scrollPos / curveRate);
            $curve.setAttribute(
                "d",
                "M 800 300 Q 400 " +
                    curveValue +
                    " 0 300 L 0 0 L 800 0 L 800 300 Z"
            );
        }
    }

    // Scroll Listener
    // https://developer.mozilla.org/en-US/docs/Web/Events/scroll
    window.addEventListener("scroll", function (e) {
        last_known_scroll_position = window.scrollY;

        if (!ticking) {
            window.requestAnimationFrame(function () {
                scrollEvent(last_known_scroll_position);
                ticking = false;
            });
        }

        ticking = true;
    });
})();

// Animación de escritura para el textarea
document.addEventListener("DOMContentLoaded", function () {
    const textArea = document.getElementById("textExample");
    const button = document.getElementById("text");

    function animateText(textArea) {
        let text = textArea.value;
        let to = text.length,
            from = 0;

        animate({
            duration: 5000,
            timing: bounce,
            draw: function (progress) {
                let result = (to - from) * progress + from;
                textArea.value = text.slice(0, Math.ceil(result));
            },
        });
    }

    function bounce(timeFraction) {
        for (let a = 0, b = 1; 1; a += b, b /= 2) {
            if (timeFraction >= (7 - 4 * a) / 11) {
                return (
                    -Math.pow((11 - 6 * a - 11 * timeFraction) / 4, 2) +
                    Math.pow(b, 2)
                );
            }
        }
    }

    if (button && textArea) {
        button.addEventListener("click", function () {
            animateText(textArea);
        });
    }
});
