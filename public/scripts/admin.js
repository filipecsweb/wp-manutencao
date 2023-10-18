(function () {
    const select = document.querySelector('select[name*="maintenance_type"]');

    if ("page" === select.value || "redirect" === select.value) {
        const activeTables = document.querySelectorAll(".form-table." + select.value + "_type");
        activeTables.forEach(function (table) {
            table.classList.add("active");
        });
    }

    select.addEventListener("change", function () {
        let activeTables = document.querySelectorAll(".form-table.active");
        activeTables.forEach(function (table) {
            table.classList.remove("active");
        });

        if ("page" === this.value || "redirect" === this.value) {
            activeTables = document.querySelectorAll(".form-table." + this.value + "_type");
            activeTables.forEach(function (table) {
                table.classList.add("active");
            });
        }
    });

    const display_section = function (element) {
        const sections = document.querySelectorAll(".section");
        sections.forEach(function (section) {
            section.classList.remove("active");
        });

        const selector = element.getAttribute("href");
        document.querySelector(selector).classList.add("active");
    }

    document.body.addEventListener("click", function (e) {
        if (e.target && e.target.getAttribute("href") && e.target.getAttribute("href").endsWith("-tab")) {
            e.preventDefault();
            const $this = e.target;

            const tabs = document.querySelectorAll(".wp-manutencao .nav-tab-wrapper a");
            tabs.forEach(function (tab) {
                tab.classList.remove("nav-tab-active");
            });

            $this.classList.add("nav-tab-active");
            display_section($this);
        }
    });
})();