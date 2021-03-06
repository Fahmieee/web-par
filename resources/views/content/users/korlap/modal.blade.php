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



<div class="modal fade text-left" id="modal_tambah" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Tambah Korlap</h4>
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
                                        <h3>Data Korlap</h3><hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table width="100%">
                                                    <tr>
                                                        <td>Nama Korlap <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control mandatory" id="nama" placeholder="Nama Korlap"></td>
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
                                                        <td>Nopeg <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control mandatory" id="nik" placeholder="Nomor Pegawai"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No Handphone</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" id="phone" placeholder="Nomor Handphone"></td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table width="100%">
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" id="alamat" placeholder="Alamat Korlap"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
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
                                        <hr>
                                        <br>
                                        <h3>Wilayah Korlap : <span style="font-size: 14px;" class="text-danger">*</span> :</h3><hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table width="100%">
                                                    <tr>
                                                        <td>
                                                            <select class="form-control mandatory" id="unitkerja">
                                                                <option value="">Pilih Unit Kerja</option>
                                                                @foreach($unitkerjas as $unitkerja)
                                                                    <option value="{{ $unitkerja->id }}">{{ $unitkerja->unitkerja_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- <hr>
                                                <table width="100%" id="customers" class="datatables2"> 
                                                    <thead>
                                                        <tr>
                                                            <th>Pilih</th>
                                                            <th>Nopeg</th>
                                                            <th>Nama Driver</th>
                                                            <th>Unit Kerja</th>
                                                            <th>Wilayah</th>
                                                            <th>Type</th>
                                                        </tr> 
                                                    </thead>
                                                   <tbody>
                                                       
                                                   </tbody>
                                                </table> -->
                                            </div>
                                        </div>
                                        <br>
                                        <span style="font-size: 14px;" class="text-danger"><i>* Form yang Wajib diisi</i></span>
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


<div class="modal fade text-left" id="deleteuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Hapus Driver</h4>
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
                                            <td align="center"><h5 class="text-muted">Anda Yakin Akan Hapus Driver ini? </h5></td>
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
                <button onclick="YakinHapusDriver()" type="button" class="btn btn-outline-success">Yakin</button> 
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade text-left" id="editkorlap" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Edit Korlap</h4>
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
                                        <h3>Data Korlap</h3><hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table width="100%">
                                                    <tr>
                                                        <td>Nama Korlap <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control mandatoryedit" id="namaedit" placeholder="Nama Korlap"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" id="emailedit" placeholder="Alamat Email"></td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table width="100%">
                                                    <tr>
                                                        <td>Nopeg <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control mandatoryedit" id="nikedit" placeholder="Nomor Pegawai"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No Handphone</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" id="phoneedit" placeholder="Nomor Handphone"></td>
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
                                                        <td>Alamat</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" id="alamatedit" placeholder="Alamat Korlap">
                                                            <input type="hidden" class="form-control" id="idedit">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- <hr> -->
                                        <br>
                                        <h3>Wilayah Korlap : <span style="font-size: 14px;" class="text-danger">*</span> :</h3><hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table width="100%">
                                                    <tr>
                                                        <td>
                                                            <select class="form-control mandatoryedit" id="unitkerjaedit">
                                                                <option value="">Pilih Unit Kerja</option>
                                                                @foreach($unitkerjas as $unitkerja)
                                                                    <option value="{{ $unitkerja->id }}">{{ $unitkerja->unitkerja_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                        <span style="font-size: 14px;" class="text-danger"><i>* Form yang Wajib diisi</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-danger" data-dismiss="modal">Close</button>
                <button onclick="UpdateKorlap()" type="button" class="btn btn-outline-success">Update</button>
            </div>
        </div>
    </div>
</div>