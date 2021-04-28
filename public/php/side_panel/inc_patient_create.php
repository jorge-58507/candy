<?php
date_default_timezone_set('America/Panama');
$name = ''; $active = '';
if (!empty($_GET['name'])) {
  $name = $_GET['name'];
  $active = 'active';
}
?>
<form name="form_patient_create" class="" action="" onsubmit="patient_funct.prototype.sidenav_patient_save(event);" method="post">

  <div class="row">
    <div class="col s12">
      <div class="input-field bt_1 bb_1 center-align">
        <h6>Crearemos un Paciente</h6>
      </div>
    </div>
    <div class="col s12">
      <div class="input-field">
        <label for="txt_patient_name" class="<?php echo $active; ?>">Nombre y Apellido</label>
        <input type="text" id="txt_patient_name" name="txt_patient_name" onfocus="general_funct.prototype.validFranz(this.id,['word'])" autocomplete="off" value="<?php echo $name ?>">
      </div>
    </div>
    <div class="col s12 m6 l6">
      <div class="input-field">
        <label for="txt_patient_identification">C&eacute;dula</label>
        <input type="text" id="txt_patient_identification" name="txt_patient_identification" onfocus="general_funct.prototype.validFranz(this.id,['number'],'-')" onblur="patient_funct.prototype.verify_identification(this)" autocomplete="off" value="">
      </div>
    </div>
    <div class="col s12 m6 l6">
      <div class="input-field">
        <label for="txt_patient_birthday">Fecha Nacimiento</label>
        <input type="text" id="txt_patient_birthday" class="datepicker" onfocus="general_funct.prototype.open_datepicker(<?php echo date('Y',strtotime($_GET['defaultDate'].' year')) ?>);" readonly name="txt_patient_birthday" autocomplete="off" value="">
      </div>
    </div>
    <div class="col s12 m6 l6">
      <div class="input-field">
        <label class="active" for="sel_patient_gender">Genero</label>
        <select id="sel_patient_gender" name="sel_patient_gender">
          <option value="" disabled selected>Seleccione</option>
          <option value="Masculino" >Masculino</option>
          <option value="Femenina" >Femenina</option>
          <option value="otro">Otro</option>
        </select>
      </div>
    </div>
    <div class="col s12 m6 l6">
      <div class="input-field">
        <label for="txt_patient_history" class="active"># de Historia</label>
        <input type="text" id="txt_patient_history" name="txt_patient_history" onfocus="general_funct.prototype.validFranz(this.id,['word','number'],'-')" onblur="patient_funct.prototype.verify_historynumber(this)" autocomplete="off"  value="<?php echo $_GET['h']; ?>">
      </div>
    </div>
    <div class="col s12">
      <div class="input-field">
        <label for="txt_patient_direction">Direcci&oacute;n</label>
        <textarea name="txt_patient_direction" id="txt_patient_direction" class="materialize-textarea" autocomplete="off"></textarea>
      </div>
    </div>
    <div class="col s12 center-align">
      <button class="btn waves-effect waves-light" type="submit" id="sidenav_send_patient" name="action">Agregar Paciente
        <i class="material-icons right">check_circle</i>
      </button>
    </div>
  </div>

</form>
<script type="text/javascript">

</script>
