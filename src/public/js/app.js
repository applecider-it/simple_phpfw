console.log('app');

const btn = document.getElementById('app-nav-mobile-menu-button');
const area = document.getElementById('app-nav-mobile-menu-area');

if (btn && area) {
  btn.addEventListener('click', () => {
    area.classList.toggle('app-header-responsive-links-open'); // ← これ！
  });
}