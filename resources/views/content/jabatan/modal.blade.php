<div class="modal fade text-left" id="tambahjabatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Tambah Jabatan</h4>
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
                                    <table width="100%">
                                        <tr>
                                            <td>Nama Jabatan <span style="font-size: 14px;" class="text-danger">*</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control mandatory" id="nama" placeholder="Nama Jabatan"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-danger" data-dismiss="modal">Batal</button>
                <button onclick="Simpan()" type="button" class="btn btn-outline-success">Simpan</button> 
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade text-left" id="editjabatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Ubah Jabatan</h4>
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
                                    <table width="100%">
                                        <tr>
                                            <td>Nama Jabatan <span style="font-size: 14px;" class="text-danger">*</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control editmandatory" id="namaedit" placeholder="Nama Jabatan">
                                                <input type="hidden" id="id">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-danger" data-dismiss="modal">Batal</button>
                <button onclick="Update()" type="button" class="btn btn-outline-success">Update</button> 
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade text-left" id="deletejabatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Hapus Jabatan</h4>
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
                                        <tr><td height="20px"><input type="hidden" id="jabatanid" ></td></tr>
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
                <button onclick="Yakin()" type="button" class="btn btn-outline-success">Yakin</button> 
            </div>
            
        </div>
    </div>
</div>