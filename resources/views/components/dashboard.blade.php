<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var id_wilayah = @json($id_wilayah);
        var url = @json(url('api/dashboard'))+'/'+id_wilayah;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                console.log(data);
                var tingkat = data.tingkat;
                var jumlah = data.statistik;
                var statistik_value = [data.gender.male,data.gender.female,data.active.active,data.active.unactive,data.gudep.gudep,data.gudep.non_gudep];

                var siaga = {
                    title: {
                        text: 'Detail Anggota Siaga',
                        align: 'left'
                    },
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
                    title: {
                        text: 'Detail Anggota Penggalang',
                        align: 'left'
                    },
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
                    title: {
                        text: 'Detail Anggota Penegak',
                        align: 'left'
                    },
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
                    title: {
                        text: 'Detail Anggota Pandega',
                        align: 'left'
                    },
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

                var dewasa = {
                    title: {
                        text: 'Detail Anggota Dewasa',
                        align: 'left'
                    },
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
                    series: tingkat.dewasa.value,
                    labels: tingkat.dewasa.label,
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

                var statistik = {
                    chart: {
                        type: 'bar',
                        height: 350,
                        width: '100%',
                    },
                    title: {
                        text: 'Statistik',
                        align: 'left'
                    },
                    series:[{
                        data: statistik_value
                    }],
                    xaxis: {
                        categories: ['Anggota Laki-laki', 'Anggota Perempuan', 'Anggota Aktif', 'Anggota non Aktif', 'Anggota Gudep', 'Anggota non Gudep']
                    },
                }

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

                var chart1 = new ApexCharts(document.querySelector("#siaga"), siaga);
                var chart2 = new ApexCharts(document.querySelector("#penggalang"), penggalang);
                var chart3 = new ApexCharts(document.querySelector("#penegak"), penegak);
                var chart4 = new ApexCharts(document.querySelector("#pandega"), pandega);
                var chart5 = new ApexCharts(document.querySelector("#dewasa"), dewasa);
                var chart6 = new ApexCharts(document.querySelector("#total-laporan"), statistik);
                var chart7 = new ApexCharts(document.querySelector("#insert-data"), anggota);
                chart1.render();
                chart2.render();
                chart3.render();
                chart4.render();
                chart5.render();
                chart6.render();
                chart7.render();
            }
        });

        $.ajax({
            url: {!! json_encode(url('api/get-number-of-member')) !!}+'/'+{!! json_encode($id_wilayah) !!},
            type: 'GET',
            success: function(data) {
                $('#total-anggota').html(data.anggota);
                $('#total-admin').html(data.admin);
            }
        });

        $.ajax({
            url: {!! json_encode(url('api/get-number-of-pramuka')) !!}+'/'+{!! json_encode($id_wilayah) !!},
            type: 'GET',
            success: function(data) {
                $('#total-siaga').html(data.siaga);
                $('#total-penggalang').html(data.penggalang);
                $('#total-penegak').html(data.penegak);
                $('#total-pandega').html(data.pandega);
                $('#total-dewasa').html(data.dewasa);
                $('#total-pelatih').html(data.pelatih);
            }
        });
    </script>
