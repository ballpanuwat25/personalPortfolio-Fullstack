/*-------------- Show Menu --------------*/
const showMenu = (toggleId,navId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId)

    if(toggle && nav){
        toggle.addEventListener('click', () => {
            nav.classList.toggle('show-menu')
        })
    }
}
showMenu('nav-toggle', 'nav-menu')

/*-------------- Remove Menu Moblie --------------*/
const navLink = document.querySelectorAll('nav__link')

function linkAction(){
    const navMenu = document.getElementById('nav-menu')
    navMenu.classList.remove('show-menu')
}
navLink.forEach(n => n.addEventListener('click', linkAction))

/*-------------- Scroll Section Active Link --------------*/
const sections = document.querySelectorAll('section[id]')

function scrollActive(){
    const scrollY = window.pageYOffset

    sections.forEach(current =>{
        const sectionHeight = current.offsetHeight
        const sectionTop = current.offsetTop - 50
        sectionId = current.getAttribute('id')

        if(scrollY > sectionTop && scrollY <= sectionTop + sectionHeight){
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.add('active-link')
        }else{
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.remove('active-link')
        }
    })
}
window.addEventListener('scroll', scrollActive)

/*-------------- Change background Header --------------*/
function scrollHeader(){
    const header = document.getElementById('header')
    if(this.scrollY >= 200) header.classList.add('scroll-header');
    else header.classList.remove('scroll-header')
}
window.addEventListener('scroll', scrollHeader)

/*-------------- Show Scroll Top --------------*/
function scrollTop(){
    const scrollTop = document.getElementById('scroll-top')
    if(this.scrollY >= 560) scrollTop.classList.add('show-scroll');
    else scrollTop.classList.remove('show-scroll')
}
window.addEventListener('scroll', scrollTop)

/*-------------- GSAP Animation --------------*/
gsap.from('.home__img', {opacity: 0, duration: 2, delay:.5, x:60})
gsap.from('.home__data', {opacity: 0, duration: 2, delay:.8, y:25})
gsap.from('.home__greeting, .home__name, .home__profession', {opacity: 0, duration: 2, delay: 1, y: 25, ease:'expo.out', stagger:.2})

gsap.from('.nav__logo, .nav__toggle', {opacity: 0, duration: 2, delay: 1.5, y: 25, ease:'expo.out', stagger:.2})
gsap.from('.nav__item', {opacity: 0, duration: 2, delay: 1.8, y: 25, ease:'expo.out', stagger:.2})
gsap.from('.home__social-icon', {opacity: 0, duration: 2, delay: 2.3, y: 25, ease:'expo.out', stagger:.2})

/*-------------- Matrix Background --------------*/
const canvas = document.getElementById('canvas1');
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const canvas2 = document.getElementById('canvas2');
const ctx2 = canvas2.getContext('2d');
canvas2.width = window.innerWidth;
canvas2.height = window.innerHeight;

ctx2.shadowOffsetX = 1;
ctx2.shadowOffsetY = 1;
ctx2.shadowBlur = 0;
ctx2.shadowColor = 'white';

class Symbol {
    constructor(x, y, fontSize, canvasHeight){
        this.characters = 'PANUWAT PISAVONG';
        this.x = x;
        this.y = y;
        this.fontSize = fontSize;
        this.text = 'A';
        this.canvasHeight = canvasHeight;
        this.color = 'hsl(' + this.x * 3+ ', 100%, 50%)';
    }
    draw(context, context2){
        //context.font = this.fontSize + 'px monospace';
        this.text = this.characters.charAt(Math.floor(Math.random() * this.characters.length));
        //context.fillStyle = this.color;
        context.fillText(this.text, this.x * this.fontSize, this.y * this.fontSize);
        context2.fillText(this.text, this.x * this.fontSize, this.y * this.fontSize);
        if (this.y * this.fontSize > this.canvasHeight && Math.random() > 0.97){
            this.y = 0;
        }
        else {
            this.y += 0.9;
        }
    }
}

class Effect {
    constructor(canvasWidth, canvasHeight){
        this.fontSize = 16;
        this.canvasWidth = canvasWidth;
        this.canvasHeight = canvasHeight;
        this.columns = this.canvasWidth/this.fontSize;
        this.symbols = [];
        this.#initialize();
    }
    #initialize(){
        for (let i = 0; i < this.columns; i++) {
            this.symbols[i] = new Symbol(i, 0, this.fontSize, this.canvasHeight);
        }
    }
    resize(width, height){
        this.canvasWidth = width;
        this.canvasHeight = height;
        this.columns = this.canvasWidth/this.fontSize;
        this.symbols = [];
        this.#initialize();
    }
}
const effect = new Effect(canvas.width, canvas.height);
let lastTime = 0;
const fps = 26;
const nextFrame = 1000/fps;
let timer = 0;

function animate(timeStamp){
    const deltaTime = timeStamp - lastTime;
    lastTime = timeStamp;
    if (timer > nextFrame){
        ctx.textAlign = "center";
        ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        ctx.font = effect.fontSize + 'px monospace';
        ctx.fillStyle = '#00c261';
 

        ctx2.textAlign = "center";
        ctx2.clearRect(0, 0, canvas.width, canvas.height);
        ctx2.font = effect.fontSize + 'px monospace';
        ctx2.fillStyle = 'white';

        effect.symbols.forEach(symbol => symbol.draw(ctx, ctx2));
        timer = 0;
    } else {
        timer += deltaTime;
    }
    requestAnimationFrame(animate);
}
animate(0);

window.addEventListener('resize', function(){
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    canvas2.width = window.innerWidth;
    canvas2.height = window.innerHeight;
    effect.resize(canvas.width, canvas.height);
})