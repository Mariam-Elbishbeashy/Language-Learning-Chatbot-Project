window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const isSignup = urlParams.get('signup');
    const flipElement = document.getElementById('flip');
    const container = document.querySelector('.container');
  
    // Disable animation initially
    container.classList.add('no-animation');
  
    if (isSignup === 'true') {
      flipElement.checked = true; // Flip to sign-up form
    }
  
    // Remove the no-animation class once a user clicks to toggle forms
    flipElement.addEventListener('change', function() {
      container.classList.remove('no-animation');
    });
  };
  