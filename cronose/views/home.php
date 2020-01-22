<?php require 'layouts/head.php';?>

<h1>Home</h1>

<div id="chart"></div>

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

            var margin = {top: 20, right: 20, bottom: 70, left: 40},
                width = 600 - margin.left - margin.right,
                height = 300 - margin.top - margin.bottom;


            // set the ranges
            var x = d3.scale.ordinal().rangeRoundBands([0, width], .05);

            var y = d3.scale.linear().range([height, 0]);

            // define the axis
            var xAxis = d3.svg.axis()
                .scale(x)
                .orient("bottom")


            var yAxis = d3.svg.axis()
                .scale(y)
                .orient("left")
                .ticks(10);

            // add the SVG element
            var svg = d3.select("#chart").append("svg")
                .attr("width", width + margin.left + margin.right)
                .attr("height", height + margin.top + margin.bottom)
              .append("g")
                .attr("transform",
                      "translate(" + margin.left + "," + margin.top + ")");

            data.offers.forEach(function(d) {
                d.name = d.name;
                d.SpecializationCount = +d.SpecializationCount;
            });

            console.log(function(d) { return d.name; });

            // scale the range of the data
            x.domain(data.offers.map(function(d) { return d.name; }));
            y.domain([0, d3.max(data.offers, function(d) { return d.SpecializationCount; })]);

            // add axis
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
                .text("Frequency");


            // Add bar chart
            console.log(data.offers);
            svg.selectAll("bar")
                .data(data.offers)
              .enter().append("rect")
                .attr("class", "bar")
                .attr("x", function(d) { return x(d.name); })
                .attr("width", x.rangeBand())
                .attr("y", function(d) { return y(d.SpecializationCount); })
                .attr("height", function(d) { return height - y(d.SpecializationCount); });

            // $.each (data.offers, function(key, value) {
            // });
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
