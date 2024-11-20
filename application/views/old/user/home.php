<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs | <?php echo $title ;?></title>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/style.css">
</head>
<body>
    <h1 id="titre">Gestion des Utilisateurs</h1>
    <div> <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">+ Ajouter</a>

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      
      <div class="modal-header">
        <h4 class="modal-title">Ajouter un Utilisateurs</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      
      <div class="modal-body">
      <div class="container-fluid">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <form action="<?php echo base_url();?>User/register_user" method="POST" class="form-group">
                    <label for="nom">Nom:</label>
                    <input name="nom" type="text" class="form-control mb-2" required>
                    <label for="email">E-mail:</label>
                    <input name="email" type="text" class="form-control mb-2" required>
                    <label for="role">Rôle:</label>
                    <input name="role" type="text" class="form-control mb-2" required>
                    <input type="submit" class="btn btn-success" value="Ajouter" >
                </form>
            </div>
            <div class="col-4"></div>
        </div>
      </div>

      

    </div>
  </div>
</div></div>
    

        <div class="row mt-4">
            <div class="col-12">
                <table class="table"> 
                    <thead>
                        <tr>
                            <th class="bg-success text-white">ID</th>
                            <th class="bg-success text-white">Nom</th>
                            <th class="bg-success text-white">E-mail</th>
                            <th class="bg-success text-white">Rôle</th>
                            <th class="bg-success text-white">Statut</th> 
                            <th class="bg-success text-white"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($users); $i++): ?>
                            <tr>
                                <td><?php echo $users[$i]->id; ?></td>
                                <td><?php echo $users[$i]->nom; ?></td>
                                <td><?php echo $users[$i]->email; ?></td>
                                <td><?php echo $users[$i]->role; ?></td>
                                <td><?php echo ucfirst($users[$i]->status); ?></td> 
                                <td>
                                    
                                    

                                    <?php if ($users[$i]->status == 'actif'): ?>
                                        <a href="<?php echo base_url(); ?>User/suspend_user/<?php echo $users[$i]->id; ?>" class="btn btn-primary">Suspendre</a>
                                    <?php else: ?>
                                        <a href="<?php echo base_url(); ?>User/reactivate_user/<?php echo $users[$i]->id; ?>" class="btn btn-success">Réactiver</a>
                                    <?php endif; ?>

                                    
                                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $users[$i]->id; ?>">Modifier</a>
                                    <a href="<?php echo base_url(); ?>User/delete_user/<?php echo $users[$i]->id; ?>" class="btn btn-danger">Supprimer</a>
                                </td>
                            </tr>

                            
                            <div class="modal fade" id="myModal<?php echo $users[$i]->id; ?>" tabindex="-1" aria-labelledby="myModalLabel<?php echo $users[$i]->id; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                   
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel<?php echo $users[$i]->id; ?>">Modification de <?php echo $users[$i]->nom; ?></h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    
                                    <div class="modal-body">
                                        <form action="<?php echo base_url();?>User/update_user/<?php echo $users[$i]->id; ?>" method="POST" class="form-group">
                                            <label for="nom">Nom:</label>
                                            <input value="<?php echo $users[$i]->nom ;?>" name="nom" type="text" class="form-control mb-2" required>
                                            <label for="email">E-mail:</label>
                                            <input value="<?php echo $users[$i]->email ;?>" name="email" type="text" class="form-control mb-2" required>
                                            <label for="role">Rôle:</label>
                                            <input value="<?php echo $users[$i]->role ;?>" name="role" type="text" class="form-control mb-2" required>
                                            <input type="submit" class="btn btn-primary" value="Enregistrer">
                                        </form>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url();?>public/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>public/js/app.js"></script>
</body>
</html>



