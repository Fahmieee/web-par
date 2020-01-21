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


    function ReloadContent(){

        $('#loadercontent').attr('style','display: none;');
        $('#contents').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#sehat').html('9');
        $('#sakit').html('3');

    }

    function ReloadKosong(){

        $('#loadercontent').attr('style','display: none;');
        $('#contentkosong').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');

    }

    function ReloadMor3(){

        $('#loadercontent').attr('style','display: none;');
        $('#unitkerjamori').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#sehat').html('4');
        $('#sakit').html('0');

    }

    function ReloadPlumpang(){

        $('#loadercontent').attr('style','display: none;');
        $('#plumpang').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#sehat').html('3');
        $('#sakit').html('0');

    }

    function ReloadKramat(){

        $('#loadercontent').attr('style','display: none;');
        $('#kramat').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#sehat').html('1');
        $('#sakit').html('0');

    }

    function ReloadMor2(){

        $('#loadercontent').attr('style','display: none;');
        $('#morii').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#sehat').html('1');
        $('#sakit').html('2');

    }

    function ReloadMor1(){

        $('#loadercontent').attr('style','display: none;');
        $('#mori').attr('style','display: block;');

        $('.loaderz').attr('style','display: none;');
        $('.isi').attr('style','display: block;');
        $('#sehat').html('4');
        $('#sakit').html('1');

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

            } else if (ini == 'morii'){

                setTimeout(ReloadMor2, 2500);

            } else if (ini == 'mori'){

                setTimeout(ReloadMor1, 2500);

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

    


</script>