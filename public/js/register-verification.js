const countdownTimer = document.getElementById("countdown-timer");
const resendText = document.getElementById("resend-text");
const counter = 60;

function formatTime(time) {
    const minutes = Math.floor(time / 60);
    const seconds = time % 60;
    const formattedMinutes = minutes.toString().padStart(2, "0");
    const formattedSeconds = seconds.toString().padStart(2, "0");
    return `${formattedMinutes}:${formattedSeconds}`;
}

function startCountdown() {
    let count = counter;
    countdownTimer.style.display = "inline";
    resendText.style.display = "none";
    countdownTimer.textContent = `${formatTime(count)}`;
    const intervalId = setInterval(() => {
        count--;
        if (count >= 0) {
            countdownTimer.textContent = `${formatTime(count)}`;
        } else {
            clearInterval(intervalId);
            countdownTimer.style.display = "none";
            resendText.style.display = "inline";
        }
    }, 1000);
}

resendText.addEventListener("click", startCountdown);