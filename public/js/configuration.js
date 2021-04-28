class class_configuration {
  set_medic_form (user_list){
    document.getElementById('close_sidenav').click();
    var option_list = '';
    for (const a in user_list) {
      option_list += `<option value="${user_list[a]['slug']}">${user_list[a]['name']}</option>`;
    }
    var content = `
    <div class="row">
      <div class="col s12">
        <ul class="tabs transparent">
          <li class="tab col s3"><a href="#tab_newmedic" >New Medic</a></li>
        </ul>
      </div>
      <div id="tab_newmedic" class="col s12 py_5 mhp_100">
        <div class="row flex flex-column justify-center text_center">
          <h4>Nuevo M&eacute;dico</h4>
          <div class="input-field col s6 pb_20">
            <input type="text" id="medic_pseudonym" name="medic_pseudonym">
            <label for="medic_pseudonym">Nombre</label>
          </div>
          <div class="input-field col s6 pb_20">
            <select name="medic_gender" id="medic_gender">
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
            <label for="medic_gender">Genero</label>
          </div>

          <div class="input-field col s6 pb_20">
            <input type="email" id="medic_email" name="medic_email">
            <label for="medic_email">E-mail</label>
          </div>
          <div class="input-field col s6 pb_20">
            <input type="text" id="medic_password_1" name="medic_password_1">
            <label for="medic_password_1">Contraseña</label>
          </div>
          <div class="input-field col s6 pb_20">
            <input type="text" id="medic_password_2" name="medic_password_2">
            <label for="medic_password_2">Confirmar Contraseña</label>
          </div>

          <div class="input-field col s6 pb_20">
            <input type="text" id="medic_speciality" name="medic_speciality">
            <label for="medic_speciality">Especialidad Principal</label>
          </div>
          <div class="input-field col s6 pb_20">
            <input type="text" id="medic_ubication" name="medic_ubication">
            <label for="medic_ubication">Ubicación</label>
          </div>
          <div class="input-field col s6 pb_20">
            <input type="text" id="medic_telephone" name="medic_telephone">
            <label for="medic_telephone">Teléfono</label>
          </div>
          <div class="row col s6 pb_20">
            <h4>Formato Medio</h4>
            <div class="input-field col s6 pb_20">
              <input type="text" id="medic_halfpage_line1" name="medic_halfpage_line1">
              <label for="medic_halfpage_line1">Top Linea 1</label>
            </div>
            <div class="input-field col s6 pb_20">
              <input type="text" id="medic_halfpage_line2" name="medic_halfpage_line2">
              <label for="medic_halfpage_line2">Top Linea 2</label>
            </div>
            <div class="input-field col s6 pb_20">
              <input type="text" id="medic_halfpage_line3" name="medic_halfpage_line3">
              <label for="medic_halfpage_line3">Top Linea 3</label>
            </div>
            <div class="row col s12">
              <div class="input-field col s6 pb_20">
                <input type="text" id="medic_halfpage_bottomline1" name="medic_halfpage_bottomline1">
                <label for="medic_halfpage_bottomline1">Bottom Linea 1</label>
              </div>
              <div class="input-field col s6 pb_20">
                <input type="text" id="medic_halfpage_bottomline2" name="medic_halfpage_bottomline2">
                <label for="medic_halfpage_bottomline2">Bottom Linea 2</label>
              </div>
            </div>
          </div>
          <div class="row col s6 pb_20">
            <h4>Formato Completo</h4>
            <div class="input-field col s6 pb_20">
              <input type="text" id="medic_page_line1" name="medic_page_line1">
              <label for="medic_page_line1">Top Linea 1</label>
            </div>
            <div class="input-field col s6 pb_20">
              <input type="text" id="medic_page_line2" name="medic_page_line2">
              <label for="medic_page_line2">Top Linea 2</label>
            </div>
            <div class="input-field col s6 pb_20">
              <input type="text" id="medic_page_line3" name="medic_page_line3">
              <label for="medic_page_line3">Top Linea 3</label>
            </div>
            <div class="input-field col s6 pb_20">
              <input type="text" id="medic_page_line4" name="medic_page_line4">
              <label for="medic_page_line4">Top Linea 4</label>
            </div>
            <div class="input-field col s6 pb_20">
              <input type="text" id="medic_page_bottomline1" name="medic_page_bottomline1">
              <label for="medic_page_bottomline1">Bottom Linea 1</label>
            </div>
            <div class="input-field col s6 pb_20">
              <input type="text" id="medic_page_bottomline2" name="medic_page_bottomline2">
              <label for="medic_page_bottomline2">Bottom Linea 2</label>
            </div>
          </div>            
          <div class="input-field col s6 text_center">
            <button class="btn waves-effect waves-light" type="button" id="btn_save_medic" onclick="cls_medic.save()">Guardar
              <i class="material-icons right">save</i>
            </button>
          </div>
        </div>
      </div>
    </div>`;
    document.getElementById("container_target").innerHTML = content;
    var el_select = document.querySelectorAll('select');
    var instance_select = M.FormSelect.init(el_select);
    var el_tab = document.querySelectorAll('.tabs');
    var instance_tab = M.Tabs.init(el_tab);
  }
  clear_medic_form(array_form){
    for (const a in array_form) {
      array_form[a].value = '';
    }
  }
}
class class_opt_recipe 
{
  constructor(raw_druglist, raw_treatmentlist){
    this.array_opt_recipe['drug_list'] = raw_druglist;
    this.array_opt_recipe['treatment_list'] = raw_treatmentlist;

    this.array_treatment = new Object;
  }
  // #############      TREATMENT      #############
  render_opt_treatment (tbl_druglist) {
    var content = `
    <div id="container_top" class="row mb_0">
      <div class="input-field col s8">
        <input id="txt_treatment_title" name="txt_treatment_title" type="text" class="">
        <label for="txt_treatment_title">T&iacute;tulo</label>
      </div>
      <div class="col s2 pt_25">
        <a class="waves-effect waves-light btn" onclick="cls_recipe.treatment_save();"><i class="fa fa-save left"></i>Guardar</a>
      </div>
      <div class="col s2 pt_15 center-align">
        <a class="waves-effect waves-light btn red accent-2 btn-floating btn-large" title="Tratamientos Guardados" onclick="cls_recipe.render_saved_treatment(cls_recipe.generate_treatmentlist())"><i class="fa fa-angle-right x2"></i></a>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12 my_0">
        <div class="input-field col s12 m6 l6 pl_0 my_0">
          <input id="txt_treatment_filtermedicine" type="text" onkeyup="cls_recipe.treatment_filter_medicine(this.value)">
          <label for="txt_treatment_filtermedicine">Buscar Medicamento</label>
        </div>
      </div>
      <div id="tbl_druglist" class="col s12 m6 l6">
        <div class="col s12 header_list h_30 teal lighten-2">
          LISTADO DE MEDICAMENTOS
        </div>
        <div class="col s12 list h_400">
          ${tbl_druglist}
        </div>
      </div>
      <div class="col s12 m6 l6">
        <div class="col s12 header_list h_30 teal lighten-2">
          MEDICAMENTOS AGREGADOS
        </div>
        <div class="col s12 list h_400" id="container_treatment">
        </div>
      </div>
    </div>
    `
    document.getElementById('container_render').innerHTML = content;
  }
  generate_drug_list(met, target = '', status = 1, raw_druglist = this.array_opt_recipe['drug_list']) {
    if (target === 'sidenav') { var data_target = "side_nav"; var trigger = "sidenav-trigger"; } else { var data_target = ""; var trigger = ""; }
    var tbl_druglist = '';
    for (const x in raw_druglist) {
      if (status === 1) {      
        if (raw_druglist[x]['status'] === 1) {
          tbl_druglist += `<div id="${raw_druglist[x]['slug']}" class="${trigger} item compact" data-target="${data_target}" onclick="cls_recipe.${met}(this)" title="${raw_druglist[x]['comertial']}">${raw_druglist[x]['generic']}</div>`;
        }
      }else{
        tbl_druglist += `<div id="${raw_druglist[x]['slug']}" class="${trigger} item compact" data-target="${data_target}" onclick="cls_recipe.${met}(this)" title="${raw_druglist[x]['comertial']}">${raw_druglist[x]['generic']}</div>`;
      }
    }
    return tbl_druglist;
  }
  drug_filter_medicine (str)  {
    var raw_drug = this.lookfor_medicine(str);
    var content_list = this.generate_drug_list('drug_option_picklist', '', 0, raw_drug);
    var content = `
      <div class="col s12 header_list h_30 teal lighten-2">
        LISTADO DE TRATAMIENTOS
      </div>
      <div class="col s12 list h_400">
        ${content_list}
      </div>
    `

    document.getElementById('tbl_druglist').innerHTML = content;
  }
  treatment_filter_medicine(str) {
    var raw_drug = this.lookfor_medicine(str);  
    var content_list = this.generate_drug_list('treatment_drug_picklist', 'sidenav', 1, raw_drug);
    var content = `
      <div class="col s12 header_list h_30 teal lighten-2">
        LISTADO DE TRATAMIENTOS
      </div>
      <div class="col s12 list h_400">
        ${content_list}
      </div>
    `

    document.getElementById('tbl_druglist').innerHTML = content;
  }
  lookfor_medicine(str) {
    var haystack = this.array_opt_recipe['drug_list'];
    var needles = str.split(' ');
    var raw_filtered = new Object;
    for (var i in haystack) {
      var ocurrencys = 0;
      for (const a in needles) {
        if (haystack[i]['generic'].toLowerCase().indexOf(needles[a].toLowerCase()) > -1 || haystack[i]['comertial'].toLowerCase().indexOf(needles[a].toLowerCase()) > -1) { ocurrencys++ }
      }
      if (ocurrencys === needles.length) {       
        raw_filtered[i] = haystack[i];
      }
    }
    return this.reorder_druglist(raw_filtered)
  }
  reorder_druglist(raw_filtered) {
    var raw_ordered = []; var raw_returned = new Object;
    for (var a in raw_filtered) { raw_ordered.push(raw_filtered[a]['generic'] + '*-*' + a); }
    raw_ordered.sort();
    for (var i = 0; i < raw_ordered.length; i++) {
      var splited = raw_ordered[i].split("*-*");
      raw_returned[splited[1]] = new Object;
      raw_returned[splited[1]]['generic'] = splited[0];
      raw_returned[splited[1]]['comertial'] = raw_filtered[splited[1]]['comertial'];
      raw_returned[splited[1]]['slug'] = raw_filtered[splited[1]]['slug'];
      raw_returned[splited[1]]['status'] = raw_filtered[splited[1]]['status'];
    }
    return raw_returned
  }

  treatment_drug_picklist(div_obj) {
    var slug = div_obj.id;
    var url = '/treatment_drugpicked/' + slug; var method = 'GET';
    var body = '';
    var funcion = function (ans_obj) {
      var drug_info = ans_obj['drug_info'];
      var presentation_list = JSON.stringify(ans_obj['presentation_list']);
      set_sidenav(`/php/side_panel/inc_prescription_treatment.php?drug_generic=${drug_info.tx_drug_generic}&drug_comertial=${drug_info.tx_drug_comertial}&dose_json=${drug_info.tx_drug_dose}&frecuency_json=${drug_info.tx_drug_frecuency}&presentation_json=${presentation_list}&drug=${slug}`);
      var raw_frecuency = JSON.parse(drug_info.tx_drug_frecuency);
      var raw_dose = JSON.parse(drug_info.tx_drug_dose);
      setTimeout(function () {
        var el_select = document.querySelectorAll('select');
        var instance_select = M.FormSelect.init(el_select);
        var frecuency_autocomplete = document.getElementById('txt_prescription_frecuency');
        var options = { data: raw_frecuency }
        var instance_autocomplete = M.Autocomplete.init(frecuency_autocomplete, options);
        var dose_autocomplete = document.getElementById('txt_prescription_dose');
        var options = { data: raw_dose }
        var instance_autocomplete = M.Autocomplete.init(dose_autocomplete, options);
        set_focus('txt_prescription_quantity');
      }, 600)
    }
    laravel_request(url, method, funcion, body);
  }
  treatment_sidenav_add (event,drug_id) {
    event.preventDefault();
    requiredFields(['txt_prescription_dose', 'txt_prescription_frecuency']);
    var drug_description = document.getElementById('txt_prescription_drug').value;
    var drug_comertial = document.getElementById('txt_prescription_drug').getAttribute('alt');;
    var prescription_quantity = document.getElementById('txt_prescription_quantity').value;
    var prescription_dose = document.getElementById('txt_prescription_dose').value;
    var presentation = document.getElementById('sel_prescription_presentation');
    var prescription_presentation = presentation[presentation.selectedIndex].innerHTML;
    var prescription_duration = document.getElementById('txt_prescription_duration').value;
    var prescription_frecuency = document.getElementById('txt_prescription_frecuency').value;
    var select_interval = document.getElementById('sel_prescription_interval');
    var interval_factor = select_interval[select_interval.selectedIndex].getAttribute('alt');
    var prescription_interval = select_interval[select_interval.selectedIndex].value;

    if (prescription_interval === '' && prescription_duration != '' || prescription_interval != '' && prescription_duration === '') {
      document.getElementById('txt_prescription_duration').classList.add('invalid');
    } else {
      document.getElementById('txt_prescription_duration').classList.remove('invalid');
      document.getElementById('txt_prescription_duration').classList.add('valid');
    }
    if (prescription_interval === '' && prescription_duration === '') {
      document.getElementById('txt_prescription_duration').classList.remove('invalid');
      document.getElementById('txt_prescription_duration').classList.add('valid');
      prescription_duration = 'nuevo aviso';
    }
    var valid = check_invalid(['txt_prescription_dose', 'txt_prescription_frecuency', 'txt_prescription_duration']);
    if (!valid) { return false; }
    // Agregado al array de tto
    var key_drug = 0;
    for (const x in this.array_treatment) { key_drug++;  }    
    this.array_treatment[key_drug] = {
      'drug_id': drug_id, 'description': drug_description, 'comertial': drug_comertial, 'quantity': prescription_quantity, 'dose': prescription_dose,
      'presentation_id': presentation.value, 'presentation': prescription_presentation, 'frecuency': prescription_frecuency,
      'duration': prescription_duration, 'interval': prescription_interval, 'interval_factor': parseInt(interval_factor)};
      
    document.getElementById("container_treatment").innerHTML = this.treatment_generate();
    $('.sidenav').sidenav('close');
  }
  treatment_generate () {
    var raw_treatment = this.array_treatment;
    var content_treatment = '';
    for (const key in raw_treatment) {
      content_treatment += `
      <div class="row item item_large mb_0 valign-wrapper">
        <div class="col s8 m8 l10">
          <strong>${raw_treatment[key]['description']}</strong> ${raw_treatment[key]['presentation']} ${raw_treatment[key]['dose']}</br>
          Adm. ${raw_treatment[key]['quantity']} cada ${raw_treatment[key]['frecuency']} horas, hasta ${raw_treatment[key]['duration'] + ' ' + raw_treatment[key]['interval']}
        </div>
        <div class="col s4 m4 l2"> 
          <a class="btn-floating waves-effect waves-light btn btn-small red lingthen-2" onclick="cls_recipe.treatment_del_item(${key});"><i class="fa fa-times"></i></a>
        </div>
      </div>
      `;
    }
    return content_treatment;
  }
  treatment_del_item (key) {
    delete this.array_treatment[key];
    document.getElementById("container_treatment").innerHTML = this.treatment_generate();  
  }
  treatment_save () {
    requiredFields(['txt_treatment_title']);
    var valid = check_invalid(['txt_treatment_title']);
    if (!valid) { return false; }
    var key_drug = 0;
    for (const x in this.array_treatment) { key_drug++; }    
    if (key_drug < 1) {
      M.toast({ html: 'Agregue Medicamentos' });
      return false;
    }
    var array_treatment = this.array_treatment;
    this.array_treatment = new Object;

    var treatment_title = document.getElementById("txt_treatment_title").value;
    var url = '/treatment'; var method = 'POST';
    var body = JSON.stringify({ a : treatment_title, b : array_treatment });
    var funcion = function (ans_obj) {
      class_opt_recipe.prototype.array_opt_recipe['treatment_list'] = ans_obj['treatmentlist'];
      set_empty('txt_treatment_title');
      document.getElementById("container_treatment").innerHTML = '';
      class_opt_recipe.prototype.render_saved_treatment(class_opt_recipe.prototype.generate_treatmentlist());
      M.toast({ html: ans_obj['message'] });
    }
    async_laravel_request(url, method, funcion, body);
  }

// TRATAMIENTOS GUARDADOS

  generate_treatmentlist() {    
    var raw_list = this.array_opt_recipe['treatment_list'];
    var tbl_list = '';
    for (const x in raw_list) {
      tbl_list += `<div id="${raw_list[x]['slug']}" class="item compact" onclick="cls_recipe.treatment_saved_picklist(this)">${raw_list[x]['title']}</div>`;
    }
    return tbl_list;
  }
  render_saved_treatment(tbl_treatmentlist) {
    var content = `
      <div class="col s12 header_list h_30 teal lighten-2">
        LISTADO DE TRATAMIENTOS
      </div>
      <div class="col s12 list h_400">
        ${tbl_treatmentlist}
      </div>
    `
    document.getElementById('tbl_druglist').innerHTML = content;

    var container_top = `
      <div class="input-field col s8">
        &nbsp;
      </div>
      <div class="col s2 pt_25">
        <a id="btn_erase_treatment" class="waves-effect red lighten-1 waves-light btn" onclick="cls_recipe.treatment_erase(this);"><i class="fa fa-trash left"></i>Borrar</a>      
      </div>
      <div class="col s2 pt_15 center-align">
        <a class="waves-effect waves-light btn red accent-2 btn-floating btn-large" title="Nuevo Tratamiento" onclick="cls_recipe.render_opt_treatment(cls_recipe.generate_drug_list('treatment_drug_picklist','sidenav',1))"><i class="fa fa-angle-left x2"></i></a>
      </div>
    `;
    document.getElementById('container_top').innerHTML = container_top;
  }
  treatment_saved_picklist (div_obj) {
    var treatment_slug = div_obj.id;
    var url = '/treatment/' + treatment_slug; var method = 'GET';
    var body = '';
    var funcion = function (ans_obj) {
      var array_treatment = JSON.parse(ans_obj['tx_treatment_json']);
      var content = '';
      for (const a in array_treatment) {
        content += `
        <div class="row item item_large mb_0 valign-wrapper">
          <div class="col s12 m12 l12">
            <strong>${array_treatment[a]['description']}</strong> ${array_treatment[a]['presentation']} ${array_treatment[a]['dose']}</br>
            Adm. ${array_treatment[a]['quantity']} cada ${array_treatment[a]['frecuency']} horas, hasta ${array_treatment[a]['duration'] + ' ' + array_treatment[a]['interval']}
          </div>
        </div > `;
      }
      document.getElementById("container_treatment").innerHTML = content;
      document.getElementById("btn_erase_treatment").setAttribute("alt",treatment_slug);
    }
    laravel_request(url, method, funcion, body);
  }
  treatment_erase (DomElement) {
    var treatment_slug = DomElement.getAttribute('alt');
    var array_treatmentlist = this.array_opt_recipe['treatment_list'];
    var array_index = '';
    for (const a in this.array_opt_recipe['treatment_list']) {
      if(array_treatmentlist[a]['slug'] === treatment_slug) { array_index = a;  }
    }
    delete this.array_opt_recipe['treatment_list'][array_index];
    var url = '/treatment/' + treatment_slug; var method = 'DELETE';
    var body = '';
    var funcion = function (ans_obj) {
      var raw_list = ans_obj['treatmentlist'];
      var tbl_list = '';
      for (const x in raw_list) {
        tbl_list += `<div id="${raw_list[x]['slug']}" class="item compact" onclick="cls_recipe.treatment_saved_picklist(this)">${raw_list[x]['title']}</div>`;
      }

      var content = `
      <div class="col s12 header_list h_30 teal lighten-2">
        LISTADO DE TRATAMIENTOS
      </div>
      <div class="col s12 list h_400">
        ${tbl_list}
      </div>
    `
      document.getElementById('tbl_druglist').innerHTML = content;

      var container_top = `
      <div class="input-field col s8">
        &nbsp;
      </div>
      <div class="col s2 pt_25">
        <a id="btn_erase_treatment" class="waves-effect red lighten-1 waves-light btn" onclick="cls_recipe.treatment_erase(this);"><i class="fa fa-trash left"></i>Borrar</a>      
      </div>
      <div class="col s2 pt_15 center-align">
        <a class="waves-effect waves-light btn red accent-2 btn-floating btn-large" title="Tratamiento Nuevo" onclick="cls_recipe.render_opt_treatment(cls_recipe.generate_drug_list('treatment_drug_picklist','sidenav',1))"><i class="fa fa-angle-left x2"></i></a>
      </div>
    `;
      document.getElementById('container_top').innerHTML = container_top;
      document.getElementById('container_treatment').innerHTML = '';
      M.toast({ html: ans_obj['message'] });
    }
    laravel_request(url, method, funcion, body);
  }

  // MEDICAMENTOS

  render_opt_drug(tbl_druglist) {
    var content = `
    <div class="row">
      <div class="input-field col s12 my_0">
        <div class="input-field col s12 m6 l6 pl_0 my_0">
          <input id="txt_drug_filtermedicine" type="text" onkeyup="cls_recipe.drug_filter_medicine(this.value)">
          <label for="txt_drug_filtermedicine">Buscar Medicamento</label>
        </div>
      </div>
      <div id="tbl_druglist" class="col s12 m6 l6">
        <div class="col s12 header_list h_30 teal lighten-2">
          LISTADO DE MEDICAMENTOS
        </div>
        <div class="col s12 list h_400">
          ${tbl_druglist}
        </div>
      </div>
      <div class="col s12 m6 l6">
        <div class="col s12 h_30">&nbsp;</div>
        <div class="col s12 list h_400" id="container_drugoption"></div>
      </div>
      <div class="col s12 m6 l6 pt_10 center-align">
        <a id="btn_drug_create" data-target="side_nav" class="sidenav-trigger waves-effect waves-light blue darken-1 btn" onclick="cls_recipe.drug_create(event);">Nuevo Medicamento</a>

      </div>
    </div>
    `
    document.getElementById('container_render').innerHTML = content;
  }

  drug_option_picklist(div_obj) {
    var drug_slug = div_obj.id;
    var url = '/drug/' + drug_slug; var method = 'GET';
    var body = '';
    var funcion = function (ans_obj) {
      const array_dose = JSON.parse(ans_obj['tx_drug_dose']);
      var list_dose = `<ul class="collection with-header"><li class="collection-item px_10"><div class="fs_30 font_bolder">Dosis<a onclick="cls_recipe.trigger_newdose(event)" href="#drug_new_dose" class="secondary-content teal-text modal-trigger"><i class="fa fa-plus-circle"></i></a></div></li>`;
      for (const a in array_dose) { list_dose += `<li class="collection-item"><div>${a}<a href="#!" onclick="cls_recipe.drug_del_dose(event,'${a}')" class="secondary-content red-text"><i class="fa fa-times"></i></a></div></li>`; }
      list_dose += '</ul>';

      const array_frecuency = JSON.parse(ans_obj['tx_drug_frecuency']);
      var list_frecuency = `<ul class="collection with-header"><li class="collection-item px_10"><div class="fs_30 font_bolder">Frecuencia<a onclick="cls_recipe.trigger_newfrecuency(event)" href="#drug_new_frecuency" class="secondary-content teal-text modal-trigger"><i class="fa fa-plus-circle"></i></a></div></li>`;
      for (const a in array_frecuency) { list_frecuency += `<li class="collection-item"><div>${a} Horas<a href="#!" onclick="cls_recipe.drug_del_frecuency(event,'${a}')" class="secondary-content red-text"><i class="fa fa-times"></i></a></div></li>`; }
      list_frecuency += '</ul>';
      if (ans_obj['tx_drug_status'] === 0) {
        var btn_status = `<a class="waves-effect waves-light green darken-2 btn" onclick="cls_recipe.drug_updstatus(event);"><i class="fa fa-check left"></i>Activar</a>`;
      } else {
        var btn_status = `<a class="waves-effect waves-light amber darken-2 btn" onclick="cls_recipe.drug_updstatus(event);"><i class="fa fa-times left"></i>Eliminar</a>`;
      }
      var content = `
        <div class="row">
          <div class="input-field col s12">
            <input id="txt_drug_generic" name="txt_drug_generic" type="text" class="" alt="${ans_obj['tx_drug_slug']}" value="${ans_obj['tx_drug_generic']}">
            <label for="txt_drug_generic" class="active">Gen&eacute;rico</label>
          </div>
          <div class="input-field col s12">
            <input id="txt_drug_comertial" name="txt_drug_comertial" type="text" class="" value="${ans_obj['tx_drug_comertial']}">
            <label for="txt_drug_comertial" class="active">Comercial</label>
          </div>
          <div class="input-field col s12 center-align">
            ${btn_status}
            &nbsp;
            <a class="waves-effect waves-light green accent-4 btn" onclick="cls_recipe.drug_update(event);"><i class="fa fa-save left"></i>Actualizar</a>
          </div>
          <div id="dose_list" class="input-field col s6">${list_dose}</div>
          <div id="frecuency_list" class="input-field col s6">${list_frecuency}</div>
        </div>
      `;
      document.getElementById('container_drugoption').innerHTML = content;
    }
    laravel_request(url, method, funcion, body);
  }

  drug_save_dose(event) {
    event.preventDefault();
    var drug_slug = document.getElementById("txt_drug_generic").getAttribute("alt");
    var dose = document.getElementById("txt_modal_dose").value;
    var url = '/drug_dose'; var method = 'POST';
    var body = JSON.stringify({ a: drug_slug, b: dose });
    var funcion = function (ans_obj) {
      set_empty('txt_modal_dose');
      const array_dose = ans_obj;
      var list_dose = `<ul class="collection with-header"><li class="collection-item px_10"><div class="fs_30 font_bolder">Dosis<a onclick="cls_recipe.trigger_newdose(event)" href="#drug_new_dose" class="secondary-content teal-text modal-trigger"><i class="fa fa-plus-circle"></i></a></div></li>`;
      for (const a in array_dose) { list_dose += `<li class="collection-item"><div>${a}<a href="#!" onclick="cls_recipe.drug_del_dose(event,'${a}')" class="secondary-content red-text"><i class="fa fa-times"></i></a></div></li>`; }
      list_dose += '</ul>';
      document.getElementById("dose_list").innerHTML = list_dose;
    }
    laravel_request(url, method, funcion, body);
  }
  drug_del_dose(event,dose) {   
    event.preventDefault();
    var drug_slug = document.getElementById("txt_drug_generic").getAttribute("alt");
    var url = '/drug_dose/delete'; var method = 'DELETE';
    var body = JSON.stringify({ a: drug_slug, b: dose });
    var funcion = function (ans_obj) {      
      const array_dose = ans_obj;
      var list_dose = `<ul class="collection with-header"><li class="collection-item px_10"><div class="fs_30 font_bolder">Dosis<a onclick="cls_recipe.trigger_newdose(event)" href="#drug_new_dose" class="secondary-content teal-text modal-trigger"><i class="fa fa-plus-circle"></i></a></div></li>`;
      for (const a in array_dose) { list_dose += `<li class="collection-item"><div>${a}<a href="#!" onclick="cls_recipe.drug_del_dose(event,'${a}')" class="secondary-content red-text"><i class="fa fa-times"></i></a></div></li>`; }
      list_dose += '</ul>';
      document.getElementById("dose_list").innerHTML = list_dose;      
    }
    laravel_request(url, method, funcion, body);
  }

  drug_save_frecuency(event) {
    event.preventDefault();
    var drug_slug = document.getElementById("txt_drug_generic").getAttribute("alt");
    var frecuency = document.getElementById("txt_modal_frecuency").value;
    var url = '/drug_frecuency'; var method = 'POST';
    var body = JSON.stringify({ a: drug_slug, b: frecuency });
    var funcion = function (ans_obj) {
      set_empty('txt_modal_frecuency');
      const array_frecuency = ans_obj;
      var list_frecuency = `<ul class="collection with-header"><li class="collection-item px_10"><div class="fs_30 font_bolder">Frecuencia<a onclick="cls_recipe.trigger_newfrecuency(event)" href="#drug_new_frecuency" class="secondary-content teal-text modal-trigger"><i class="fa fa-plus-circle"></i></a></div></li>`;
      for (const a in array_frecuency) { list_frecuency += `<li class="collection-item"><div>${a} Horas<a href="#!" onclick="cls_recipe.drug_del_frecuency(event,'${a}')" class="secondary-content red-text"><i class="fa fa-times"></i></a></div></li>`; }
      list_frecuency += '</ul>';
      document.getElementById("frecuency_list").innerHTML = list_frecuency;
    }
    laravel_request(url, method, funcion, body);
  }

  drug_del_frecuency(event,frecuency) {
    event.preventDefault();
    var drug_slug = document.getElementById("txt_drug_generic").getAttribute("alt");
    var url = '/drug_frecuency/delete'; var method = 'DELETE';
    var body = JSON.stringify({ a: drug_slug, b: frecuency });
    var funcion = function (ans_obj) {
      const array_frecuency = ans_obj;

      var list_frecuency = `<ul class="collection with-header"><li class="collection-item px_10"><div class="fs_30 font_bolder">Frecuencia<a onclick="cls_recipe.trigger_newfrecuency(event)" href="#drug_new_frecuency" class="secondary-content teal-text modal-trigger"><i class="fa fa-plus-circle"></i></a></div></li>`;
      for (const a in array_frecuency) { list_frecuency += `<li class="collection-item"><div>${a} Horas<a href="#!" onclick="cls_recipe.drug_del_frecuency(event,'${a}')" class="secondary-content red-text"><i class="fa fa-times"></i></a></div></li>`; }
      list_frecuency += '</ul>';
      document.getElementById("frecuency_list").innerHTML = list_frecuency;
      
    }
    laravel_request(url, method, funcion, body);
  }
  trigger_newdose(event) {
    event.preventDefault();
    setTimeout(function () {
      validFranz('txt_modal_dose', 'number letter');
      set_focus('txt_modal_dose');
    }, 500);
  }
  trigger_newfrecuency(event) {
    event.preventDefault();
    setTimeout(function () {
      validFranz('txt_modal_frecuency', 'number');
      set_focus('txt_modal_frecuency');
    }, 500);
  }
  drug_updstatus(event) {
    event.preventDefault();
    var drug_slug = document.getElementById("txt_drug_generic").getAttribute("alt");
    var url = '/drug/'+drug_slug; var method = 'DELETE';
    var body = '';
    var funcion = function (ans_obj) {
      M.toast({ html: ans_obj['message'] });
      class_opt_recipe.prototype.array_opt_recipe['drug_list'] = (ans_obj['druglist']);
      class_opt_recipe.prototype.render_opt_drug(class_opt_recipe.prototype.generate_drug_list('drug_option_picklist','',0));
    }
    laravel_request(url, method, funcion, body);
  }
  drug_update(event) {
    event.preventDefault();
    var drug_slug = document.getElementById("txt_drug_generic").getAttribute("alt");
    var drug_generic = document.getElementById("txt_drug_generic").value;
    var drug_comertial = document.getElementById("txt_drug_comertial").value;
    var url = '/drug/' + drug_slug; var method = 'PUT';
    var body = JSON.stringify({ a: drug_generic, b: drug_comertial });
    var funcion = function (ans_obj) {
      M.toast({ html: ans_obj['message'] });
      class_opt_recipe.prototype.array_opt_recipe['drug_list'] = (ans_obj['druglist']);
      class_opt_recipe.prototype.render_opt_drug(class_opt_recipe.prototype.generate_drug_list('drug_option_picklist', '', 0));
    }
    laravel_request(url, method, funcion, body);
  }
  drug_create () {
    set_sidenav('/php/side_panel/inc_drug_create.php');
    setTimeout(function () {
      var elems = document.querySelectorAll('select');
      var instances = M.FormSelect.init(elems);
      document.getElementById("txt_sidepanel_drug_generic").focus();
      M.updateTextFields();
    }, 100)
  }
  drug_save (event) {
    event.preventDefault();
    requiredFields(['txt_sidepanel_drug_generic']);
    var valid = check_invalid(['txt_sidepanel_drug_generic']);
    if (!valid) { set_focus('txt_sidepanel_drug_generic'); return false; }

    var drug_generic = document.getElementById("txt_sidepanel_drug_generic").value;
    var drug_comertial = document.getElementById("txt_sidepanel_drug_comertial").value;
    var url = '/drug/'; var method = 'POST';
    var body = JSON.stringify({ a: drug_generic, b: drug_comertial });
    var funcion = function (ans_obj) {
      M.toast({ html: ans_obj['message'] });
      class_opt_recipe.prototype.array_opt_recipe['drug_list'] = (ans_obj['druglist']);
      class_opt_recipe.prototype.render_opt_drug(class_opt_recipe.prototype.generate_drug_list('drug_option_picklist', '', 0));
      $('.sidenav').sidenav('close');
    }
    laravel_request(url, method, funcion, body);
  }
}
class class_opt_order 
{
  constructor (raw_orderlist){
    this.array_opt_order['orderlist'] = raw_orderlist;
  }
  render_opt_order(raw_orderlist) {
    var raw_laboratory = {};  var raw_complementary = []; var raw_profile = [];
    for (const key in raw_orderlist) {
      switch (raw_orderlist[key]['type']) {
        case 'laboratory':
          raw_laboratory[key] = {};
          raw_laboratory[key]['id'] = raw_orderlist[key]['id'];
          raw_laboratory[key]['value'] = raw_orderlist[key]['value'];
          break;
        case 'profile':
          raw_profile[key] = {};
          raw_profile[key]['id'] = raw_orderlist[key]['id'];
          raw_profile[key]['value'] = raw_orderlist[key]['value'];
          break;
        case 'complementary':
          raw_complementary[key] = {};
          raw_complementary[key]['id'] = raw_orderlist[key]['id'];
          raw_complementary[key]['value'] = raw_orderlist[key]['value'];
          break;
      }
    }
    var laboratory_table = this.generate_laboratorylist(raw_laboratory);    
    var profile_table = this.generate_profilelist(raw_profile);
    var complementary_table = this.generate_complementarylist(raw_complementary);
    var content = `
    <div class="row">
      <div class="col s12 my_10 center-align">
        <a data-target="side_nav" class="sidenav-trigger waves-effect waves-light blue darken-1 btn btn-large" onclick="cls_order.order_create(event);"><i class="fas fa-folder-plus left"></i>Nueva Orden</a>
      </div>
      <div id="tbl_laboratorylist" class="col s12 m6 l6">
        <div class="col s12 header_list h_30 teal lighten-2">
          LABORATORIOS
        </div>
        <div class="col s12 list h_400">
          ${laboratory_table}
        </div>
      </div>
      <div id="tbl_profilelist" class="col s12 m6 l6">
        <div class="col s12 header_list h_30 teal lighten-2">
          PERFILES
        </div>
        <div class="col s12 list h_400">
          ${profile_table}
        </div>
      </div>
      <div id="tbl_complementarylist" class="col s12 m6 l6">
        <div class="col s12 header_list h_30 teal lighten-2">
          COMPLEMENTARIOS
        </div>
        <div class="col s12 list h_400">
          ${complementary_table}
        </div>
      </div>
    </div>
    `;
    document.getElementById('container_render').innerHTML = content;
  }
  generate_laboratorylist(raw_laboratorylist) {
    var tbl_laboratorylist = '';
    for (const x in raw_laboratorylist) {
      tbl_laboratorylist += `<div id="${raw_laboratorylist[x]['id']}" class="item compact" title="${raw_laboratorylist[x]['value']}">${raw_laboratorylist[x]['value']}</div>`;
    }
    return tbl_laboratorylist;
  }
  generate_profilelist(raw_profilelist) {
    var tbl_profilelist = '';
    for (const x in raw_profilelist) {
      tbl_profilelist += `<div id="${raw_profilelist[x]['id']}" class="item compact" title="${raw_profilelist[x]['value']}">${raw_profilelist[x]['value']}</div>`;
    }
    return tbl_profilelist;
  }
  generate_complementarylist(raw_complementarylist) {
    var tbl_complementarylist = '';
    for (const x in raw_complementarylist) {
      tbl_complementarylist += `<div id="${raw_complementarylist[x]['id']}" class="item compact" title="${raw_complementarylist[x]['value']}">${raw_complementarylist[x]['value']}</div>`;
    }
    return tbl_complementarylist;
  }
}
class class_medic {                 /* ######################     CLASS MEDIC   ######################## */
  save(){
    var button = document.getElementById('btn_save_medic');
    cls_general.disable_submit(button);



    const array_form = [
      document.getElementById('medic_pseudonym'),             //0
      document.getElementById('medic_gender'),                //1
      document.getElementById('medic_email'),                 //2
      document.getElementById('medic_speciality'),            //3
      document.getElementById('medic_ubication'),             //4
      document.getElementById('medic_telephone'),             //5

      document.getElementById('medic_halfpage_line1'),        //6
      document.getElementById('medic_halfpage_line2'),        //7
      document.getElementById('medic_halfpage_line3'),        //8
      document.getElementById('medic_halfpage_bottomline1'),  //9
      document.getElementById('medic_halfpage_bottomline2'),  //10

      document.getElementById('medic_page_line1'),            //11
      document.getElementById('medic_page_line2'),            //12
      document.getElementById('medic_page_line3'),            //13
      document.getElementById('medic_page_line4'),            //14
      document.getElementById('medic_page_bottomline1'),      //15
      document.getElementById('medic_page_bottomline2'),      //16
      document.getElementById('medic_password_1'),            //17
      document.getElementById('medic_password_2'),            //18
    ];
    var valid = cls_general.validate_empty(array_form);
    if (!valid) { M.toast({ html: 'Debe llenar los Campos.' }); return false; }

    if (array_form[17].value != array_form[18].value) {
      cls_general.set_invalid([array_form[17], array_form[18]]);
      cls_general.shot_toast('Contraseña no coinciden');
      return false;
    }
    if (cls_general.isEmail(array_form[2].value) == false) {
      cls_general.shot_toast('Verificar E-mail');
      return false;
    }


    var url = '../medic';
    var method = 'POST';
    var body = JSON.stringify({ 
      a: array_form[0].value, b: array_form[1].value, c: array_form[2].value, d: array_form[3].value, e: array_form[4].value, f: array_form[5].value, 
      g: array_form[6].value, h: array_form[7].value, i: array_form[8].value, j: array_form[9].value, k: array_form[10].value, 
      l: array_form[11].value, m: array_form[12].value, n: array_form[13].value, o: array_form[14].value, p: array_form[15].value, 
      q: array_form[16].value, r: array_form[17].value, s: array_form[18].value
    });
    var funcion = function (data_obj) {
      if(data_obj['status'] === 'success'){
        cls_configuration.clear_medic_form(array_form);
      }
      M.toast({ html: data_obj['message'] });
    }
    cls_general.async_laravel_request(url, method, funcion, body)
  }
}
class_opt_recipe.prototype.array_opt_recipe = new Object;
class_opt_order.prototype.array_opt_order = new Object;
