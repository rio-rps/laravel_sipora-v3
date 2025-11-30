<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/themes/adaptive.js"></script>
<style>
    * {
        font-family:
            -apple-system,
            BlinkMacSystemFont,
            "Segoe UI",
            Roboto,
            Helvetica,
            Arial,
            "Apple Color Emoji",
            "Segoe UI Emoji",
            "Segoe UI Symbol",
            sans-serif;
    }

    .highcharts-figure {
        min-width: 320px;
        max-width: 660px;
        margin: 1em auto;
    }

    .highcharts-description {
        margin: 0.3rem 10px;
    }


    @media (prefers-color-scheme: dark) {
        body {
            background-color: #141414;
            color: #ffffff;
        }
    }
</style>
<div class="row container">
    @foreach ($resultPermohonan as $jenis => $data)
        <div class="col-md-4">
            <div class="card  border-success mb-3">
                <figure class="highcharts-figure">
                    <div id="container-{{ \Illuminate\Support\Str::slug($jenis) }}"></div>
                    <p class="highcharts-description text-center mt-2"></p>
                </figure>
            </div>
        </div>





        <script>
            Highcharts.chart('container-{{ \Illuminate\Support\Str::slug($jenis) }}', {
                chart: {
                    type: 'pie',
                    custom: {},
                    events: {
                        render() {
                            const chart = this,
                                series = chart.series[0];
                            let customLabel = chart.options.chart.custom.label;

                            if (!customLabel) {
                                customLabel = chart.options.chart.custom.label =
                                    chart.renderer.label(
                                        'Total<br/>' +
                                        '<strong>2 877 820</strong>'
                                    )
                                    .css({
                                        color: 'var(--highcharts-neutral-color-100, #000)',
                                        textAnchor: 'middle'
                                    })
                                    .add();
                            }

                            const x = series.center[0] + chart.plotLeft,
                                y = series.center[1] + chart.plotTop -
                                (customLabel.attr('height') / 2);

                            customLabel.attr({
                                x,
                                y
                            });
                            // Set font size based on chart diameter
                            customLabel.css({
                                fontSize: `${series.center[2] / 12}px`
                            });
                        }
                    }
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                title: {
                    text: '{{ $jenis }}'
                },
                subtitle: {
                    text: 'Source: <a href="https://www.ssb.no/transport-og-reiseliv/faktaside/bil-og-transport">SSB</a>'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        borderRadius: 8,
                        dataLabels: [{
                            enabled: true,
                            distance: 20,
                            format: '{point.name}'
                        }, {
                            enabled: true,
                            distance: -15,
                            format: '{point.percentage:.0f}%',
                            style: {
                                fontSize: '0.9em'
                            }
                        }],
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Registrations',
                    colorByPoint: true,
                    innerSize: '75%',
                    data: {!! json_encode($data->pluck('jmlh_selesai')->toArray()) !!}
                }]
            });
        </script>
    @endforeach
</div>
