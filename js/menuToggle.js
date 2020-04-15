function toggleMenu(){
	var menu = document.getElementById('navbarTogglerDemo02');
	if(menu.style.display == 'none') menu.style.display = 'block';
	else menu.style.display = 'none';

}
function myLoad(){
	var el = document.getElementById('navbar-toggler');
	el.addEventListener('click', toggleMenu);
}
document.addEventListener('DOMContentLoaded', myLoad);