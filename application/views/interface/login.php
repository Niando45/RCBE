<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-login-image" style="background-image: url('public/new_interface/img/logo_dgi.jpg');"></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4">Bienvenue!</h4>
                                </div>
                                <?php if ($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <p><?php echo $this->session->flashdata('error'); ?></p>
                                    </div>
                                <?php endif; ?>

                                <form class="user" action="<?php echo base_url();?>Connexion_control/authentification_admin" method="POST">
                                    <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleInputEmail" aria-describedby="NifHelp" placeholder="Entrez votre NIFONLINE..." name="nifonline" ></div>
                                    <div class="mb-3"><input class="form-control form-control-user" type="email" id="exampleInputEmail" placeholder="Entrez votre adresse e-mail" name="email"  required></div>
                                    <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Entrez votre mot de passe" name="password"  required></div>
                                    <div class="mb-3">
                                        
                                    </div><button class="btn btn-outline-success d-block btn-user w-100 mb-3" type="submit">Se connecter</button>  
                                </form>
                                
                                <div class="text-center"><p>Vous n'avez pas de compte? <br> Veuillez</p><a class="small" href="<?php echo base_url() ; ?>Page/create_account">S'inscrire sur RCBE?</a></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  