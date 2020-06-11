@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ganti Password</h4><br>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table width="100%">
                            <tr>
                                <td><label>Password Baru</label><br>
                                    <input type="password" id="pass1" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><label>Konfirmasi Password Baru</label><br>
                                    <input type="password" id="pass2" class="form-control">
                                    <div style="padding-top: 8px;"><p class="text-danger"><i>Password setidaknya memiliki lebih dari 7 karakter!</i></p></div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <button onclick="GantiPass();" class="btn btn-success">Ganti Password</button>
                                    <a href="/home"><button class="btn btn-danger">Batal</button></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Zero configuration table -->
@include('includes.footer')
<script type="text/javascript">
    
    function GantiPass(){

        var pass1 = $('#pass1').val();
        var pass2 = $('#pass2').val();

        if(pass1.length > 7){

            if(pass1 != pass2){

                swal({
                    title: "Perhatikan!!",
                    text: "Password dan Konfirmasi Password Tidak Sama!",
                    icon: "error",
                    buttons: false,
                    timer: 2000,
                });

            } else {


                $.ajax({
                    type: 'POST',
                    url: "{{ route('gantipassword') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'password': pass1,
                       },
                    success: function(data) {

                        swal({
                            title: "Berhasil!!",
                            text: "Password Berhasil Diganti!",
                            icon: "success",
                            buttons: false,
                            timer: 2000,
                        });

                        setTimeout(function(){ window.location.href = '/home'; }, 1500);

                    }

                });


            }

        } else {

            swal({
                title: "Perhatikan!!",
                text: "Password Diharuskan lebih dari 7 Karakter!",
                icon: "error",
                buttons: false,
                timer: 2000,
            });

        }


    }

</script>
@stop