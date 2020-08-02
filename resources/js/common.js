const Common = {
    REGEX_LOCALHOST: 'https?:\/\/[0-9]{3}\.[0-9]{1}\.[0-9]{1}\.[0-9]{1}\:[0-9]{4}\/app\/[A-z]*',

    /**
     * Function responsable for deleting a record.
     * 
     * On returning, update the timestamp accordingly with server.
     * 
     * @param {Integer} primaryKey
     * 
     * @param {String} Url
     */
    Del(primaryKey, Url = Common.Url()) {
        if (confirm(`Would you like to delete this record #${primaryKey}?`)) {
            $.ajax({
                url: `${Url}/${primaryKey}`,
                data: $.param({
                    _token: Common.Csrf(),
                }),
                type: 'DELETE',
                context: this,
                success: (response) => {
                    alert(response.message);
                    Common.SetDate(response.timestamp);

                    if (response.status === true) {
                        jQuery(`table tr[id=${response.id}]`).remove();
                    }
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
    Show(primaryKey, Url = Common.Url()) {
        const url = new URL(`${Url}/${primaryKey}`);

        url.search = new URLSearchParams({
            "X-CSRF-TOKEN": Common.Csrf(),
            "Content-Type": "x-www-form-urlencoded"
        }).toString();

        fetch(url)
            .then(function (response) {
                response.text().then(function (HTMLResponse) {
                    const BoxWrapper = document.querySelector(".box-wrapper");

                    BoxWrapper.innerHTML = HTMLResponse;

                    new Box().run();
                })
            })
            .catch(function (err) {
                console.error('Failed retrieving information', err);
            });
    },

    POST(Url = Common.Url()) {
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
    },

    Controller() {
        return jQuery(`#data input[name=controller]`).val().toString();
    },

    Date() {
        return jQuery(`#data input[name=date]`).val().toString();
    },

    SetDate(date) {
        jQuery(`#data input[name=date]`).val(date);
    },

    Url() {
        return jQuery(`#data input[name=url]`).val().toString().match(this.REGEX_LOCALHOST).join(``).toString();
    },

    Csrf() {
        return jQuery(`#data input[name=csrf]`).val().toString();
    }
};

export default Common;