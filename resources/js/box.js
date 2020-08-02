export default function () {
    /** @var {Integer} */
    this.__DEFAULT_TOP_AND_LEFT_DISTANCE = 50;

    /** @var {Integer} */
    this.TOP = this.__DEFAULT_TOP_AND_LEFT_DISTANCE;

    /** @var {Integer} */
    this.LEFT = this.__DEFAULT_TOP_AND_LEFT_DISTANCE;

    /** @var {Integer} */
    this.__CURRENT_LEFT = 0;

    /** @var {Integer} */
    this.__CURRENT_TOP = 0;

    /** @var {Boolean} */
    this.CLICKED = false;

    /** @var {Array} */
    this.__IMAGES = [
        `82254.jpg`,
        `110593-blue-and-yellow-blurred-background-vector.jpg`,
        `blurred-bokeh-background_36923-877.jpg`,
        `fEys5B.jpg`,
        `papers.co-sn50-green-night-blur-gradation-33-iphone6-wallpaper`
    ];

    /** @var {Object} */
    this.__ELEMENT = document.querySelector(".box");

    /**
     * Run Method.
     * 
     * @param {void}
     * 
     * @return {void}
     */
    this.run = function () {
        const _this = this;

        document.querySelectorAll('.cursor').forEach(Element => {
            Element.addEventListener('mousedown', e => {
                _this.__CURRENT_LEFT = _this.left();
                _this.__CURRENT_TOP = _this.top();

                _this.LEFT = e.clientX;
                _this.TOP = e.clientY;

                _this.CLICKED = true;
            });
        });

        window.addEventListener("mouseup", e => {
            _this.CLICKED = false;
        });

        window.addEventListener('mousemove', e => {
            if (_this.CLICKED == true) {
                _this.__ELEMENT.style.top = _this.pixels(_this.__CURRENT_TOP + e.clientY - _this.TOP);
                _this.__ELEMENT.style.left = _this.pixels(_this.__CURRENT_LEFT + e.clientX - _this.LEFT);
            }
        });

        this.getAllImages().forEach(Element => {
            Element.addEventListener('mousedown', e => {
                Element.setAttribute('draggable', false);
            });
        });
    }

    /**
     * Get TOP distance.
     * 
     * @param {void}
     * 
     * @return {Integer}
     */
    this.top = function () {
        return (parseInt(this.__ELEMENT.style.top, 10) > 0 === true) ? parseInt(this.__ELEMENT.style.top, 10) : this.__DEFAULT_TOP_AND_LEFT_DISTANCE;
    }

    /**
     * Get LEFT distance.
     * 
     * @param {void}
     * 
     * @return {Integer}
     */
    this.left = function () {
        return (parseInt(this.__ELEMENT.style.left, 10) > 0 === true) ? parseInt(this.__ELEMENT.style.left, 10) : this.__DEFAULT_TOP_AND_LEFT_DISTANCE;
    }

    /**
     * Change Background Image.
     * 
     * @param {void}
     * 
     * @return {void}
     */
    this.art = function () {
        console.log(this.__IMAGES);

        console.log("aaa");
    }

    /**
     * Converts an integer to pixels unity.
     * 
     * @param {Integer} arg
     * 
     * @return {String}
     */
    this.pixels = function (n) {
        return `${n}px`;
    }

    /**
     * Images Getter.
     * 
     * @param {void}
     * 
     * @return {Integer}
     */
    this.getAllImages = function () {
        return document.querySelectorAll('.blurry img');;
    }

    /**
     * Print PDF.
     * 
     * @param {void}
     * 
     * @return {String}
     */
    this.pdf = function () {
        return this.PDF;
    }

    /**
     * Print CSV.
     * 
     * @param {void}
     * 
     * @return {String}
     */
    this.csv = function () {
        return this.CSV;
    }

    /**
     * Closes BOX.
     * 
     * @param {void}
     * 
     * @return {void}
     */
    this.close = function () {
        this.__ELEMENT.remove();
    }
};