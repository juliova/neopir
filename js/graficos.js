
/*los graficos se cargan cuando se carga la página*/
window.onload = function() {
  //Añadir tema propio para los colores del gráfico.
  CanvasJS.addColorSet("coloresGrafico",
                [//array de colores para nuestro tema.
                "#0008E6",
                "#00FFFF",
                "#7CAD00",
                "#FEA90D",
                "#fd5f00"
                ]);
  /*Se crea una variable para contener el gráfico. se apunta a la id
    del elemento que va a contener el gráfico en esta caso 'graficoN'*/
  var graficoN = new CanvasJS.Chart("graficoN",
  {
    //Selecciona tema de gráfico
    colorSet: "coloresGrafico",
    //Se asigna el titulo del gráfico
    title: { text: "Neurotismo" },
    //Abilita la animacion
    animationEnabled: true,
    /*Pone el limite en el eje 'y' para que las barras se extiendan hasta el
      borde superior*/
    axisY: {
      maximum: 34,
      //Pone el intervalo de los valores marcados en el eje y.
      interval: 2
     },
    //Se abre el espacio para los datos con parentesis cuadrados
    data: [
      //Cada grupo de datos se encierra en llaves
      {
        //Se define el tipo de gráfico aqui es un grafico apilado en columnas
        type: "stackedColumn",
        /*Los datos van en orden el primer grupo de datos es el que va abajo
          de la pila*/
        dataPoints:[
          /*Cada punto tiene un label para identificar la columna y
            el numero significa el rango del nivel en N1 en este caso 'Muy bajo'
            que va del 0 al cinco. */
          { y: 5, label: "N1"},
          { y: 5, label: "N2"},
          { y: 3, label: "N3"},
          { y: 7, label: "N4"},
          { y: 8, label: "N5"},
          { y: 3, label: "N6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          /*Para los siguientes niveles el numero es la diferencia entre el
            máximo del nivel anterior y el máximo del nivel actual. En este caso
            para N1 el máximo de 'Muy bajo' = 5 y el máximo de 'Bajo' = 10.
            N1 = 10 - 5 = 5 .*/
          { y: 5, label: "N1"},
          { y: 4, label: "N2"},
          { y: 5, label: "N3"},
          { y: 4, label: "N4"},
          { y: 4, label: "N5"},
          { y: 4, label: "N6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 5, label: "N1"},
          { y: 5, label: "N2"},
          { y: 6, label: "N3"},
          { y: 5, label: "N4"},
          { y: 5, label: "N5"},
          { y: 4, label: "N6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 5, label: "N1"},
          { y: 5, label: "N2"},
          { y: 5, label: "N3"},
          { y: 4, label: "N4"},
          { y: 4, label: "N5"},
          { y: 3, label: "N6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 12, label: "N1"},
          { y: 13, label: "N2"},
          { y: 13, label: "N3"},
          { y: 12, label: "N4"},
          { y: 11, label: "N5"},
          { y: 18, label: "N6"}
        ]
      },{
        color: "black",
        /*Se define de tipo linea*/
        type: "line",
        dataPoints:[
          /*Simplemente se pone la nota que recibieron para cada columna*/
         { y: 15, label: "N1"},
          { y: 0, label: "N2"},
          { y: 9, label: "N3"},
          { y: 17, label: "N4"},
          { y: 22, label: "N5"},
          { y: 22, label: "N6"}
        ]
      }
    ]
  });
  var graficoE = new CanvasJS.Chart("graficoE",
  {
    colorSet: "coloresGrafico",
    title: { text: "Extraversión"},
    animationEnabled: true,
    axisY: {
      maximum: 34,
      interval: 2
     },
    data: [
      {
        type: "stackedColumn",
        dataPoints:[
          { y: 16, label: "E1"},
          { y: 8, label: "E2"},
          { y: 9, label: "E3"},
          { y: 10, label: "E4"},
          { y: 9, label: "E5"},
          { y: 12, label: "E6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 4, label: "E1"},
          { y: 5, label: "E2"},
          { y: 4, label: "E3"},
          { y: 4, label: "E4"},
          { y: 5, label: "E5"},
          { y: 5, label: "E6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 4, label: "E1"},
          { y: 5, label: "E2"},
          { y: 5, label: "E3"},
          { y: 5, label: "E4"},
          { y: 5, label: "E5"},
          { y: 4, label: "E6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 4, label: "E1"},
          { y: 5, label: "E2"},
          { y: 5, label: "E3"},
          { y: 4, label: "E4"},
          { y: 5, label: "E5"},
          { y: 5, label: "E6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 4, label: "E1"},
          { y: 9, label: "E2"},
          { y: 9, label: "E3"},
          { y: 9, label: "E4"},
          { y: 8, label: "E5"},
          { y: 6, label: "E6"}
        ]
      },{
        color: "black",
        type: "line",
        dataPoints:[
          { y: 20, label: "E1"},
          { y: 10, label: "E2"},
          { y: 4, label: "E3"},
          { y: 13, label: "E4"},
          { y: 16, label: "E5"},
          { y: 15, label: "E6"}
        ]
      }
    ]
  });
  var graficoO = new CanvasJS.Chart("graficoO",
  {
    colorSet: "coloresGrafico",
    title: { text: "Apertura"},
    animationEnabled: true,
    axisY: {
      maximum: 34,
      interval: 2
     },
    data: [
      {
        type: "stackedColumn",
        dataPoints:[
          { y: 9, label: "O1"},
          { y: 8, label: "O2"},
          { y: 13, label: "O3"},
          { y: 10, label: "O4"},
          { y: 12, label: "O5"},
          { y: 13, label: "O6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 5, label: "O1"},
          { y: 5, label: "O2"},
          { y: 4, label: "O3"},
          { y: 4, label: "O4"},
          { y: 5, label: "O5"},
          { y: 5, label: "O6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 5, label: "O1"},
          { y: 6, label: "O2"},
          { y: 4, label: "O3"},
          { y: 4, label: "O4"},
          { y: 5, label: "O5"},
          { y: 5, label: "O6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 5, label: "O1"},
          { y: 6, label: "O2"},
          { y: 4, label: "O3"},
          { y: 4, label: "O4"},
          { y: 5, label: "O5"},
          { y: 4, label: "O6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 8, label: "O1"},
          { y: 7, label: "O2"},
          { y: 7, label: "O3"},
          { y: 10, label: "O4"},
          { y: 5, label: "O5"},
          { y: 5, label: "O6"}
        ]
      },{
        color: "black",
        type: "line",
        dataPoints:[
          { y: 16, label: "O1"},
          { y: 15, label: "O2"},
          { y: 18, label: "O3"},
          { y: 17, label: "O4"},
          { y: 22, label: "O5"},
          { y: 22, label: "O6"}
        ]
      }
    ]
  });
 var graficoA = new CanvasJS.Chart("graficoA",
  {
    colorSet: "coloresGrafico",
    title: { text: "Aceptabilidad"},
    animationEnabled: true,
    axisY: {
      maximum: 34,
      interval: 2
     },
    data: [
      {
        type: "stackedColumn",
        dataPoints:[
          { y: 14, label: "A1"},
          { y: 13, label: "A2"},
          { y: 17, label: "A3"},
          { y: 12, label: "A4"},
          { y: 11, label: "A5"},
          { y: 14, label: "A6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 4, label: "A1"},
          { y: 4, label: "A2"},
          { y: 3, label: "A3"},
          { y: 4, label: "A4"},
          { y: 4, label: "A5"},
          { y: 3, label: "A6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 5, label: "A1"},
          { y: 5, label: "A2"},
          { y: 4, label: "A3"},
          { y: 4, label: "A4"},
          { y: 5, label: "A5"},
          { y: 4, label: "A6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 4, label: "A1"},
          { y: 4, label: "A2"},
          { y: 4, label: "A3"},
          { y: 3, label: "A4"},
          { y: 4, label: "A5"},
          { y: 4, label: "A6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 5, label: "A1"},
          { y: 6, label: "A2"},
          { y: 4, label: "A3"},
          { y: 9, label: "A4"},
          { y: 8, label: "A5"},
          { y: 7, label: "A6"}
        ]
      },{
        color: "black",
        type: "line",
        dataPoints:[
          { y: 25, label: "A1"},
          { y: 25, label: "A2"},
          { y: 25, label: "A3"},
          { y: 25, label: "A4"},
          { y: 25, label: "A5"},
          { y: 25, label: "A6"}
        ]
      }
    ]
  });
var graficoC = new CanvasJS.Chart("graficoC",
  {
    colorSet: "coloresGrafico",
    title: { text: "Conciencia"},
    animationEnabled: true,
    axisY: {
      maximum: 34,
      interval: 2
     },
    data: [
      {
        type: "stackedColumn",
        dataPoints:[
          { y: 17, label: "C1"},
          { y: 12, label: "C2"},
          { y: 17, label: "C3"},
          { y: 12, label: "C4"},
          { y: 15, label: "C5"},
          { y: 11, label: "C6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 3, label: "C1"},
          { y: 4, label: "C2"},
          { y: 4, label: "C3"},
          { y: 5, label: "C4"},
          { y: 4, label: "C5"},
          { y: 4, label: "C6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 4, label: "C1"},
          { y: 5, label: "C2"},
          { y: 4, label: "C3"},
          { y: 4, label: "C4"},
          { y: 5, label: "C5"},
          { y: 4, label: "C6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 3, label: "C1"},
          { y: 4, label: "C2"},
          { y: 4, label: "C3"},
          { y: 4, label: "C4"},
          { y: 4, label: "C5"},
          { y: 4, label: "C6"}
        ]
      },{
        type: "stackedColumn",
        dataPoints:[
          { y: 5, label: "C1"},
          { y: 7, label: "C2"},
          { y: 3, label: "C3"},
          { y: 7, label: "C4"},
          { y: 4, label: "C5"},
          { y: 9, label: "C6"}
        ]
      },{
        color: "black",
        type: "line",
        dataPoints:[
          { y: 15, label: "C1"},
          { y: 0, label: "C2"},
          { y: 9, label: "C3"},
          { y: 17, label: "C4"},
          { y: 22, label: "C5"},
          { y: 22, label: "C6"}
        ]
      }
    ]
  });
  /*Se dibuja el gráfico en el espacio determinado */
  graficoN.render();
  graficoE.render();
  graficoO.render();
  graficoA.render();
  graficoC.render();
}
