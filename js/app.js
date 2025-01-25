document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelector('.dropdown-menu-shop');
    const subMenu = document.getElementById('primary-menu-overlay');
    let timeout;
  
    menuItems.addEventListener('mouseover', () => {
      clearTimeout(timeout); // Hapus timeout yang sedang berjalan
      subMenu.classList.add('show');
      subMenu.classList.remove('hidden');
    });
  
    subMenu.addEventListener('mouseover', () => {
      clearTimeout(timeout); // Hapus timeout yang sedang berjalan
      subMenu.classList.add('show');
      subMenu.classList.remove('hidden');
    });
  
    menuItems.addEventListener('mouseout', () => {
      timeout = setTimeout(() => {
        subMenu.classList.remove('show');
        subMenu.classList.add('hidden');
      }, 200); // Tutup submenu setelah 1 detik
    });
  
    subMenu.addEventListener('mouseout', () => {
      timeout = setTimeout(() => {
        subMenu.classList.remove('show');
        subMenu.classList.add('hidden');
      },200); // Tutup submenu setelah 1 detik
    });
  });



 function openNav() {
    document.getElementById("mobile-menu-overlay").classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeNav() {
    document.getElementById("mobile-menu-overlay").classList.remove("active");
    document.body.style.overflow = "";
}