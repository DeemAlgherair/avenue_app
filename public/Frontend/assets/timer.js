
document.addEventListener('DOMContentLoaded', function() {
    function startTimers() {
        // Handle payment timers
        document.querySelectorAll('.timer').forEach(timer => {
            let timerId = timer.id.split('-')[1];
            let payButton = document.getElementById(`pay-button-${timerId}`);
            let timeoutMessage = document.getElementById(`timeout-message-${timerId}`);
            let startTime = parseInt(timer.getAttribute('data-start-time'));
            let duration = parseInt(timer.getAttribute('data-duration')); // Duration in seconds

            let savedTime = localStorage.getItem(`timer1-${timerId}`);
            let remainingTime;

            if (savedTime) {
                remainingTime = parseInt(savedTime);
            } else {
                let elapsedTime = Math.floor(Date.now() / 1000) - startTime;
                remainingTime = duration - elapsedTime;
                remainingTime = Math.max(remainingTime, 0); // Ensure non-negative time
                localStorage.setItem(`timer1-${timerId}`, remainingTime);
            }

            function formatTime(seconds) {
                let minutes = Math.floor(seconds / 60);
                seconds = seconds % 60;
                return `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            }

            let interval = setInterval(function countdown() {
                if (remainingTime <= 0) {
                    clearInterval(interval);
                    payButton.style.display = 'none';
                    timeoutMessage.style.display = 'block';
                    timer.innerHTML = '00:00';

                    // Submit the form to update the status to 4 (not paid)
                    let form = document.getElementById(`update-status-form-${timerId}`);
            if (form) form.submit();
                    
                    localStorage.removeItem(`timer1-${timerId}`);
                    return;
                }

                timer.innerHTML = formatTime(remainingTime);
                remainingTime--;
                localStorage.setItem(`timer1-${timerId}`, remainingTime);
            }, 1000);
        });

        // Handle waiting for approval timers (second timer)
        document.querySelectorAll('.timer-waiting').forEach(timer => {
            let timerId = timer.id.split('-')[2];
            let startTime = parseInt(timer.getAttribute('data-start-time'));
            let duration = parseInt(timer.getAttribute('data-duration')); // Duration in seconds

            let savedTime = localStorage.getItem(`timer-waiting-${timerId}`);
            let remainingTime;

            if (savedTime) {
                remainingTime = parseInt(savedTime);
            } else {
                let elapsedTime = Math.floor(Date.now() / 1000) - startTime;
                remainingTime = duration - elapsedTime;
                remainingTime = Math.max(remainingTime, 0); // Ensure non-negative time
                localStorage.setItem(`timer-waiting-${timerId}`, remainingTime);
            }

            function formatTime(seconds) {
                let minutes = Math.floor(seconds / 60);
                seconds = seconds % 60;
                return `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            }

            let interval = setInterval(function countdown() {
                if (remainingTime <= 0) {
                    clearInterval(interval);
                    timer.innerHTML = '00:00';
                    localStorage.removeItem(`timer-waiting-${timerId}`);

                    // Submit the form to update the status to 5 (not approved)
                    let form = document.getElementById(`update-status-form-${timerId}`);
                     if (form) form.submit();
                }

                timer.innerHTML = formatTime(remainingTime);
                remainingTime--;
                localStorage.setItem(`timer-waiting-${timerId}`, remainingTime);
            }, 1000);
        });
    }

    startTimers();
});
