const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const containere = document.getElementById('containere');

signUpButton.addEventListener('click', () => {
	containere.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	containere.classList.remove("right-panel-active");
});
