function plotgraph() {

    [VARIABLEN]

   var stack = 0,
			bars = true,
			lines = false,
			steps = false;
 
    function plotWithOptions() {

var data = [
    [UMSATZPIE]
  ];

    // GRAPH 1
  $.plot($("#umsatzpie"), data, 
  {
series: {
 pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 2/3,
                    formatter: function(label, series){
                        return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                    },
                    threshold: 0.01
                }
            }
        }
  });
/* 
var data2 = [
    [GUTSCHRIFTUMSATZPIE]
  ];

    // GRAPH 1
  $.plot($("#umsatzpie2"), data2, 
  {
series: {
            pie: {
                show: true
            }
        }
  });
*/ 
    }
    plotWithOptions();
}

