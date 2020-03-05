<div class="modal fade text-left" id="tambahunits" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Tambah Unit</h4>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table width="100%">
                                                <tr>
                                                    <td>Merk <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control unitz" id="merk" placeholder="Contoh: Toyota"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Varian</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="varian" placeholder="Contoh : VRZ, Prestige"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>CC Mobil</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="mes" placeholder="Contoh : 2000, 1800"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Polisi <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control unitz" id="nopol" placeholder="Contoh : B 9090 XXX"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table width="100%">
                                                <tr>
                                                    <td>Model Mobil <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control unitz" id="model" placeholder="Contoh: Camry, Fortuner"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Tahun Mobil</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="tahun" placeholder="Tahun"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Transmisi </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" id="transmisi">
                                                            <option>A/T</option>
                                                            <option>M/T</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Warna Mobil</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="color" placeholder="Contoh : Hitam, Biru, Merah"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
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

<div class="modal fade text-left" id="editunits" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Edit Unit</h4>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table width="100%">
                                                <tr>
                                                    <td>Merk <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control unitzedit" id="merkedit" placeholder="Contoh: Toyota"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Varian</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="varianedit" placeholder="Contoh : VRZ, Prestige"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>CC Mobil</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="mesedit" placeholder="Contoh : 2000, 1800"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Polisi <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control unitzedit" id="nopoledit" placeholder="Contoh : B 9090 XXX"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table width="100%">
                                                <tr>
                                                    <td>Model Mobil <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control unitzedit" id="modeledit" placeholder="Contoh: Camry, Fortuner"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Tahun Mobil</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="tahunedit" placeholder="Tahun"></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Transmisi </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control" id="transmisiedit">
                                                            <option>A/T</option>
                                                            <option>M/T</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Warna Mobil</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="coloredit" placeholder="Contoh : Hitam, Biru, Merah">
                                                        <input type="hidden" class="form-control" id="ids" ></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
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

<div class="modal fade text-left" id="deleteunit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Hapus Unit Kendaraan</h4>
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
                                            <td align="center"><h5 class="text-muted">Anda Yakin Akan Hapus Unit Kendaraan ini? </h5></td>
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
                <button onclick="YakinHapusUnit()" type="button" class="btn btn-outline-success">Yakin</button> 
            </div>
            
        </div>
    </div>
</div>