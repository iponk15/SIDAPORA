<div id="chart_2" class="chart">
</div>

<script>
    $(document).ready(function() {
        chart2();
    });

    function chart2() {
        var value = JSON.parse('<?php echo $result ?>');
        if ($('#chart_2').size() != 1) {
            return;
        }

        var sarana = value.sarana;

        var prasarana = value.prasarana;

        var plot = $.plot($("#chart_2"), [{
            data: sarana,
            label: "Sarana",
            lines: {
                lineWidth: 1,
            },
            shadowSize: 0

        }, {
            data: prasarana,
            label: "Prasarana",
            lines: {
                lineWidth: 1,
            },
            shadowSize: 0
        }], {
            series: {
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.05
                        }, {
                            opacity: 0.01
                        }]
                    }
                },
                points: {
                    show: true,
                    radius: 3,
                    lineWidth: 1
                },
                shadowSize: 2
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#eee",
                borderColor: "#eee",
                borderWidth: 1
            },
            colors: ["#d12610", "#37b7f3", "#52e136"],
            xaxis: {
                ticks: 11,
                tickDecimals: 0,
                tickColor: "#eee",
            },
            yaxis: {
                ticks: 11,
                tickDecimals: 0,
                tickColor: "#eee",
            }
        });


        function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 15,
                border: '1px solid #333',
                padding: '4px',
                color: '#fff',
                'border-radius': '3px',
                'background-color': '#333',
                opacity: 0.80
            }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        $("#chart_2").bind("plothover", function(event, pos, item) {
            $("#x").text(pos.x.toFixed(0));
            $("#y").text(pos.y.toFixed(0));

            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(0),
                        y = item.datapoint[1].toFixed(0);

                    showTooltip(item.pageX, item.pageY, item.series.label + " di tahun " + x + " = " + y);
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
    }
</script>