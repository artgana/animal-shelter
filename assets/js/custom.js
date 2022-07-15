/**
 * Init mmenu
 * https://mmenujs.com/mmenu-light/
 * https://github.com/FrDH/mmenu-light/blob/master/demo/default.html
 */
let mainMenu =  document.getElementById('main-menu');
if (typeof(mainMenu) != 'undefined' && mainMenu != null) {
    document.addEventListener(
        "DOMContentLoaded", () => {
            const menu = new MmenuLight(
                document.querySelector("#main-menu"),
                "(max-width: 1000px)"
            );

            const navigator = menu.navigation();
            const drawer = menu.offcanvas({
                position: 'left'
            });

            document.querySelector('a[href="#main-menu"]')
                .addEventListener('click', (evnt) => {
                    evnt.preventDefault();
                    if (document.querySelector('body').classList.contains('mm-ocd-opened')) {
                        drawer.close();
                    } else {
                        drawer.open();
                    }
                });

        }
    );
}
