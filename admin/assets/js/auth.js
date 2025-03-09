
lucide.createIcons();

document.getElementById('togglePassword').addEventListener('click', function() {
  const passwordInput = document.getElementById('password');
  const eyeIcon = document.getElementById('eyeIcon');
  
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    eyeIcon.setAttribute('name', 'eye-off');
  } else {
    passwordInput.type = 'password';
    eyeIcon.setAttribute('name', 'eye');
  }
  
  lucide.createIcons();
});