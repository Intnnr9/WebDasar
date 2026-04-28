// 1. Navbar Scroll Effect
window.addEventListener('scroll', function() {
    const nav = document.querySelector('nav');
    if (window.scrollY > 50) {
        nav.style.background = '#ffffff';
        nav.style.padding = '15px 10%';
        nav.style.boxShadow = '0 5px 20px rgba(0,0,0,0.1)';
    } else {
        nav.style.background = '#fff';
        nav.style.padding = '20px 10%';
        nav.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
    }
});

// 2. Scroll Reveal Animation
const reveal = () => {
    const reveals = document.querySelectorAll('.card, .about-text, .about-visual');
    
    reveals.forEach(element => {
        const windowHeight = window.innerHeight;
        const elementTop = element.getBoundingClientRect().top;
        const elementVisible = 150;
        
        if (elementTop < windowHeight - elementVisible) {
            element.classList.add('active');
        }
    });
}

window.addEventListener('scroll', reveal);

// 3. Smooth Scroll untuk Navigasi
document.querySelectorAll('nav a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        
        window.scrollTo({
            top: targetElement.offsetTop - 70, // Offset untuk navbar
            behavior: 'smooth'
        });
    });
});

// 4. Interactive Console Log (Pesan Rahasia)
console.log("%c Selamat Datang Calon Developer! ", "background: #6c5ce7; color: #fff; font-size: 20px; padding: 10px; border-radius: 5px;");
console.log("Coba ubah warna background di style.css untuk bereksperimen!");