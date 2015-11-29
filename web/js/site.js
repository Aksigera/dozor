document.addEventListener('DOMContentLoaded', function () {
    var
        timerSecondsDiv = document.getElementsByClassName('timer--seconds')[0],
        timerCountdownDiv = document.getElementsByClassName('timer--countdown')[0];
    var remainingSeconds = +(timerSecondsDiv.innerHTML);
    var timerCountdown = setInterval(function () {
        function PrefInt(number, len) {
            while (String(number).length < len) {
                number = '0' + number;
            }
            return number;
        }

        remainingSeconds -= 1;
        if (remainingSeconds < 0) {
            clearInterval(timerCountdown);
            return
        }
        console.log(PrefInt(2, 2));
        timerCountdownDiv.innerHTML = PrefInt(Math.floor(remainingSeconds / 60), 2) + ':' + PrefInt(remainingSeconds % 60, 2);

    }, 1000)
}, false);