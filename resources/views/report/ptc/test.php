<br>
                        <div class="row">
                            <div class="col-4">
                                <p>Pilih Bagian :</p>
                                <select class="form-control" id="bagian">
                                   <option>All</option>
                                   @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <p>Pilih Bagian Detail:</p>
                                <select class="form-control" id="detail">
                                   <option>All</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <p>Pilih Level:</p>
                                <select class="form-control" id="level">
                                    <option>All</option>
                                   <option>High</option>
                                   <option>Medium</option>
                                   <option>Low</option>
                                </select>
                            </div>
                        </div> -->
                        <hr>
                        <!-- <!-- <div class="row"> -->
                            <div class="col-xl-4 col-lg-6 col-12">
                                <div class="card bg-gradient-directional-danger">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <div class="ball-pulse-sync loader-white loaderz" style="display: none;">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                    <h3 style="display: block;" class="text-white isi" id="total">12</h3>
                                                    <span>Total PTC Bermasalah</span>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="icon-wrench text-white font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-12">
                                <div class="card bg-gradient-directional-amber">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <div class="ball-pulse-sync loader-white loaderz" style="display: none;">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                    <h3 style="display: block;" class="text-white isi" id="onprogress">7</h3>
                                                    <span>PTC On Progress</span>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="icon-fire text-white font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-12">
                                <div class="card bg-gradient-directional-success">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <div class="ball-pulse-sync loader-white loaderz" style="display: none;">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                    <h3 style="display: block;" class="text-white isi" id="selesai">5</h3>
                                                    <span>PTC Bermasalah Selesai</span>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="icon-like text-white font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>