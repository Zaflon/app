function parseNumber(num) {
    return parseFloat(num.replace(/[^\d]/)) || 0;
}

var movePopUp = (function () {

    let startX = 0;
    let startY = 0;

    let currentPopUp = null;

    let currentLeft = 0;
    let currentTop = 0;
    let callMoveOnPopUp = null;
    let callMoveStopPopUp = null;

    let move = false;

    let marginStop = 30;

    let maxWidth = window.innerWidth - marginStop;
    let maxHeight = window.innerHeight - marginStop;

    jQuery('.popup .title').on('mousedown', function (e) {
        currentPopUp = this.parentNode;
        currentLeft = parseNumber(currentPopUp.style.left);
        currentTop = parseNumber(currentPopUp.style.top);

        startX = e.clientX;
        startY = e.clientY;

        if (typeof (callMoveOnPopUp) == 'function')
            callMoveOnPopUp(currentPopUp);
        move = true;
    });

    window.addEventListener("mouseup", () => {
        if (currentPopUp == null) {
            return;
        }

        if (jQuery(event.target.parentNode).attr('class') == 'close-popup') {
            $(".popup").remove();
        }

        if (typeof (callMoveStopPopUp) == 'function')
            callMoveStopPopUp(currentPopUp);

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
});

function SETUP() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": jQuery('head>meta[name=csrf-token]').attr('content').toString()
        }
    });
}

function POST() {
    $.ajax({
        url: jQuery("input[name=address]").val().toString(),
        data: $.param({
            _token: jQuery('head>meta[name=csrf-token]').attr('content').toString(),
            color: "blabladab3la",
            hexadecimal: "FFBLHH"
        }),
        type: 'POST',
        context: this,
        success: (response) => {
            console.log(response);
        },
        error: () => {}
    });
}

function del(primaryKey) {
    if (confirm(`Would you like to delete this record #${primaryKey}?`)) {
        $.ajax({
            url: `${jQuery("input[name=address]").val().toString()}/${primaryKey}`,
            data: $.param({
                _token: jQuery('head>meta[name=csrf-token]').attr('content').toString(),
            }),
            type: 'DELETE',
            context: this,
            success: (response) => {
                alert(`Record #${response.id} deleted successfully!`);
                jQuery(`table tr[id=${response.id}]`).remove();
            },
            error: () => {}
        });
    }
}

/**
 * Função responsável pela exibição resumida do registro em questão, conforme array definido no modelo.
 * 
 * @param {Integer} id 
 */
function show(id) {
    const url = new URL(`${jQuery("input[name=address]").val().toString()}/${id}`);

    url.search = new URLSearchParams({
        "X-CSRF-TOKEN": jQuery('head>meta[name=csrf-token]').attr('content').toString(),
        'Content-Type': 'x-www-form-urlencoded'
    }).toString();

    fetch(url)
        .then(function (response) {
            response.json().then(function (data) {

                const InfoElement = document.createElement("div");

                InfoElement.style = `top: 50px; left: 50px; background-color: rgba(1, 1, 1, 0.1); position: fixed; width: ${data.attributes.width}px; height: 200px; border: 1px solid #000;`;
                InfoElement.className = 'popup';

                let InnerHTML = `<div class="title" style="width: ${data.attributes.width - 10}px; text-align: center; margin: 5px; background: #CCC; cursor: move;">`;

                InnerHTML += `       <span>${data.title}</span>`;
                InnerHTML += `       <span class="close-popup">`;
                InnerHTML += `            <img src="https://img.icons8.com/dusk/16/000000/x.png">`;
                InnerHTML += `       </span>`;
                InnerHTML += `   </div>`;
                InnerHTML += `   <div class="p-0 bd-highlight d-flex flex-column bd-highlight">`;
                InnerHTML += `       <table class="table table-hover">`;
                InnerHTML += `           <thead>`;
                InnerHTML += `               <tr>`;

                for (let i = 0; i < Object.keys(data.data).length; i++) {
                    InnerHTML += `<th scope="col" title="${data.data[Object.keys(data.data)[i]].title}">${Object.keys(data.data)[i]}</th>`;
                }

                InnerHTML += `               </tr>`;
                InnerHTML += `           </thead>`;
                InnerHTML += `           <tbody>`;
                InnerHTML += `               <tr>`;

                for (let i = 0; i < Object.keys(data.data).length; i++) {
                    InnerHTML += `<td scope="col" title="${data.data[Object.keys(data.data)[i]].self}">${data.data[Object.keys(data.data)[i]].self}</td>`;
                }

                InnerHTML += `               </tr>`;
                InnerHTML += `           </tbody>`;
                InnerHTML += `       </table>`;
                InnerHTML += `   </div>`;
                InnerHTML += `   <div class="d-flex justify-content-center bd-highlight">`;
                InnerHTML += `       <span class="lds-hourglass d-flex justify-content-center"></span>`;
                InnerHTML += `   </div>`;
                InnerHTML += ` </div>`;

                InfoElement.innerHTML = InnerHTML;

                document.getElementById("wrapper").appendChild(InfoElement);

                movePopUp();
            });
        })
        .catch(function (err) {
            console.error('Failed retrieving information', err);
        });
}

window.onload = (e) => {
    console.log(e);
}
