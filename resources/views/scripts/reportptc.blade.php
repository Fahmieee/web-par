<script type="text/javascript">

    $('#unitkerja').on('change', function () {

        var unitkerja = $(this).val();

        var content = "";

        if (unitkerja == 'mori'){

            content += "<option>All</option>";
            content += "<option>Medan</option>";
            content += "<option>Batam</option>";

        } else if (unitkerja == 'morii'){

            content += "<option>All</option>";
            content += "<option>Pelamebang</option>";
            content += "<option>Bengkulu</option>";

        } else if (unitkerja == 'moriii'){

            content += "<option>All</option>";
            content += "<option>Kramat Raya</option>";
            content += "<option>Plumpang</option>";

        } else {

            content += "<option>All</option>";

        }

        $('#wilayah').html(content);

    });

    $('#bagian').on('change', function () {

        $.ajax({
            type: 'POST',
            url: "{{ route('ViewDetailPTC') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $(this).val()
            },

            success: function (data) {

                var content_datax="";
                var no = -1;

                content_datax += "<option value=''>All</option>";

                $.each(data, function() {

                    no++;
                    var id = data[no]['id'];
                    var detail_name = data[no]['name'];

                    content_datax += "<option value='"+id+"'>"+detail_name+"</option>";


                });

               $('#detail').html(content_datax); 

            }

        });

    });

    function ReloadContent(){

        $('#loadercontent').attr('style','display: none;');
        $('#contents').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#total').html('12');
        $('#onprogress').html('7');
        $('#selesai').html('5');

    }

    function ReloadKosong(){

        $('#loadercontent').attr('style','display: none;');
        $('#contentkosong').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('.isi').html('0');

    }

    function ReloadMor3(){

        $('#loadercontent').attr('style','display: none;');
        $('#unitkerjamori').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#total').html('4');
        $('#onprogress').html('3');
        $('#selesai').html('1');

    }

    function ReloadPlumpang(){

        $('#loadercontent').attr('style','display: none;');
        $('#plumpang').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#total').html('3');
        $('#onprogress').html('2');
        $('#selesai').html('1');

    }

    function ReloadKramat(){

        $('#loadercontent').attr('style','display: none;');
        $('#kramat').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#total').html('1');
        $('#onprogress').html('1');
        $('#selesai').html('0');

    }

    function ReloadKlakson(){

        $('#loadercontent').attr('style','display: none;');
        $('#klakson').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#total').html('1');
        $('#onprogress').html('1');
        $('#selesai').html('0');

    }

    function ReloadSuhu(){

        $('#loadercontent').attr('style','display: none;');
        $('#suhu').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#total').html('1');
        $('#onprogress').html('0');
        $('#selesai').html('1');

    }

    function ReloadOnOff(){

        $('#loadercontent').attr('style','display: none;');
        $('#onoff').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#total').html('1');
        $('#onprogress').html('1');
        $('#selesai').html('0');

    }

    function ReloadHigh(){

        $('#loadercontent').attr('style','display: none;');
        $('#high').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#total').html('1');
        $('#onprogress').html('1');
        $('#selesai').html('1');

    }

    function ReloadMedium(){

        $('#loadercontent').attr('style','display: none;');
        $('#medium').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#total').html('2');
        $('#onprogress').html('2');
        $('#selesai').html('0');

    }


    $('#dari').on('change', function () {

        var sampai = $('#sampai').val();
        var ini = $(this).val();
        var potong = ini.substr(5,2);

        // alert(potong+' | '+sampai);

        if (sampai != ''){

            $('#loadercontent').attr('style','display: block;');
            $('.tabelisi').attr('style','display: none;');

            $('.loaderz').attr('style','display: block;');
            $('.isi').attr('style','display: none;');

            if (potong == '09'){
                setTimeout(ReloadContent, 2500);
            } else {
                setTimeout(ReloadKosong, 2500);
            }
        } 

    });

    $('#sampai').on('change', function () {

        var dari = $('#dari').val();
        var potong = dari.substr(5,2);

        if (dari != ''){

            $('#loadercontent').attr('style','display: block;');
            $('.tabelisi').attr('style','display: none;');

            $('.loaderz').attr('style','display: block;');
            $('.isi').attr('style','display: none;');

            if (potong == '09'){
                setTimeout(ReloadContent, 2500);
            } else {
                setTimeout(ReloadKosong, 2500);
            }
        } 
    });

    $('#unitkerja').on('change', function () {

        var dari = $('#dari').val();
        var sampai = $('#sampai').val();
        var potongdari = dari.substr(5,2);

        $('#wilayah').val('All');
        $('#bagian').val('All');
        $('#detail').val('All');
        $('#level').val('All');

        var ini = $(this).val();

        $('#loadercontent').attr('style','display: block;');
        $('.tabelisi').attr('style','display: none;');

        $('.loaderz').attr('style','display: block;');
        $('.isi').attr('style','display: none;');

        if (potongdari == '09' || dari == '' || sampai == ''){

            if (ini == 'moriii'){

            setTimeout(ReloadMor3, 2500);

            } else if (ini == 'All'){

                setTimeout(ReloadContent, 2500);

            } else {

                setTimeout(ReloadKosong, 2500);
            }

        } else {

            setTimeout(ReloadKosong, 2500);

        }

        

    });

    $('#wilayah').on('change', function () {

        var ini = $(this).val();
        var unitkerja = $('#unitkerja').val();

        $('#bagian').val('All');
        $('#detail').val('All');
        $('#level').val('All');

        $('#loadercontent').attr('style','display: block;');
        $('.tabelisi').attr('style','display: none;');

        $('.loaderz').attr('style','display: block;');
        $('.isi').attr('style','display: none;');

        if (ini == 'Plumpang'){

            setTimeout(ReloadPlumpang, 2500);

        } else if (ini == 'Kramat Raya'){

            setTimeout(ReloadKramat, 2500);

        } else if(ini == 'All'){

            if(unitkerja == 'moriii'){
                setTimeout(ReloadMor3, 2500);
            } else {

                setTimeout(ReloadKosong, 2500);

            }
            
        } else{

            setTimeout(ReloadKosong, 2500);
        }

    });

    $('#bagian').on('change', function () {

        var ini = $(this).val();
        var wilayah = $('#wilayah').val();

        $('#level').val('All');

        $('#loadercontent').attr('style','display: block;');
        $('.tabelisi').attr('style','display: none;');

        $('.loaderz').attr('style','display: block;');
        $('.isi').attr('style','display: none;');

         if (ini == 2){

            if (wilayah == 'Plumpang'){

                setTimeout(ReloadPlumpang, 2500);

            } else if (wilayah == 'Kramat Raya'){

                setTimeout(ReloadKramat, 2500);

            } else if(ini == 'All'){

                setTimeout(ReloadMor3, 2500);
                
            } else{

                setTimeout(ReloadKosong, 2500);
            }

        } else {

            setTimeout(ReloadKosong, 2500);
        }

    });


    $('#detail').on('change', function () {

        var ini = $(this).val();
        var wilayah = $('#wilayah').val();
        var unitkerja = $('#unitkerja').val();

        $('#loadercontent').attr('style','display: block;');
        $('.tabelisi').attr('style','display: none;');

        $('.loaderz').attr('style','display: block;');
        $('.isi').attr('style','display: none;');

        if (ini == 4){

            setTimeout(ReloadKlakson, 2500);

        } else if (ini == 7){

            setTimeout(ReloadSuhu, 2500);

        } else if (ini == 5){

            setTimeout(ReloadOnOff, 2500);

        } else {

            setTimeout(ReloadKosong, 2500);

        }

    });

    $('#level').on('change', function () {

        var ini = $(this).val();
        var wilayah = $('#wilayah').val();
        var unitkerja = $('#unitkerja').val();

        $('#loadercontent').attr('style','display: block;');
        $('.tabelisi').attr('style','display: none;');

        $('.loaderz').attr('style','display: block;');
        $('.isi').attr('style','display: none;');

        if (unitkerja == 'moriii'){

            if (ini == 'High'){

                setTimeout(ReloadHigh, 2500);

            } else if (ini == 'Medium'){

                setTimeout(ReloadMedium, 2500);

            } else if (ini == 'All'){

                setTimeout(ReloadMor3, 2500);

            } else {

                setTimeout(ReloadKosong, 2500);

            }

        } else {

            setTimeout(ReloadKosong, 2500);

        }


    });


</script>