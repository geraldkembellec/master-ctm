    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function daysToMilliseconds(days) {
      return days * 24 * 60 * 60 * 1000;
    }

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Task ID');
      data.addColumn('string', 'Task Name');
      data.addColumn('date', 'Start Date');
      data.addColumn('date', 'End Date');
      data.addColumn('number', 'Duration');
      data.addColumn('number', 'Percent Complete');
      data.addColumn('string', 'Dependencies');

      data.addRows([
        ['Research', 'Se documenter [Gérald]',
         new Date(2026, 09, 1), new Date(2026, 10, 1), null,  100,  null],
        ['Synthèse', 'Structurer lʼinformation et la segmenter [Gérald + Luc]',
         new Date(2026, 10, 1), new Date(2026, 11, 1), null,  100,  null],
        ['Coding', 'Créer la structure du site [Gérald]',
         new Date(2026, 10, 15), new Date(2026, 11, 15), null,  100,  null],
        ['Intégration', 'Intégrer lʼinformation dans la structure documentaire [Luc]',
         new Date(2026, 10, 25), new Date(2026, 12, 1), null,  100,  null],
      ]);

      var options = {
        height: 275
      };

      var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
