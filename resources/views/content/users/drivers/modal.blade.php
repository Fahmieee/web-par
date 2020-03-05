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
                <h4 class="modal-title white" id="myModalLabel8">Tambah Driver</h4>
               <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-linetriangle no-hover-bg">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="base-tab41" data-toggle="tab" aria-controls="tab41" href="#tab41" aria-expanded="true">Data Driver</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#tab42" aria-expanded="false">Data User</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab43" data-toggle="tab" aria-controls="tab43" href="#tab43" aria-expanded="false">Pilih Unit</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab43" data-toggle="tab" aria-controls="tab43" href="#tab45" aria-expanded="false">Training</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content px-1 pt-1">
                                        <div role="tabpanel" class="tab-pane active" id="tab41" aria-expanded="true" aria-labelledby="base-tab41">
                                            <br>
                                            <h3>Data Driver</h3><hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table width="100%">
                                                        <tr>
                                                            <td>Nama Driver <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control mandatory" id="nama" placeholder="Nama Driver"></td>
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
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>No Handphone</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" id="phone" placeholder="Nomor Handphone"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nopeg <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control mandatory" id="nik" placeholder="Nomor Pegawai"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table width="100%">
                                                        <tr>
                                                            <td>Pilih Unit Kerja <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <select class="form-control select2 mandatory" id="unitkerja">
                                                                    @foreach($unitkerjas as $unitkerja)
                                                                    <option value="{{ $unitkerja->id }}">{{ $unitkerja->unitkerja_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pilih Wilayah <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <select class="form-control" id="wilayah">
                                                                    
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pilih Type Driver <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <select class="form-control mandatory" id="type">
                                                                    <option value="1">DEDICATED</option>
                                                                    <option value="2">POOL</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" id="alamat" placeholder="Alamat Driver"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <hr>
                                            <br>
                                            <h3>Dokument Driver</h3><hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table width="100%">
                                                        @foreach($docdrivers as $docdriver)
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control" value="{{ $docdriver->doc_name }}" disabled>
                                                                <input type="hidden" id="doc" value="{{ $docdriver->id }}">
                                                            </td>
                                                            <td>&nbsp;</td>
                                                            <td>
                                                                <input type="date" class="form-control" id="tanggal">    
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                            <span style="font-size: 14px;" class="text-danger"><i>* Form yang Wajib diisi</i></span>
                                        </div>
                                        <div class="tab-pane" id="tab42" aria-labelledby="base-tab42">
                                            <br>
                                            <h3>Data User</h3><hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table width="100%">
                                                        <tr>
                                                            <td>Nama User</td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" id="nama" placeholder="Nama Driver"></td>
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
                                                            <td>Pilih Jabatan</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <select class="form-control select2" id="">
                                                                    @foreach($jabatans as $jabatan)
                                                                    <option value="{{ $jabatan->id }}">{{ $jabatan->jabatan_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
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
                                        </div>
                                        <div class="tab-pane" id="tab43" aria-labelledby="base-tab43">
                                            <br>
                                            <table width="100%">
                                                <tr>
                                                    <td align="left"><h3>Pilih Unit </h3></td>
                                                    <td align="right"><!-- <button class="btn btn-success" onclick="BuatUnitBaru()"><i class="la la-plus"></i> Buat Unit Baru</button> --></td>
                                                </tr>
                                            </table>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table width="100%">
                                                        <tr>
                                                            <td>Pilih Unit <span style="font-size: 14px;" class="text-danger">*</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <select class="form-control select2" id="unit">
                                                                    
                                                                    
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <hr>
                                            <br>
                                            <h3>Dokument Unit</h3><hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table width="100%">
                                                        @foreach($docunits as $docunit)
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control" value="{{ $docunit->doc_name }}" disabled>
                                                                <input type="hidden" id="doc" value="{{ $docunit->id }}">
                                                            </td>
                                                            <td>&nbsp;</td>
                                                            <td>
                                                                <input type="date" class="form-control" id="tanggal">    
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                            <span style="font-size: 14px;" class="text-danger"><i>* Form yang Wajib diisi</i></span>
                                        </div>
                                        
                                        <div class="tab-pane" id="tab45" aria-labelledby="base-tab45">
                                            <br>
                                            <h3>Training Driver</h3><hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table width="100%">
                                                        @foreach($trains as $train)
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control" value="{{ $train->training_name }} - {{ $train->nick_name }}" disabled>
                                                                <input type="hidden" class="training" id="train" value="{{ $train->id }}">
                                                            </td>
                                                            <td>&nbsp;</td>
                                                            <td>
                                                                <select class="form-control training_answer">
                                                                    <option>Belum</option>
                                                                    <option>Sudah</option>
                                                                </select>    
                                                            </td>
                                                        </tr>
                                                        @endforeach
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
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-danger" data-dismiss="modal">Close</button>
                <button onclick="Simpan()" type="button" class="btn btn-outline-success">Simpan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade text-left" id="modal_unit_baru" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h4 class="modal-title white" id="myModalLabel8">Tambah Unit</h4>
                
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
                <button type="button" class="btn grey btn-outline-danger" onclick="Batal()">Batal</button>
                <button onclick="SimpanMobil()" type="button" class="btn btn-outline-success">Simpan</button> 
            </div>
            
        </div>
    </div>
</div>