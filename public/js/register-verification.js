// const countdownTimer = document.getElementById("countdown-timer");
// const resendText = document.getElementById("resend-text");
// const counter = 60;
// let intervalId;

// function formatTime(time) {
//   const minutes = Math.floor(time / 60);
//   const seconds = time % 60;
//   const formattedMinutes = minutes.toString().padStart(2, "0");
//   const formattedSeconds = seconds.toString().padStart(2, "0");
//   return `${formattedMinutes}:${formattedSeconds}`;
// }

// function startCountdown() {
//   let count = counter;
//   countdownTimer.style.display = "inline";
//   resendText.style.display = "none";
//   countdownTimer.textContent = `${formatTime(count)}`;

//   intervalId = setInterval(() => {
//     count--;
//     if (count >= 0) {
//       countdownTimer.textContent = `${formatTime(count)}`;
//     } else {
//       clearInterval(intervalId);
//       countdownTimer.style.display = "none";
//       resendText.style.display = "inline";
//       intervalId = null; // Reset intervalId to null when the timer ends
//     }
//   }, 1000);
// }

// resendText.addEventListener("click", () => {
//   startCountdown(); // Start the countdown again
//   $.ajax({
//     url: '{{route(user.resend.code)}}',
//     type: 'POST',
//     data: {_token:"{{@csrf}}"},
//     success: function(response) {
//       // Handle the success response here
//       console.log(response);
//       // Example: Start the countdown and update UI
//       startCountdown();
//     },
//     error: function(error) {
//       // Handle the error response here
//       console.error(error);
//       // Example: Show an error message to the user
//       alert('Failed to resend the code. Please try again.');
//     }
//   });
// });




// startCountdown();
