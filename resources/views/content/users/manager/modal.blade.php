<div class="modal fade text-left" id="modal_tambah" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Tambah Manager</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="card-body">
                                    <div class="tab-content px-1 pt-1">
                                        <h3>Data Diri Manager</h3><hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table width="100%">
                                                    <tr>
                                                        <td>Nama Users <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control mandatory" id="nama" placeholder="Nama Pengguna"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" id="email" placeholder="Alamat Email"></td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table width="100%">
                                                    <tr>
                                                        <td>Username <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control mandatory" id="username" placeholder="Username"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pilih Wilayah<span style="font-size: 14px;" class="text-danger">*</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <select class="form-control mandatory" id="wilayah">
                                                                <option value="">-- Pilih Wilayah --</option>
                                                                @foreach($wilayahs as $wilayah)
                                                                <option value="{{ $wilayah->id }}">{{ $wilayah->unitkerja_name }} - {{ $wilayah->wilayah_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table width="100%">
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Password Pengguna <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control mandatory" id="pass" value="123456"></td>
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
                                                        <td><h3>Pilih Bawahan Manager :</h3> </td>
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
                                                            <th>Nama Asmen</th>
                                                            <th>Username</th>
                                                            <th>Unit Kerja</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($asmens as $asmen)
                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" class="asmen harus" value="{{ $asmen->id }}">
                                                            </th>
                                                            <td>{{ $asmen->first_name }}</td>
                                                            <td>{{ $asmen->username }}</td>
                                                            <td>{{ $asmen->unitkerja_name }}</td>
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
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-danger" data-dismiss="modal">Close</button>
                <button onclick="Simpan()" type="button" class="btn btn-outline-success">Simpan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade text-left" id="modal_edit" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Edit Asisten Manager</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="card-body">
                                    <div class="tab-content px-1 pt-1">
                                        <h3>Data Diri Asisten Manager</h3><hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table width="100%">
                                                    <tr>
                                                        <td>Nama Users <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control mandatoryedit" id="namaedit" placeholder="Nama Pengguna"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" id="emailedit" placeholder="Alamat Email">
                                                            <input type="hidden" class="form-control" id="idedit">
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
                                                        <td><input type="text" class="form-control mandatoryedit" id="usernameedit" placeholder="Username"></td>
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
                                                                <option value="{{ $wilayah->id }}">{{ $wilayah->unitkerja_name }} - {{ $wilayah->wilayah_name }}</option>
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
                                                        @foreach($asmens as $asmen)
                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" class="asmen harus" value="{{ $asmen->id }}">
                                                            </th>
                                                            <td>{{ $asmen->first_name }}</td>
                                                            <td>{{ $asmen->username }}</td>
                                                            <td>{{ $asmen->unitkerja_name }}</td>
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
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-danger" data-dismiss="modal">Close</button>
                <button onclick="Update()" type="button" class="btn btn-outline-success">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="deleteuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Hapus User Assisten Manager</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="card-body">
                                    <table border="0" align="center" width="100%">
                                        <tr>
                                            <td align="center"><img src="/assets/content/images/logo/info.png"></td>
                                        </tr>
                                        <tr><td height="20px"><input type="hidden" id="id" ></td></tr>
                                        <tr>
                                            <td align="center"><h5 class="text-muted">Anda Yakin Akan Hapus User ini? </h5></td>
                                        </tr>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-danger" data-dismiss="modal">Tidak</button>
                <button onclick="YakinHapusAsmen()" type="button" class="btn btn-outline-success">Yakin</button> 
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade text-left" id="modal_reset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Reset Password User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="card-body">
                                    <table border="0" align="center" width="100%">
                                        <tr>
                                            <td align="center"><img src="/assets/content/images/logo/info.png"></td>
                                        </tr>
                                        <tr><td height="20px"><input type="hidden" id="id" ></td></tr>
                                        <tr>
                                            <td align="center"><h5 class="text-muted">Anda Yakin Akan Reset Password User ini? </h5></td>
                                        </tr>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-danger" data-dismiss="modal">Tidak</button>
                <button onclick="ResetNow()" type="button" class="btn btn-outline-success">Yakin</button> 
            </div>
            
        </div>
    </div>
</div>