<div class="row">
    <x-input :type="'text'" :name="'penerima'" :value="$transaction->penerima ?? ''" :label="'Nama Penerima'" :col="6" :attr="['required']"/>
    <x-input :type="'text'" :name="'phone'" :value="$transaction->phone ?? ''" :label="'Nomor Telepone'" :col="6" :attr="['required']"/>
    <x-input :type="'select'" :name="'province_id'" :value="$transaction->province_id ?? ''" :label="'Provinsi'" :col="6" :options="[]" :attr="['required']"/>
    <x-input :type="'select'" :name="'city_id'" :value="$transaction->city_id ?? ''" :label="'Kota'" :col="6" :options="[]" :attr="['required']"/>
    <x-input :type="'select'" :name="'ekspedisi_name'" :value="$transaction->ekspedisi_name ?? ''" :label="'Jasa Pengiriman'" :col="12" :options="['jne'=>'JNE','pos'=>'Kantor POS','tiki'=>'TIKI']" :attr="['required']"/>
    <x-input :type="'select'" :name="'ekspedisi_tipe'" :value="$transaction->ekspedisi_tipe ?? ''" :label="'Ongkir'" :col="12" :options="[]"/>
    <x-input :type="'textarea'" :name="'alamat'" :label="'Alamat lengkap'" :value="$transaction->alamat ?? ''" :col="12" :attr="['required']"/>
    <x-input :type="'text'" :name="'kota'" :value="$transaction->kota ?? ''" :label="'Kota'" :col="6" :attr="['required','readonly']"/>
    <x-input :type="'text'" :name="'kode_pos'" :value="$transaction->kode_pos ?? ''" :label="'Kode Pos'" :col="6" :attr="['required']"/>
    <x-input :type="'text'" :name="'item_price'" :value="'Rp. '.number_format($total) ?? ''" :label="'Total Harga'" :col="6" :attr="['required','readonly']"/>
    <x-input :type="'text'" :name="'ekspedisi_price'" :value="''" :label="'Ongkos Kirim'" :col="6" :attr="['required','readonly']"/>
    <hr>
</div>

@push('scripts')
    <script>
        $('#ekspedisi_name').attr('disabled',true);
        $('#ekspedisi_tipe').attr('disabled',true);
        $.ajax({
            type: "GET",
            url: "{{ route('api.ongkir.province') }}",
            success: function (response) {
                $.each(response, function (idx, item) {
                    // html+='<option value="'+val.province_id+'">'+val.province+'</option>'
                    $('#province_id').append($('<option>', {
                        value: item.province_id,
                        text : item.province
                    }));
                });
            }
        });
        $('#province_id').change(function (e) {
            $('#ekspedisi_name').attr('disabled',false);
            var val = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('api.ongkir.city') }}",
                data:{
                    province_id:val
                },
                success: function (response) {
                    $('#city_id').html('');
                    $('#city_id').append($('<option>', {
                        value: '',
                        text : ''
                    }));
                    $.each(response, function (idx, item) {
                        // html+='<option value="'+val.province_id+'">'+val.province+'</option>'
                        $('#city_id').append($('<option>', {
                            value: item.city_id,
                            text : item.type+' '+item.city_name,
                            data_kota : item.type+' '+item.city_name,
                        }));
                    });
                }
            });
        });
        $('#city_id').change(function (e) {
            var destination = $(this).val();
            var courier = $('#ekspedisi_name').val();
            var weight = @json($weight);
            var kota = $(this).find(':selected').attr('data_kota');
            $('#kota').val(kota);
            if (courier!=null) {
                getCost(destination,courier,weight);
            }
        });
        $('#ekspedisi_name').change(function (e) {
            $('#ekspedisi_tipe').attr('disabled',false);
            var val = $(this).val();
            var destination = $('#city_id').val();
            var weight = @json($weight);
            getCost(destination,val,weight);
        });
        $('#ekspedisi_tipe').change(function (e) {
            var val = $(this).find(':selected').attr('data_price');
            $('#ekspedisi_price').val('Rp. '+val);
        });

        function getCost (destination,courier,weight) {
            $.ajax({
                type: "POST",
                url: "{{ route('api.ongkir') }}",
                data:{
                    destination:destination,
                    courier:courier,
                    weight:weight,
                },
                success: function (response) {
                    $('#ekspedisi_tipe').html('');
                    $('#ekspedisi_tipe').append($('<option>', {
                        value: '',
                        text : ''
                    }));
                    $.each(response.costs, function (idx, item) {
                        // html+='<option value="'+val.province_id+'">'+val.province+'</option>'
                        $('#ekspedisi_tipe').append($('<option>', {
                            value: item.description+' ('+item.cost[0].etd+' hari) Rp. '+item.cost[0].value,
                            text : item.description+' ('+item.cost[0].etd+' hari) Rp. '+item.cost[0].value,
                            data_price:item.cost[0].value,
                        }));
                    });
                }
            });
        }
    </script>
@endpush
