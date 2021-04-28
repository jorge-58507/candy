<div class="row">
  <div class="col s12 center-align">
    <div class="input-field col s12">
      <i id="close_sidenav" class="material-icons prefix sidenav-close cursor_pointer">cancel</i>
      <input type="text" id="txt_filter" name="txt_filter">
      <label for="email">Filtrar</label>
    </div>
  </div>

  <div class="col s12 center-align">
      <div id="container_filter" class="collection">
          <a class="waves-effect collection-item" href="#!" onclick="cls_configuration.set_user_form()">User</a>
          <a class="waves-effect collection-item" href="#!" onclick="cls_configuration.set_medic_form(user_list)">Medic</a>
      </div>
  </div>
</div>