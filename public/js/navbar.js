var css = '<link rel="stylesheet" href="/css/bootstrap.css"><link rel="stylesheet" href="/css/navAndFooter.css"><link rel="icon" href="/img/Lambang-DTKI-32x32.png">';

function sleep(time) {
    return new Promise((resolve) => setTimeout(resolve, time));
}
sleep(5).then(() => {
    document.querySelector('body')
    var head = document.querySelector('head')
    head.innerHTML += css;
    const navbar = "/navbar.html"
    const footer = "/footer.html"
    var body = document.querySelector('body')
    fetch(navbar)
        .then(r => r.text())
        .then(t => body.innerHTML = t + body.innerHTML)
    fetch(footer)
        .then(r => r.text())
        .then(t => body.innerHTML += t)
})
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
window.addEventListener('scroll', function(event){
	var x= document.querySelectorAll('.wow')
	var y= window.scrollY
	x.forEach(function(e){
		var s = e.offsetTop-600
		if(y>s){
			e.classList.add('fadeInUp')
			e.classList.remove('fadeOutDown')
			// e.style = 'visibility: visible;'
		}else{
			e.classList.add('fadeOutDown')
			e.classList.remove('fadeInUp')
			// e.style = 'visibility: hidden;'
		}
	})
})
// window.addEventListener('scroll', function(event) {
//     var s = window.scrollY + window.outerHeight / 2
//     var h = document.documentElement.offsetHeight / 2
//     if (s >= h) {
//         document.documentElement.style.setProperty('--scroll-gradient', 'linear-gradient(30deg,#001734,#007ad1)');
//         document.documentElement.style.setProperty('--scroll-hover', 'linear-gradient(30deg,#007ad1,#001734)');
//     } else {
//         document.documentElement.style.setProperty('--scroll-gradient', 'linear-gradient(54deg, #41b941, darkgreen)');
//         document.documentElement.style.setProperty('--scroll-hover', 'linear-gradient(54deg, darkgreen, #41b941)');
//     }
// });