<div class="container">
    <div class="card shadow-lg o-hidden border-0 my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-flex">
                <div class="flex-grow-1 bg-login-image" style="background-image: url('public/new_interface/img/dgi.jpg');"></div>
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h4 class="text-dark mb-4">Inscription sur RCBE</h4>
                        </div>
                        <form class="user"action="<?php echo base_url(); ?>register_control/enregistre_utilisateurs" method="POST">
                           
                            <div class="mb-3"><input class="form-control form-control-user" type="text" id="inputNom" aria-describedby="NomHelp" placeholder="Nom de l'entreprise" name="nom" required></div>
                            <div class="mb-3"><input class="form-control form-control-user" type="email" id="inputEmail" aria-describedby="emailHelp" placeholder="Entrez votre adresse e-mail" name="email" required></div>
                            <div class="mb-3"><input class="form-control form-control-user" type="password" id="inputPassword" aria-describedby="passwordHelp" placeholder="Entrez votre mot de passe" name="pwd" required></div>
                            <div class="mb-3">
                                <input class="form-control form-control-user" type="file" id="InputFile" aria-describedby="FileHelp" placeholder="" name="fichier" required>
                            </div>
                            
                            <div class="row mb-3">
                                
                            </div><button class="btn btn-outline-success d-block btn-user w-100 mb-3" type="submit">Créer un compte</button>
                           
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>