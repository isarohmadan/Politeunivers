document.addEventListener('DOMContentLoaded', function() {
document.getElementById('read-more-btn').addEventListener('click', toggleReadMore);
})

function toggleReadMore() {
    const aboutText = document.getElementById('about-description-wrapper');
    const btn = document.getElementById('read-more-btn');
    if (aboutText.classList.contains('text-short')) {
        aboutText.style.height = aboutText.scrollHeight + 'px'; // Mengatur tinggi menjadi tinggi scroll-nya
        aboutText.classList.remove('text-short');
        aboutText.classList.add('text-full');
        btn.textContent = 'Read Less';
        document.getElementById('about_title').scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        aboutText.style.height = '150px'; // Kembali ke tinggi awal
        aboutText.classList.remove('text-full');
        aboutText.classList.add('text-short');
        btn.textContent = 'Read More';
    }

            // Animasi scroll jika teks disingkat kembali
     
  }



