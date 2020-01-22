<?php require 'layouts/head.php';?>

<h1 class="mb-4 mt-4">HOME</h1>

<div class="container wrap row justify-content-center mt-4" id="chart">
</div>
<script>

  $(document).ready(function(){

    showChart();
		function showChart() {
      const url = (window.location.pathname.split('/')[3]) ? '/api/category/'+window.location.pathname.split('/')[3] : '/api/category' ;
      $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        data: {},
        success: (data) => {
          if (data.status == 'success') {

            var max=0;
            data.offers.forEach(function(d) {
                d.name = d.name;
                d.SpecializationCount = +d.SpecializationCount;
                if (max<d.SpecializationCount) {
                  max = d.SpecializationCount;
                }
            });

            var margin = {top: 20, right: 20, bottom: 140, left: 40},
                width = 700 - margin.left - margin.right,
                height = 300 - margin.top - margin.bottom;


            // Definimos los rangos
            var x = d3.scale.ordinal().rangeRoundBands([0, width], .05);

            var y = d3.scale.linear().range([height, 0]);

            // Definimos los ejes
            var xAxis = d3.svg.axis()
                .scale(x)
                .orient("bottom")


            var yAxis = d3.svg.axis()
                .scale(y)
                .orient("left")
                .ticks(max);

            // Añadimos los elementos SVG
            var svg = d3.select("#chart").append("svg")
                .attr("width", width + margin.left + margin.right)
                .attr("height", height + margin.top + margin.bottom)
              .append("g")
                .attr("transform",
                      "translate(" + margin.left + "," + margin.top + ")");

            // Escalamos los rangos con nuestros datos
            x.domain(data.offers.map(function(d) { return d.name; }));
            y.domain([0, d3.max(data.offers, function(d) { return d.SpecializationCount; })]);

            // Añadimos los ejes
            svg.append("g")
                .attr("class", "x axis")
                .attr("transform", "translate(0," + height + ")")
                .call(xAxis)
              .selectAll("text")
                .style("text-anchor", "end")
                .attr("dx", "-.8em")
                .attr("dy", "-.55em")
                .attr("transform", "rotate(-90)" );

            svg.append("g")
                .attr("class", "y axis")
                .call(yAxis)
              .append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 5)
                .attr("dy", ".71em")
                .style("text-anchor", "end")
                // .text("Nº de Trabajos");


            // Agregamos las barras al grafico
            svg.selectAll("bar")
                .data(data.offers)
              .enter().append("rect")
                .attr("class", "bar")
                .attr("x", function(d) { return x(d.name); })
                .attr("width", x.rangeBand())
                .attr("y", function(d) { return y(d.SpecializationCount); })
                .attr("height", function(d) { return height - y(d.SpecializationCount); });

          };
        },
        error: ((data) => {
          console.log(data);
        })
      });
    };
  });

</script>


<?php '../views/layouts/footer.php';?>
