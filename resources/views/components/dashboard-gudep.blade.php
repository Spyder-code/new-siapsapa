<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var id_wilayah = @json($id_wilayah);
        const number = (num) =>{return num.toLocaleString('en-US')};
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
