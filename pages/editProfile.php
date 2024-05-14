


<?php if(isLoggedIn()):?>
                        <div class="col-md-8">
                        <div class="card">
                            <form action="" method="post">
                                <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Edit Profile</p>
                                </div>
                                </div>
                                <div class="card-body text-dark font-weight-bold">
                                <p class="text-uppercase text-sm">Kullanıcı bilgileri</p>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Kullanıcı Adı</label>
                                        <input name="username" class="form-control" type="text" value="<?php echo $users->username;?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Mail Adresi</label>
                                        <input class="form-control" name="mail" type="email" value="<?php echo $users->mail;?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Ad</label>
                                        <input class="form-control" name="name" type="text" value="<?php echo $users->name;?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Soyad</label>
                                        <input class="form-control" name="surname" type="text" value="<?php echo $users->surname;?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Şifre</label>
                                        <input class="form-control" name="password" type="password">
                                    </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Biyografi</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Hakkında</label>
                                            <input class="form-control" name="biography" type="text" value="<?php echo $users->biography;?>">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-success w-100 m-2 p-2" type="submit">Bilgileri Güncelle</button>
                                </div>
                            </form>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="card card-profile align-items-center justify-content-center w-100">
                            <img src="/<?php echo $users->image;?>" style="height:200px; width:200px;" alt="Image placeholder" class="card-img-top">
                            <div class="row justify-content-center">
                            <div class="col-4 col-lg-4 order-lg-2">
                                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                </div>
                            </div>
                            </div>
                            <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                            <div class="d-flex justify-content-between">
                            </div>
                            </div>
                            <div class="card-body pt-0">
                            <div class="row">
                                <div class="col">
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid text-center">
                                    <span class="text-lg font-weight-bolder">22</span>
                                    <span class="text-sm opacity-8">Friends</span>
                                    </div>
                                    <div class="d-grid text-center mx-4">
                                    <span class="text-lg font-weight-bolder">10</span>
                                    <span class="text-sm opacity-8">Photos</span>
                                    </div>
                                    <div class="d-grid text-center">
                                    <span class="text-lg font-weight-bolder">89</span>
                                    <span class="text-sm opacity-8">Comments</span>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <h5>
                                <?php echo $users->name ." ". $users->surname;?><span class="font-weight-light"></span>
                                </h5>
                                <div class="h6 font-weight-300">
                                <i class="ni location_pin mr-2"></i>Bucharest, Romania
                                </div>
                                <div class="h6 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                                </div>
                                <div>
                                <i class="ni education_hat mr-2"></i>University of Computer Science
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php else:?>
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">Bu sayfaya giriş yetkiniz yok! <br> Lütfen hesabınız varsa giriş yapın yoksa kayıt olabilirsiniz.</div>
                            </div>
                        <?php endif?>