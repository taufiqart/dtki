
var meta = `<meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
			<meta http-equiv="expires" content="0">
			<meta http-equiv="pragma" content="no-cache">`;

var css =  `<link rel="stylesheet" href="/css/bootstrap.css">
			<link href="/css/fontawesome-5/css/all.min.css" rel="stylesheet" type="text/css">
			<link rel="stylesheet" href="/css/style.css">
			<link rel="stylesheet" href="/css/css/animate.css">
			<link rel="stylesheet" href="/css/navAndFooter.css">
			<link rel="icon" href="/img/Lambang-DTKI-32x32.png">`;
function sleep(time) {
	return new Promise((resolve) => setTimeout(resolve, time));
}
sleep(5).then(() => {
	var pb = document.querySelector('.pb-6')
	if (pb != undefined){
		pb.parentElement.removeChild(pb)
	}
	document.querySelector('body')
	var head = document.querySelector('head')
	head.innerHTML = meta+head.innerHTML;
	head.innerHTML += css;
	const navbar = "/navbar.html"
	const footer = "/footer.html"
	var body = document.querySelector('body')
	body.classList.add('min-vh-100','d-flex','flex-column')
	fetch(navbar)
		.then(r => r.text())
		.then(t => body.innerHTML = t + body.innerHTML)
	fetch(footer)
		.then(r => r.text())
		.then(t => body.innerHTML += t)

})


// EXAMPLE
window.addEventListener('scroll', function(event) {
	var s = window.scrollY + window.outerHeight / 2
	var h = document.documentElement.offsetHeight
	var h4 = h / 4
	if (s <= h4 + h4 / 1.5) {
		document.documentElement.style.setProperty('--scroll-gradient', 'linear-gradient(54deg, #41b941, darkgreen)');
		document.documentElement.style.setProperty('--scroll-hover', 'linear-gradient(54deg, darkgreen, #41b941)');
	} else if (s >= h4 + h4 / 1.5 && s <= h4 * 2.5) {
		document.documentElement.style.setProperty('--scroll-gradient', 'linear-gradient(54deg, #007ad1,#41b941)');
		document.documentElement.style.setProperty('--scroll-hover', 'linear-gradient(54deg, #41b941 ,#007ad1)');
	} else if (s >= h4 * 2.5) {
		document.documentElement.style.setProperty('--scroll-gradient', 'linear-gradient(30deg,#001734,#007ad1)');
		document.documentElement.style.setProperty('--scroll-hover', 'linear-gradient(30deg,#007ad1,#001734)');
	}
});

window.onload = function(){
	

	var anim = document.querySelectorAll('.animated')
	anim.forEach(function(e){
		e.classList.add('fadeInUp');
	});
	var buttons = document.querySelectorAll('.btn');
	buttons.forEach(btn => {
		btn.addEventListener('click', function(e){

			let x = e.clientX - e.target.offsetLeft;
			let y = e.clientY - e.target.offsetTop;

			let ripples = document.createElement('span');
			ripples.classList.add('ripple')
			ripples.style.left = x + 'px';
			ripples.style.top = y + 'px';
			this.appendChild(ripples)

			setTimeout(() => {
				ripples.remove()
			},1000)
		})
	})
}
window.addEventListener('scroll', function(event){
	var x= document.querySelectorAll('.animated')
	var y= window.scrollY
	x.forEach(function(e){
		var s = e.offsetTop-window.innerHeight+50
		if (document.body.scrollHeight < 1500){
			e.classList.add('fadeInUp')
			e.classList.remove('fadeOutDown')
		}else{
			if(y>s){
				e.classList.add('fadeInUp')
				e.classList.remove('fadeOutDown')
				// e.style = 'visibility: visible;'
			}else{
				e.classList.add('fadeOutDown')
				e.classList.remove('fadeInUp')
				// e.style = 'visibility: hidden;'
			}
		}
	})
})


// window.addEventListener('scroll', function(event){
window.onload = function(){
	try{
		window.onscroll = function(){scroll()}
		// var navbar = document.querySelector('.navbar')
		var navbar = document.querySelector('#navbar')
		var content = document.querySelector('.header')
		var logo = document.querySelector('.img-nav')
		var dtki = document.querySelector('.navbar-brand')
		var sticky = navbar.offsetTop
		function scroll(){
			if(window.pageYOffset >= sticky){
				navbar.classList.add('fixed-top');
				content.classList.add('pb-6');
				logo.classList.remove('d-none');
				dtki.innerHTML = 'DTKI'
			}else{
				navbar.classList.remove('fixed-top');
				content.classList.remove('pb-6');
				logo.classList.add('d-none');
				dtki.innerHTML = 'Home'
			}
		}
	}catch(err){
		console.log()
	}
}
