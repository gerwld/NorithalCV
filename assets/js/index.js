// Dynamically manage the 'mv_top50' class based on scroll position
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


// Handles mobile menu interactions and toggle functionality
(() => {
  "use strict";
  const mobileMenuBTN = document.getElementById("ltbtn_mobmenu");
  const currentMenu = document.querySelector(".header_navigation");


  const onDocumentClick = (e) => {
    // Check if the mobile menu button was clicked
    if (e.target === mobileMenuBTN || mobileMenuBTN.contains(e.target)) {
      document.documentElement.classList.toggle("lt_mob_menu_opened")
    }
     // Allow interaction with buttons within the menu without closing it
    else if (e.target.tagName === "BUTTON" && (e.target === currentMenu || currentMenu && currentMenu?.contains(e.target))) {
      return;
    }
    // Close the menu when clicking inside its content after a slight delay
    else if ((e.target === currentMenu || currentMenu && currentMenu?.contains(e.target))) {
      setTimeout(() => {
        document.documentElement.classList.remove("lt_mob_menu_opened")
      }, 200)
    }
    // Else close
    else document.documentElement.classList.remove("lt_mob_menu_opened")
  };

  // to prevent multiple DOM listener initializations
  if (!document.documentElement.hasAttribute("data-mbmenu-listener0")) {
    document.addEventListener("click", onDocumentClick);
    document.documentElement.setAttribute("data-mbmenu-listener0", "true");
  }
})();

// manages theme toggle functionality, including state persistence and icon updates
(() => {
  "use strict";
  const STORAGE_KEY = "lwt_theme";

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
      document.documentElement.setAttribute("data-theme", "dark");
    } else {
      document.documentElement.setAttribute("data-theme", "light");
    }
  }

  const initializeFromState = (theme) => {
    changeBtnIcon(theme);
    setCSSClass(theme);
  }

  // Handle theme toggle button interactions
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

  // Initialize the theme based on the persisted state
  initializeFromState(currentTheme)

})();