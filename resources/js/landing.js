

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
