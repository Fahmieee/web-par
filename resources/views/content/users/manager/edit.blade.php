@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Assisten Manager</h4><br>
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
                        <!-- <div class="tab-content px-1 pt-1"> -->
<!--                             <h3>Data Diri Asisten Manager</h3><hr> -->
                        <div class="row">
                            <div class="col-md-6">
                                <table width="100%">
                                    <tr>
                                        <td>Nama Users <span style="font-size: 14px;" class="text-danger">*</span></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control mandatoryedit" id="namaedit" value="{{ $users->first_name }}" placeholder="Nama Pengguna"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control"  value="{{ $users->email }}" id="emailedit" placeholder="Alamat Email">
                                            <input type="hidden" value="{{ $users->id }}" class="form-control" id="idedit">
                                        </td>
                                    </tr>
                                    
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table width="100%">
                                    <tr>
                                        <td>Username <span style="font-size: 14px;" class="text-danger">*</span></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control mandatoryedit" id="usernameedit" value="{{ $users->username }}" placeholder="Username"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Pilih Wilayah<span style="font-size: 14px;" class="text-danger">*</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-control mandatoryedit" id="wilayahedit">
                                                <option value="">-- Pilih Wilayah --</option>
                                                @foreach($wilayahs as $wilayah)
                                                @php
                                                if($wilayah->id == $users->wilayah_id){
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }

                                                @endphp
                                                <option value="{{ $wilayah->id }}" {{ $selected }}>{{ $wilayah->unitkerja_name }} - {{ $wilayah->wilayah_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <table width="100%">
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td><h3>Pilih Bawahan Assisten Manager :</h3> </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table width="100%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="10%">Ops</th>
                                            <th>Nama Korlap</th>
                                            <th>Username</th>
                                            <th>Unit Kerja</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kors as $kor)
                                        @php

                                            $ada = DB::table('drivers')
                                            ->where([
                                                ['asmen_id', '=', $users->id],
                                                ['korlap_id', '=', $kor->id],
                                            ])
                                            ->distinct()
                                            ->first();

                                            if($ada){
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }

                                        @endphp
                                        <tr>
                                            <th>
                                                <input type="checkbox" class="korlaps harus" value="{{ $kor->id }}" {{ $checked }}>
                                            </th>
                                            <td>{{ $kor->first_name }}</td>
                                            <td>{{ $kor->username }}</td>
                                            <td>{{ $kor->unitkerja_name }}</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success" onclick="Update();"> Update Perubahan</button>
                                <a href="/asmen"><button class="btn btn-danger"> Batal</button></a>
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

    function Update(){

        var empty = false;
        $('select.mandatoryedit').each(function() {
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

            var korlaps = [];

            $('.korlaps:checked').each(function(){
                korlaps.push($(this).val());
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('updateasmen') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $('#idedit').val(),
                    'nama': $('#namaedit').val(),
                    'email': $('#emailedit').val(),
                    'wilayah': $('#wilayahedit').val(),
                    'username': $('#usernameedit').val(),
                    'korlaps': korlaps,
                },
                success: function(data) {

                    swal({
                        title: "Berhasil!",
                        text: "Datadiri Asmen Berhasil Diperbaharui",
                        icon: "success",
                        buttons: false,
                        timer: 2000,
                    });

                    setTimeout(function(){ window.location.href = '/asmen'; }, 1500);
                }

            });

        }

    }

</script>
@stop