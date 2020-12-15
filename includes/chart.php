<?php

  include("config/db_connect.php");

  // COLLECT DATA
	$id = mysqli_real_escape_string($conn, $_SESSION['id']);

  // USER'S TAKEN GENED CREDITS
  $sql = "SELECT g.abbr AS Category,
                SUM(c.hours) AS Taken,
                g.hours as Total
          FROM courses AS c
          INNER JOIN user_courses AS uc
          ON uc.userid = $id
            AND c.code = uc.coursecode
          RIGHT JOIN geneds as g
          ON g.abbr = uc.gened
          GROUP BY g.abbr";

  // run query
	$result = mysqli_query($conn, $sql);

  // process and save data into table array
  $table = array();
  $table['cols'] = array(
    array('label' => 'Category', 'type' => 'string'),
    array('label' => 'Taken', 'type' => 'number'),
    array('label' => 'Needed', 'type' => 'number')
  );

  $rows = array();
  while($r = mysqli_fetch_assoc($result)) {
    // make sure not to include the "other" category
    if ($r['Category'] != 'N/A') {
      $temp = array();

      // specify which category
      $temp[] = array('v' => (string) $r['Category']);

      // values of each category
      $temp[] = array('v' => (int) $r['Taken']);

      $t = $r['Total'] - $r['Taken'];
      $temp[] = array('v' => (int) $t);

      $rows[] = array('c' => $temp);
    }
  }

  $table['rows'] = $rows;

  // encode data
  $jsonTable = json_encode($table);

  // free result and close db connection
  mysqli_free_result($result);
  mysqli_close($conn);

?>

<html>
  <head>
    <!-- load the Ajax API -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">

      // load the Visualization API and the corechart package.
      google.load('visualization', '1', {'packages':['corechart']});

      // callback to run when the Google Visualization API is loaded
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(<?=$jsonTable?>);
        var options = {
            title: 'GenEd Credits by Category',
            vAxis: {title: 'Credits'},
            hAxis: {title: 'Category'},
            width: 700,
            height: 400,
            isStacked: 'true',
            fontName: 'Play',
            fontSize: 14,
            colors:['#0c164f', '#E14C92'],
        };

        // create and draw the chart, passing in the data and options
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
          chart.draw(data, options);
        }

        // Possibly add responsiveness in the future.
        // $(window).resize(function(){
        //   drawChart();
        // });
    </script>
  </head>

  <body>
    <!-- display the chart -->
    <div id="chart_div"></div>
  </body>
</html>
