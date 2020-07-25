class Chart {
  constructor(response) {
    this.canvas = document.createElement('canvas');

    // Get the 2D drawing context from the provided canvas.
    this.ctx = this.canvas.getContext('2d');
    this.div = document.createElement('div');
    this.canvas_name = 'myPix';
    this.name = 'GraficoPadrao';

    // Salva os dados vindo da requisição no atributo response dessa classe
    this.response = response;

    // Seta o valor do ID em que o elemento será inserido
    this.div.setAttribute('id', 'grafico-gerado-chart-js');

    this.canvas.setAttribute('id', this.canvas_name);

    // NESSE MOMENTO O GRÁFICO É RENDERIZADO NA TELA
    this.renderGraph();

    // RENDERIZA A JANELA DO POP UP ATRAVÉS DO MÉTODO SHOWPOPUP
    this.div.outerHTML.showPopUp('Grafico', { width: 800 });

    // ADICIONA O ELEMENTO CANVAS À JANELA DO POP UP
    document.querySelector('#grafico-gerado-chart-js').appendChild(this.canvas);
  }

  renderGraph() {
    const myChart = new ChartJS(this.ctx, {
      type: this.response.chart_type,
      data: {
        labels: this.response.labels,
        datasets: this.response.dataset,
      },
      options: this.response.options,
    });
  }

  /**
   * Função fornecida em uma resposta pelo usuário Caleb Miller no fórum StackOverflow
   *
   * @link https://stackoverflow.com/questions/50104437/set-background-color-to-save-canvas-chart?noredirect=1&lq=1
   */
  fillCanvasBackgroundWithColor() {
    const self = this;

    setTimeout(() => {
      this.context = document.getElementById('myPix').getContext('2d');

      // We're going to modify the context state, so it's good practice to save the current state first.
      this.context.save();

      // Normally when you draw on a canvas, the new drawing covers up any previous drawing it overlaps. This is
      // because the default `globalCompositeOperation` is 'source-over'. By changing this to 'destination-over',
      // our new drawing goes behind the existing drawing. This is desirable so we can fill the background, while leaving
      // the chart and any other existing drawing intact.
      // Learn more about `globalCompositeOperation` here:
      // https://developer.mozilla.org/en-US/docs/Web/API/CanvasRenderingContext2D/globalCompositeOperation
      this.context.globalCompositeOperation = 'destination-over';

      // Fill in the background. We do this by drawing a rectangle filling the entire canvas, using the provided color.
      this.context.fillStyle = 'rgba(250, 250, 250, 0.2)';

      this.context.fillRect(0, 0, 1000, 1000);

      // Restore the original context state from `context.save()`
      this.context.restore();

      self.exportChart();
    }, 100);
  }

  /**
   * Código responsável por receber o conteúdo da imagem e forçar o download da mesma.
   *
   * @param {String} href
   */
  exportChart() {
    this.link = document.createElement('a');
    this.link.href = document.getElementById('myPix').toDataURL('image/png');
    this.link.download = this.name;

    document.body.appendChild(this.link);

    this.link.click();
  }

  /**
   * Recebe o nome que será usado para a imagem e preenche o canvas com um fundo da mesma cor que o pop up.
   *
   * @param String name
   */
  export(ImageName) {
    this.name = ImageName;
    this.fillCanvasBackgroundWithColor();
  }
}