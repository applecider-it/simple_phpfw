/**
 * アプリケーションのセットアップ
 */

console.log("app");

/** メニューをセットアップする */
function setupMenu() {
  const btn = document.getElementById("app-nav-mobile-menu-button");
  const area = document.getElementById("app-nav-mobile-menu-area");

  if (btn && area) {
    btn.addEventListener("click", () => {
      area.classList.toggle("app-nav-responsive-links-open");
    });
  }
}

setupMenu();
