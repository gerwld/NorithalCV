// top jump
(() => {
  "use strict";
  const addClassOnScroll = () => {
    if (window.scrollY > 50) {
      document.documentElement.classList.add("mv_top50");
    } else {
      document.documentElement.classList.remove("mv_top50");
    }
  };
  window.addEventListener("scroll", addClassOnScroll);
})();


// mobile menu
(() => {
  "use strict";
  const mobileMenuBTN = document.getElementById("ltbtn_mobmenu");
  const currentMenu = document.querySelector(".header_navigation");


  const onDocumentClick = (e) => {
    // if button
    if (e.target === mobileMenuBTN || mobileMenuBTN.contains(e.target)) {
      document.documentElement.classList.toggle("lt_mob_menu_opened")
    }
    // if other buttons in menu 
    else if (e.target.tagName === "BUTTON" && (e.target === currentMenu || currentMenu && currentMenu?.contains(e.target))) {
      return;
    }
    // if menu content
    else if ((e.target === currentMenu || currentMenu && currentMenu?.contains(e.target))) {
      setTimeout(() => {
        document.documentElement.classList.remove("lt_mob_menu_opened")
      }, 200)
    }
    // else close
    else document.documentElement.classList.remove("lt_mob_menu_opened")
  };

  // to prevent multiple DOM listener initializations
  if (!document.documentElement.hasAttribute("data-mbmenu-listener0")) {
    document.addEventListener("click", onDocumentClick);
    document.documentElement.setAttribute("data-mbmenu-listener0", "true");
  }
})();