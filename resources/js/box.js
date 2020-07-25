export default function () {
    let startX = 0;
    let startY = 0;

    let currentPopUp = null;

    let currentLeft = 0;
    let currentTop = 0;

    let move = false;

    let marginStop = 30;

    let maxWidth = window.innerWidth - marginStop;
    let maxHeight = window.innerHeight - marginStop;

    /**
     * Ao movimentar o elemento, guarda a nova posição, ou seja, a distância até a margem esquerda e a distância até o topo.
     */
    jQuery('.popup .title').on('mousedown', function (e) {
        currentPopUp = this.parentNode;

        currentLeft = parseInt(currentPopUp.style.left, 10);
        currentTop = parseInt(currentPopUp.style.top, 10);

        startX = e.clientX;
        startY = e.clientY;

        move = true;
    });

    window.addEventListener("mouseup", () => {
        if (currentPopUp == null) {
            return;
        }

        if (jQuery(event.target.parentNode).attr('class') === 'close-popup') {
            $(".popup").remove();
        }

        currentPopUp = null;
        move = false;
    });

    jQuery(document).on('mousemove', function (e) {
        if (move == true) {
            var newX = currentLeft + e.clientX - startX;
            var newY = currentTop + e.clientY - startY;

            if (marginStop > e.clientX) return;
            if (marginStop > e.clientY) return;
            if (maxWidth < e.clientX) return;
            if (maxHeight < e.clientY) return;

            jQuery(currentPopUp).css({
                'left': newX,
                'top': newY,
            });
        }
    });
};