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
(() => {
  "use strict";
  const STORAGE_KEY = "lwt_theme";
  const HTML_CLASS = "lwt_dark_mode";

  let currentTheme = localStorage.getItem(STORAGE_KEY) || "light";
  const toggleButtons = document.querySelectorAll("#ltbtn_theme");


  const changeBtnIcon = (theme) => {
    toggleButtons?.forEach(toggleButton => {
      const darkIcon = toggleButton.querySelector("svg.dark");
      const lightIcon = toggleButton.querySelector("svg.light");
      if (theme !== "dark") {
        darkIcon?.classList.add("hidden");
        lightIcon?.classList.remove("hidden");
      } else {
        darkIcon?.classList.remove("hidden");
        lightIcon?.classList.add("hidden");
      }
    })
  };

  const setCSSClass = (theme) => {
    if (theme === "dark") {
      // document.documentElement.classList.add(HTML_CLASS)
      document.documentElement.setAttribute("data-theme", "dark");
    } else {
      // document.documentElement.classList.remove(HTML_CLASS)
      document.documentElement.setAttribute("data-theme", "light");
    }
  }

  const initializeFromState = (theme) => {
    changeBtnIcon(theme);
    setCSSClass(theme);
  }

  // TOGGLE BUTTON HANDLE
  document.addEventListener("click", (e) => {
    toggleButtons?.forEach(toggleButton => {
      if (toggleButton.contains(e.target)) {
        if (currentTheme !== "dark") {
          currentTheme = "dark";
          localStorage.setItem(STORAGE_KEY, "dark");
          changeBtnIcon("dark");
          setCSSClass("dark");
        } else {
          currentTheme = "light";
          localStorage.setItem(STORAGE_KEY, "light");
          changeBtnIcon("light");
          setCSSClass("light");
        }
      }
    })
  })

  // INITIALIZATION
  initializeFromState(currentTheme)

})();