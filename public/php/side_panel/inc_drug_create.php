<?php
// date_default_timezone_set('America/Panama');
// $value = ''; $active = '';
// if (!empty($_GET['value'])) {
//   $value = $_GET['value'];
//   $active = 'active';
// }
?>
<form name="form_drug_create" class="" action="" onsubmit="cls_recipe.drug_save(event);" method="post">

  <div class="row">
    <div class="col s12">
      <div class="input-field bt_1 bb_1 center-align">
        <h6>Crearemos un Nuevo <br /> Medicamento</h6>
      </div>
    </div>
    <div class="col s12">
      <div class="input-field">
        <label for="txt_sidepanel_drug_generic">Nombre Gen&eacute;rico</label>
        <input type="text" id="txt_sidepanel_drug_generic" name="txt_sidepanel_drug_generic" onfocus="validFranz(this.id,'letter number')" autocomplete="off" value="">
      </div>
    </div>
    <div class="col s12">
      <div class="input-field">
        <label for="txt_sidepanel_drug_comertial">Nombre Comercial</label>
        <input type="text" id="txt_sidepanel_drug_comertial" name="txt_sidepanel_drug_comertial" onfocus="validFranz(this.id,'letter number')" autocomplete="off" value="">
      </div>
    </div>
    <div class="col s12 center-align">
      <button class="btn waves-effect waves-light" type="submit" name="action">Agregar Medicamento
        <i class="material-icons right">check_circle</i>
      </button>
    </div>
  </div>

</form>
<script type="text/javascript">


</script>
