<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var id_wilayah = @json($id_wilayah);
        const number = (num) =>{return num.toLocaleString('en-US')};
        $.ajax({
            url: @json(url('api/get-number-of-gender'))+'/'+id_wilayah,
            data:{
                golongan:true,
                gudep:@json($gudep)
            },
            type: 'GET',
            success: function(data) {
                $('#total-siaga-lk').html(number(data.siaga.male));
                $('#total-siaga-pr').html(number(data.siaga.female));
                $('#total-penggalang-lk').html(number(data.penggalang.male));
                $('#total-penggalang-pr').html(number(data.penggalang.female));
                $('#total-penegak-lk').html(number(data.penegak.male));
                $('#total-penegak-pr').html(number(data.penegak.female));
                $('#total-pandega-lk').html(number(data.pandega.male));
                $('#total-pandega-pr').html(number(data.pandega.female));
                $('#total-dewasa-lk').html(number(data.dewasa.male));
                $('#total-dewasa-pr').html(number(data.dewasa.female));
                $('#total-pelatih-lk').html(number(data.pelatih.male));
                $('#total-pelatih-pr').html(number(data.pelatih.female));
                $('#total-pembina-lk').html(number(data.pembina.male));
                $('#total-pembina-pr').html(number(data.pembina.female));
            }
        });

        $.ajax({
            url: @json(url('api/get-statistik-tingkat'))+'/'+id_wilayah,
            type: 'GET',
            data:{
                gudep:@json($gudep)
            },
            success: function(data) {
                var tingkat = data.tingkat;
                var siaga = {
                    chart: {
                        type: 'donut',
                        toolbar: {
                            show: true,
                            offsetX: 0,
                            offsetY: 0,
                            tools: {
                                    download: true,
                                    selection: true,
                                },
                        }
                    },
                    series: tingkat.siaga.value,
                    labels: tingkat.siaga.label,
                    dataLabels: {
                        formatter: function (val, opts) {
                            return opts.w.config.series[opts.seriesIndex]
                        },
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                };

                var penggalang = {
                    chart: {
                        type: 'donut',
                        toolbar: {
                            show: true,
                            offsetX: 0,
                            offsetY: 0,
                            tools: {
                                    download: true,
                                    selection: true,
                                },
                        }
                    },
                    series: tingkat.penggalang.value,
                    labels: tingkat.penggalang.label,
                    dataLabels: {
                        formatter: function (val, opts) {
                            return opts.w.config.series[opts.seriesIndex]
                        },
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                };

                var penegak = {
                    chart: {
                        type: 'donut',
                        toolbar: {
                            show: true,
                            offsetX: 0,
                            offsetY: 0,
                            tools: {
                                    download: true,
                                    selection: true,
                                },
                        }
                    },
                    series: tingkat.penegak.value,
                    labels: tingkat.penegak.label,
                    dataLabels: {
                        formatter: function (val, opts) {
                            return opts.w.config.series[opts.seriesIndex]
                        },
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                };

                var pandega = {
                    chart: {
                        type: 'donut',
                        toolbar: {
                            show: true,
                            offsetX: 0,
                            offsetY: 0,
                            tools: {
                                    download: true,
                                    selection: true,
                                },
                        }
                    },
                    series: tingkat.pandega.value,
                    labels: tingkat.pandega.label,
                    dataLabels: {
                        formatter: function (val, opts) {
                            return opts.w.config.series[opts.seriesIndex]
                        },
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                };

                var pelatih = {
                    chart: {
                        type: 'donut',
                        toolbar: {
                            show: true,
                            offsetX: 0,
                            offsetY: 0,
                            tools: {
                                    download: true,
                                    selection: true,
                                },
                        }
                    },
                    series: tingkat.pelatih.value,
                    labels: tingkat.pelatih.label,
                    dataLabels: {
                        formatter: function (val, opts) {
                            return opts.w.config.series[opts.seriesIndex]
                        },
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                };

                var pembina = {
                    chart: {
                        type: 'donut',
                        toolbar: {
                            show: true,
                            offsetX: 0,
                            offsetY: 0,
                            tools: {
                                    download: true,
                                    selection: true,
                                },
                        }
                    },
                    series: tingkat.pembina.value,
                    labels: tingkat.pembina.label,
                    dataLabels: {
                        formatter: function (val, opts) {
                            return opts.w.config.series[opts.seriesIndex]
                        },
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                };

                var chart1 = new ApexCharts(document.querySelector("#siaga"), siaga);
                var chart2 = new ApexCharts(document.querySelector("#penggalang"), penggalang);
                var chart3 = new ApexCharts(document.querySelector("#penegak"), penegak);
                var chart4 = new ApexCharts(document.querySelector("#pandega"), pandega);
                var chart5 = new ApexCharts(document.querySelector("#pelatih"), pelatih);
                var chart6 = new ApexCharts(document.querySelector("#pembina"), pembina);
                chart1.render();
                chart2.render();
                chart3.render();
                chart4.render();
                chart5.render();
                chart6.render();
            }
        });

        $.ajax({
            url: {!! json_encode(url('api/get-number-of-member')) !!}+'/'+{!! json_encode($id_wilayah) !!},
            type: 'GET',
            data:{
                gudep:@json($gudep)
            },
            success: function(data) {
                $('#total-anggota').html(data.anggota);
                $('#total-admin').html(data.admin);
            }
        });

        $.ajax({
            url: {!! json_encode(url('api/get-number-of-pramuka')) !!}+'/'+{!! json_encode($id_wilayah) !!},
            type: 'GET',
            data:{
                gudep:@json($gudep)
            },
            success: function(data) {
                $('#total-siaga').html(number(data.siaga));
                $('#total-penggalang').html(number(data.penggalang));
                $('#total-penegak').html(number(data.penegak));
                $('#total-pandega').html(number(data.pandega));
                $('#total-dewasa').html(number(data.dewasa));
                $('#total-pembina').html(number(data.pembina));
                $('#total-pelatih').html(number(data.pelatih));
            }
        });

        function statistikAnggota(){
            $.ajax({
                url: @json(url('api/get-statistik-anggota'))+'/'+id_wilayah,
                type: 'GET',
                data:{
                    gudep:@json($gudep)
                },
                success: function(data) {
                    var statistik_value = [data.gender.male,data.gender.female,data.active.active,data.active.unactive];
                    var statistik = {
                        chart: {
                            type: 'bar',
                            height: 350,
                            width: '100%',
                        },
                        series:[{
                            data: statistik_value
                        }],
                        xaxis: {
                            categories: ['Putra', 'Putri', 'Aktif', 'non Aktif']
                        },
                    }
                    var chart = new ApexCharts(document.querySelector("#total-laporan"), statistik);
                    chart.render();
                }
            });
        }

        function jumlahAnggota(){
            $.ajax({
                url: @json(url('api/get-jumlah-anggota'))+'/'+id_wilayah,
                type: 'GET',
                data:{
                    gudep:@json($gudep)
                },
                success: function(data) {
                    var jumlah = data.statistik;
                    var anggota = {
                        series: [{
                            data: jumlah.data
                        }],
                        chart: {
                            height: 350,
                            type: 'line',
                            zoom: {
                                enabled: false
                            }
                        },
                        stroke: {
                            curve: 'straight'
                        },
                        title: {
                            text: 'Jumlah Anggota',
                            align: 'left'
                        },
                        grid: {
                            row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                        },
                        xaxis: {
                            categories: jumlah.label,
                        }
                    };
                    var chart7 = new ApexCharts(document.querySelector("#insert-data"), anggota);
                    chart7.render();
                }
            });
        }

        function statistikDarah(){
            $.ajax({
                url: @json(url('api/get-statistik-darah'))+'/'+id_wilayah,
                type: 'GET',
                data:{
                    gudep:@json($gudep)
                },
                success: function(data) {
                    var statistik_value = [data.darah.A,data.darah.B,data.darah.AB,data.darah.O,data.darah.none];
                    var statistik = {
                        chart: {
                            type: 'bar',
                            height: 350,
                            width: '100%',
                        },
                        series:[{
                            data: statistik_value
                        }],
                        xaxis: {
                            categories: ['Gol. A', 'Gol. B', 'Gol. AB', 'Gol. O', '-']
                        },
                    }
                    var chart = new ApexCharts(document.querySelector("#total-darah"), statistik);
                    chart.render();
                }
            });
        }

        function statistikAgama(){
            $.ajax({
                url: @json(url('api/get-statistik-agama'))+'/'+id_wilayah,
                type: 'GET',
                data:{
                    gudep:@json($gudep)
                },
                success: function(data) {
                    var statistik_value = [data.agama.islam, data.agama.kristen, data.agama.katolik, data.agama.hindu, data.agama.budha, data.agama.konghucu];
                    var statistik = {
                        chart: {
                            type: 'bar',
                            height: 350,
                            width: '100%',
                        },
                        series:[{
                            data: statistik_value
                        }],
                        xaxis: {
                            categories: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']
                        },
                    }
                    var chart = new ApexCharts(document.querySelector("#total-agama"), statistik);
                    chart.render();
                }
            });
        }

    </script>
