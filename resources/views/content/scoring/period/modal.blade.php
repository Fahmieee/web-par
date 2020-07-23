<div class="modal fade text-left" id="tambahperiode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Tambah Periode Penilaian</h4>
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
                                            <td>Nama Periode <span style="font-size: 14px;" class="text-danger">*</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control mandatory" id="nama" placeholder="Nama Periode"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Dari <span style="font-size: 14px;" class="text-danger">*</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="date" class="form-control mandatory" id="dari"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Sampai <span style="font-size: 14px;" class="text-danger">*</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="date" class="form-control mandatory" id="sampai"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="text-danger">* Harus diisi</td>
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

<div class="modal fade text-left" id="deleteperiod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Hapus Period</h4>
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
                                        <tr><td height="20px"><input type="hidden" id="periodid" ></td></tr>
                                        <tr>
                                            <td align="center"><h5 class="text-muted">Anda Yakin Akan Hapus Period ini? </h5></td>
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

<div class="modal fade text-left" id="editperiod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Ubah Periode Penilaian</h4>
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
                                            <td>Nama Periode <span style="font-size: 14px;" class="text-danger">*</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control editmandatory" id="namaedit" placeholder="Nama Periode">
                                                <input type="hidden" id="id">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Dari <span style="font-size: 14px;" class="text-danger">*</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="date" class="form-control editmandatory" id="dariedit"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Sampai <span style="font-size: 14px;" class="text-danger">*</span></td>
                                        </tr>
                                        <tr>
                                            <td><input type="date" class="form-control editmandatory" id="sampaiedit"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="text-danger">* Harus diisi</td>
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