<style>
    .input-group-addon {
        cursor: pointer;
    }
</style>

<div class="page-header">
  <h2>Renouvellement du mot de passe</h2>
</div>

<div class="row">
  <div class="col-md-4 col-md-offset-4">

    <form>
        <div class="form-group">
            <label for="pwd_old">Mot de passe actuel</label>
            <div class="input-group">
                <input type="password" class="form-control" id="pwd_old">
                <span class="input-group-addon" data-toggle-view="pwd_old"><i class="glyphicon glyphicon-eye-open"></i></span>
            </div>
        </div>

        <div class="form-group">
            <label for="pwd_new">Nouveau mot de passe</label>
            <div class="input-group">
                <input type="password" class="form-control" id="pwd_new">
                <span class="input-group-addon" data-toggle-view="pwd_new"><i class="glyphicon glyphicon-eye-open"></i></span>
            </div>
        </div>

        <div class="form-group">
            <label for="pwd_repeat">Répéter le nouveau mot de passe</label>
            <div class="input-group">
                <input type="password" class="form-control" id="pwd_repeat">
                <span class="input-group-addon" data-toggle-view="pwd_repeat"><i class="glyphicon glyphicon-eye-open"></i></span>
            </div>
        </div>

        <button type="button" name="button">Modifier le mot de passe</button>
    </form>

  </div>
</div>