const REGEX_LOCALHOST = 'https?:\/\/[0-9]{3}\.[0-9]{1}\.[0-9]{1}\.[0-9]{1}\:[0-9]{4}\/app\/[A-z]*';

var movePopUp = () => {

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

function POST(Url = App.Url()) {
    $.ajax({
        url: Url,
        data: $.param({
            _token: Csrf(),
            color: "blabladab3la",
            hexadecimal: "FFBLHH"
        }),
        type: 'POST',
        context: this,
        success: (response) => {
            console.log(response);
        },
        error: (err) => {
            //
        }
    });
}

const App = {
    /**
     * Function responsable for deleting a record.
     * 
     * On returning, update the timestamp accordingly with server.
     * 
     * @param {Integer} primaryKey
     * 
     * @param {String} Url
     */
    Del: (primaryKey, Url = App.Url()) => {
        if (confirm(`Would you like to delete this record #${primaryKey}?`)) {
            $.ajax({
                url: `${Url}/${primaryKey}`,
                data: $.param({
                    _token: App.Csrf(),
                }),
                type: 'DELETE',
                context: this,
                success: (response) => {
                    alert(response.message);
                    App.SetDate(response.timestamp);
                    jQuery(`table tr[id=${response.id}]`).remove();
                },
                error: () => { }
            });
        }
    },
    /**
     * Function responsable for resumed showing of actual record, accordingly with model definition.
     * 
     * @param {Integer} primaryKey 
     * @param {String} Url
     */
    Show: (primaryKey, Url = App.Url()) => {
        const url = new URL(`${Url}/${primaryKey}`);

        url.search = new URLSearchParams({
            "X-CSRF-TOKEN": App.Csrf(),
            "Content-Type": "x-www-form-urlencoded"
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
    },
    Controller: () => {
        return jQuery(`#data input[name=controller]`).val().toString();
    },
    Date: () => {
        return jQuery(`#data input[name=date]`).val().toString();
    },
    SetDate: (date) => {
        jQuery(`#data input[name=date]`).val(date);
    },
    Url: () => {
        return jQuery(`#data input[name=url]`).val().toString().match(REGEX_LOCALHOST).join(``).toString();
    },
    Csrf: () => {
        return jQuery(`#data input[name=csrf]`).val().toString();
    }
};

window.onload = (e) => {
    //
}
