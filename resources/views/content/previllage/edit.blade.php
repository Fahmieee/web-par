@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Previllage</h4><br>
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
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-body">
                                            <table width="100%">
                                                <tr>
                                                    <td>Roles yang Dipilih <span style="font-size: 14px;" class="text-danger">*</span> :</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control harusedit" id="roleidedit">
                                                            <option value="">-- Pilih Role -- </option>
                                                            @foreach($roles as $role)
                                                            @php
                                                                if($role->id == $rolenow->id){
                                                                    $selected = 'selected';
                                                                } else {
                                                                    $selected = '';
                                                                }  
                                                            @endphp
                                                            <option value="{{ $role->id }}" {{ $selected }}>{{ $role->name }} </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                            <br>
                                            <div class="text-danger">* <i style="font-size: 10px">Harus Di isi</i></div>
                                            <br>
                                            <button onclick="UpdatePrevillage()" class="btn btn-success">Update</button>
                                            <a href="/previllage"><button class="btn btn-danger">Batal</button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-body">
                                            <table width="100%">
                                                <tr>
                                                    <td>Pilih Menu <span style="font-size: 14px;" class="text-danger">*</span> :</td>
                                                </tr>
                                            </table>
                                            <table width="100%" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">Ops</th>
                                                        <th>Pilih Menu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($menuxs as $menux)

                                                    @php
                                                    $ada = DB::table('previllages')
                                                    ->where([
                                                        ['role_id', '=', $rolenow->id],
                                                        ['menu_id', '=', $menux->id],
                                                    ])
                                                    ->first();

                                                    if($ada){
                                                        $checked = 'checked';
                                                    } else {
                                                        $checked = '';
                                                    }


                                                    @endphp
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="menu harus" value="{{ $menux->id }}" {{ $checked }}>
                                                        </th>
                                                        <td>{{ $menux->name }}</td>
                                                    </tr>
                                                    @endforeach
                                                    
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Zero configuration table -->
@include('includes.footer')
<script type="text/javascript">
        
    function UpdatePrevillage(){

        var empty = false;
        $('select.harusedit').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });
        if (empty) {

            swal({
                title: "Warning!!",
                text: "Harap isi Isian yang Berbintang!",
                icon: "error",
                buttons: false,
                timer: 2000,
            });

        } else {

            var menu = [];

            $('.menu:checked').each(function(){
                menu.push($(this).val());
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('updateprevillage') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'role': $('#roleidedit').val(),
                    'menu': menu,
                },
                success: function(data) {

                    swal({
                        title: "Berhasil!",
                        text: "Previllage Berhasil Diperbaharui",
                        icon: "success",
                        buttons: false,
                        timer: 2000,
                    });

                    setTimeout(function(){ window.location.href = '/previllage'; }, 1500);
                }

            });

        }

    }

</script>
@stop