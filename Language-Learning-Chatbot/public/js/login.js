window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const isSignup = urlParams.get('signup');
    const flipElement = document.getElementById('flip');
    const container = document.querySelector('.container');
  
    container.classList.add('no-animation');
  
    if (isSignup === 'true') {
      flipElement.checked = true; 
    }
  
    flipElement.addEventListener('change', function() {
      container.classList.remove('no-animation');
    });
  };
  