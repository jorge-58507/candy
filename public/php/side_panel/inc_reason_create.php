<?php
date_default_timezone_set('America/Panama');
$value = ''; $active = '';
if (!empty($_GET['value'])) {
  $value = $_GET['value'];
  $active = 'active';
}
?>
<form name="form_reason_create" class="" action="" onsubmit="reason_funct.prototype.sidenav_reason_save(event);" method="post">

  <div class="row">
    <div class="col s12">
      <div class="input-field bt_1 bb_1 center-align">
        <h6>Crearemos un Nuevo <br /> Motivo de Consulta</h6>
      </div>
    </div>
    <div class="col s12">
      <div class="input-field">
        <label for="txt_reason_value" class="<?php echo $active; ?>">Descripci&oacute;n</label>
        <input type="text" id="txt_reason_value" name="txt_reason_value" onfocus="general_funct.prototype.validFranz(this.id,['word','number'])" autocomplete="off" value="<?php echo $value ?>">
      </div>
    </div>
    <div class="col s12 center-align">
      <button class="btn waves-effect waves-light" type="submit" id="sidenav_send_reason" name="action">Agregar Motivo
        <i class="material-icons right">check_circle</i>
      </button>
    </div>
  </div>

</form>
<script type="text/javascript">


</script>
