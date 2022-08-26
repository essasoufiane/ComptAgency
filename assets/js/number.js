let valueDisplays = document.querySelectorAll(".num");

let interval = 1500;

const sectionNumber = document.querySelector('.sectionNumber');

const $i = 0;
window.addEventListener('scroll', () => {

    const { scrollTop, clientHeight } = document.documentElement;

    const topElementToTopViewport = sectionNumber.getBoundingClientRect().top;

    if (scrollTop > (scrollTop + topElementToTopViewport).toFixed() - clientHeight * 0.80) {

        valueDisplays.forEach(valueDisplays => {
            let startValue = 0;
            let endValue = parseInt(valueDisplays.getAttribute("data-val"));
            let duration = Math.floor(interval / endValue);
            let counter = setInterval(function () {
                startValue += 1;
                valueDisplays.textContent = startValue;
                if (startValue == endValue) {
                    clearInterval(counter);
                }
            }, duration);
        });

    }
})


