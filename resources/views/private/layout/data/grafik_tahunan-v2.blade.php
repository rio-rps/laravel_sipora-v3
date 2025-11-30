<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
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

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 500px;
        margin: 1em auto;
    }

    #container {
        height: 100%;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid var(--highcharts-neutral-color-10, #e6e6e6);
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: var(--highcharts-neutral-color-60, #666);
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tbody tr:nth-child(even) {
        background: var(--highcharts-neutral-color-3, #f7f7f7);
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
                    <div id="chart-{{ \Illuminate\Support\Str::slug($jenis) }}"></div>
                    <p class="highcharts-description text-center mt-2"></p>
                </figure>
            </div>
        </div>





        <script>
            Highcharts.chart('chart-{{ \Illuminate\Support\Str::slug($jenis) }}', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: '{{ $jenis }}'
                },
                xAxis: {
                    categories: {!! json_encode($data->pluck('tahun')->toArray()) !!},
                    title: {
                        text: 'Tahun'
                    },
                    gridLineWidth: 1,
                    lineWidth: 0
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Kendaraan',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    },
                    gridLineWidth: 0
                },
                tooltip: {
                    valueSuffix: ' Kendaraan'
                },
                plotOptions: {
                    column: {
                        borderRadius: 5,
                        dataLabels: {
                            enabled: true
                        },
                        groupPadding: 0.1,
                        colors: Highcharts.getOptions().colors // biar tiap tahun beda warna
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Jumlah Selesai',
                    data: {!! json_encode($data->pluck('jmlh_selesai')->toArray()) !!}
                }]
            });
        </script>
    @endforeach
</div>
