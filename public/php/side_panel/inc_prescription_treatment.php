<?php    
$json_presentation = $_GET['presentation_json'];
$drug_id = $_GET['drug'];
$raw_presentation = json_decode($json_presentation, true);
?>

<form name="form_prescription_add" class="" action="" onsubmit="cls_recipe.treatment_sidenav_add(event,<?php echo $drug_id; ?>);" method="post">

  <div class="row">
    <div class="col s12">
      <div class="input-field bt_1 bb_1 center-align">
        <h6>En que dosis preescribir&aacute;</h6>
      </div>
    </div>
    <div class="col s12">
      <div class="input-field">
        <label class="active" for="txt_prescription_drug" >Medicamento</label>
        <input type="text" id="txt_prescription_drug" name="txt_prescription_drug" alt="<?php echo $_GET['drug_comertial'] ?>" value="<?php echo $_GET['drug_generic'] ?>" disabled>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <label class="active" for="txt_prescription_quantity" >Cantidad por Toma</label>
        <input type="number" id="txt_prescription_quantity" name="txt_prescription_quantity" onfocus="validFranz(this.id,'number')" value="1" autocomplete="off" tabindex="1">
      </div>
      <div class="input-field col s6">
        <label class="active" for="txt_prescription_dose" >Dosis</label>
        <input type="text" id="txt_prescription_dose" name="txt_prescription_dose" onfocus="validFranz(this.id,'number letter')" value="" class="autocomplete" autocomplete="off" tabindex="2">
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <label class="active" for="sel_prescription_presentation" >Presentaci&oacute;n</label>
        <select name="sel_prescription_presentation" id="sel_prescription_presentation" class="browse-default" tabindex="3">
<?php     foreach($raw_presentation as $key => $rs_presentation){   ?>
            <option value="<?php echo $rs_presentation['ai_presentation_id']; ?>"><?php echo $rs_presentation['tx_presentation_value']; ?></option>
<?php     } ?>
        </select>
      </div>
      <div class="input-field col s6">
        <input type="text" id="txt_prescription_frecuency" name="txt_prescription_frecuency" onfocus="validFranz(this.id,'number')" class="autocomplete" autocomplete="off" tabindex="4" value="">
        <label for="txt_prescription_frecuency">Frecuencia en Horas</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <input type="text" id="txt_prescription_duration" name="txt_prescription_duration" onfocus="validFranz(this.id,'number')" class="autocomplete" autocomplete="off" tabindex="5" value="">
        <label for="txt_prescription_duration">Duraci&oacute;n</label>
      </div>
      <div class="input-field col s6">
        <label class="active" for="sel_prescription_interval" >Intervalo</label>
        <select name="" id="sel_prescription_interval" tabindex="6">
          <option value="">Vacio</option>
          <option alt="1" value="dias" selected>Dias</option>
          <option alt="7" value="semanas">Semanas</option>
        </select>
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
