<div class="modal fade text-left" id="modal_tambah" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Tambah Akses User Web</h4>
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
                                        <h3>Data User Akses Web</h3><hr>
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
                                                        <td>Pilih Role<span style="font-size: 14px;" class="text-danger">*</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <select class="form-control mandatory" id="role">
                                                                <option value="">-- Pilih Role --</option>
                                                                @foreach($roles as $role)
                                                                <option value="{{ $role->id }}"> {{ $role->name }}</option>
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
                                        <hr>
                                        
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
                <h4 class="modal-title white" id="myModalLabel8">Hapus User Akses Web</h4>
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

<div class="modal fade text-left" id="modal_edit" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Edit Akses User Web</h4>
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
                                        <h3>Data User Akses Web</h3><hr>
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
                                                        <td><input type="text" class="form-control" id="emailedit" placeholder="Alamat Email"></td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table width="100%">
                                                    <tr>
                                                        <td>Username <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control mandatoryedit" id="usernameedit" placeholder="Username">
                                                        <input type="hidden" id="idedit"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pilih Role<span style="font-size: 14px;" class="text-danger">*</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <select class="form-control mandatoryedit" id="roleedit">
                                                                <option value="">-- Pilih Role --</option>
                                                                @foreach($roles as $role)
                                                                <option value="{{ $role->id }}"> {{ $role->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                        
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
                <button onclick="Update()" type="button" class="btn btn-outline-success">Update</button>
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