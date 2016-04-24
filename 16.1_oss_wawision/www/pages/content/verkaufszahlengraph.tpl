function plotgraph_list() {

    [VARIABLEN]

   var stack = 0,
			bars = true,
			lines = false,
			steps = false;
 
        $.plot($("#placeholder"), [
[PLOTLEGENDS]
    ], {
            series: {
                stack: stack,
                lines: { show: lines,
						steps: steps },
                bars: { show: bars, barWidth:0.6, lineWidth:0, fill:1}
            },

	    yaxis: {
            min: 1
	    },

	    xaxis: {
            ticks: [DATUM]
	    }

        });
 
}

