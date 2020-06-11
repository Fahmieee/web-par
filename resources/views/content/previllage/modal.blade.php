<div class="modal fade text-left" id="tambahprevillage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Buat Previllages Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                                                <select class="form-control harus" id="roleid">
                                                    <option value="">-- Pilih Role -- </option>
                                                    @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }} </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        
                                    </table>
                                    <br>
                                    <div class="text-danger">* <i style="font-size: 10px">Harus Di isi</i></div>
                                    <br>
                                    <button onclick="SimpanPrevillageBaru()" class="btn btn-success">Simpan</button>

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
                                            <tr>
                                                <th>
                                                    <input type="checkbox" class="menu harus" value="{{ $menux->id }}">
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

<div class="modal fade text-left" id="hapusprevillage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title white" id="myModalLabel8">Hapus Previllages</h4>
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
                                            <td align="center"><h5 class="text-muted">Anda Yakin Hapus Data ini? </h5></td>
                                        </tr>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="modal-footer">
               <button onclick="YakinHapusPrevillages()" class="btn btn-danger">Hapus</button>   
            </div>
            
        </div>
    </div>
</div>