function filter_list (target,str) {
  switch (target) {
    case 'reason':
      cls_reason.filter_reason(str);
    break;
    case 'currentillness':
      cls_current.filter_current(str);
    break;
    case 'antecedent':
      cls_antecedent.filter_list(str);
    break;
    case 'examination':
      cls_examination.filter_list(str);
    break;
    case 'diagnostic':
      cls_diagnostic.filter_list(str);
    break;
    case 'plan':
      cls_plan.filter_list(str);
    break;
  }
}
function pick_list (target,id,content) {
  switch (target) {
    case 'reason':
      cls_reason.pick_reason(id,content);
    break;
    case 'current':
      cls_current.pick_current(id,content);
    break;
    case 'antecedent':
      cls_antecedent.pick_list(id,content);
    break;
    case 'examination':
      cls_examination.pick_list(id,content);
    break;
    case 'diagnostic':
      cls_diagnostic.pick_list(id,content);
    break;
    case 'plan':
      cls_plan.pick_list(id,content);
    break;
  }
}
class class_reason {
  constructor(json_selected)
  {    
    this.reason_selected = [];
    var array_selected = JSON.parse(json_selected);
    for (const a in array_selected) {
      this.reason_selected.push(array_selected[a]);
    }
  }
  filter_reason (str) {
    console.log(this.reason_selected);

    var haystack = raw_reasonlist;
    var needles = str.split(' ');
    var raw_filtered = new Object;
    for (var i in haystack) {
      var ocurrencys = 0;
      for (const a in needles) {
        if (haystack[i].toLowerCase().indexOf(needles[a].toLowerCase()) > -1) { ocurrencys++ }
      }
      if (ocurrencys === needles.length) {
        raw_filtered[i] = haystack[i];
      }
    }
    this.render_list ('reason_list', this.reorder_list(raw_filtered));
  }
  render_list (target, obj) {
    var body_list = '';
    for (var a in obj) {  body_list += `<div id="${a}" class="item compact truncate" onclick="pick_list('reason',this.id,this.innerHTML)">${obj[a]}</div>`;  }
    document.getElementById(target).innerHTML = body_list;
  }
  reorder_list (obj) {
    var raw_ordered = []; var raw_returned = new Object;
    for (var a in obj) {  raw_ordered.push(obj[a]+'*-*'+a); }
    raw_ordered.sort();
    for (var i = 0; i < raw_ordered.length; i++) {
     var splited = raw_ordered[i].split("*-*");
     raw_returned["'"+splited[1]+"'"] = splited[0];
    }
    return raw_returned
  }
  pick_reason (id,content) {
    if (this.reason_selected.indexOf(id) < 0) {
      var new_value = '';
      new_value += ((document.getElementById('txt_history_reason').value).length < 1) ? content : `, ${content}`;
      document.getElementById('txt_history_reason').value += new_value;
      this.reason_selected.push(id);
      class_reason.prototype.reason_selected = this.reason_selected;
    }else{
      M.toast({html: '¡Ya Existe!'});
    }
  }
}

class class_current {
  filter_current (str) {
    var haystack = raw_currentlist;
    var needles = str.split(' ');
    var raw_filtered = new Object;
    for (var i in haystack) {
      var ocurrencys = 0;
      for (const a in needles) {
        if (haystack[i].toLowerCase().indexOf(needles[a].toLowerCase()) > -1) { ocurrencys++ }
      }
      if (ocurrencys === needles.length) {
        raw_filtered[i] = haystack[i];
      }
    }
    this.render_list('current_list', this.reorder_list(raw_filtered));
  }
  render_list (target, obj) {
    var body_list = '';
    for (var a in obj) { body_list += `<div id="${obj[a]}" title="${obj[a]}" class="item compact truncate" onclick="pick_list('current',this.id,this.innerHTML)">${a}</div>`;  }
    document.getElementById(target).innerHTML = body_list;
  }
  reorder_list (obj) {
    var raw_ordered = []; var raw_returned = new Object;
    for (var a in obj) {  raw_ordered.push(obj[a]+'*-*'+a); }
    raw_ordered.sort();
    for (var i = 0; i < raw_ordered.length; i++) {
     var splited = raw_ordered[i].split("*-*");
     raw_returned[""+splited[1]+""] = splited[0];
    }
    return raw_returned
  }
  pick_current (content,title) {
    var new_value = content;
    document.getElementById('txt_history_currentillness').value = new_value;
  }
}

class class_antecedent {
  constructor(json_selected){
    this.antecedent_selected = [];
    var array_selected = JSON.parse(json_selected);
    for (const a in array_selected) {
      this.antecedent_selected.push(array_selected[a]);
    }    
  }
  filter_list (str) {
    var haystack = raw_antecedentlist;
    var needles = str.split(' ');
    var raw_filtered = new Object;
    for (var i in haystack) {
      var ocurrencys = 0;
      for (const a in needles) {
        if (haystack[i].toLowerCase().indexOf(needles[a].toLowerCase()) > -1) { ocurrencys++ }
      }
      if (ocurrencys === needles.length) {
        raw_filtered[i] = haystack[i];
      }
    }
    this.render_list ('antecedent_list', this.reorder_list(raw_filtered));
  }
  render_list (target, obj) {
    var body_list = '';
    for (var a in obj) {  body_list += `<div id="${a}" class="item compact truncate" onclick="pick_list('antecedent',this.id,this.innerHTML)">${obj[a]}</div>`;  }
    document.getElementById(target).innerHTML = body_list;
  }
  reorder_list (obj) {
    var raw_ordered = []; var raw_returned = new Object;
    for (var a in obj) {  raw_ordered.push(obj[a]+'*-*'+a); }
    raw_ordered.sort();
    for (var i = 0; i < raw_ordered.length; i++) {
     var splited = raw_ordered[i].split("*-*");
     raw_returned[""+splited[1]+""] = splited[0];
    }
    return raw_returned
  }
  pick_list (id,content) {
    if (this.antecedent_selected.indexOf(id) < 0) {
      var new_value = '';
      new_value += ((document.getElementById('txt_history_antecedent').value).length < 1) ? content : `, ${content}`;
      document.getElementById('txt_history_antecedent').value += new_value;
      this.antecedent_selected.push(id);
      class_antecedent.prototype.antecedent_selected = this.antecedent_selected;
    }else{
      M.toast({html: '¡Ya Existe!'});
    }
  }
}

class class_examination {
  filter_list (str) {
    var haystack = raw_examinationlist;
    var needles = str.split(' ');
    var raw_filtered = new Object;
    for (var i in haystack) {
      var ocurrencys = 0;
      for (const a in needles) {
        if (haystack[i].toLowerCase().indexOf(needles[a].toLowerCase()) > -1) { ocurrencys++ }
      }
      if (ocurrencys === needles.length) {
        raw_filtered[i] = haystack[i];
      }
    }
    this.render_list ('examination_list', this.reorder_list(raw_filtered));
  }
  render_list (target, obj) {
    var body_list = '';
    for (var a in obj) {  body_list += `<div id="${a}" class="item compact truncate" onclick="pick_list('examination',this.id,this.innerHTML)">${obj[a]}</div>`;  }
    document.getElementById(target).innerHTML = body_list;
  }
  reorder_list (obj) {
    var raw_ordered = []; var raw_returned = new Object;
    for (var a in obj) {  raw_ordered.push(obj[a]+'*-*'+a); }
    raw_ordered.sort();
    for (var i = 0; i < raw_ordered.length; i++) {
     var splited = raw_ordered[i].split("*-*");
     raw_returned[""+splited[1]+""] = splited[0];
    }
    return raw_returned
  }
  pick_list (id,content) {
    var new_value = content;
    document.getElementById('txt_history_examination').value = new_value;
  }
  set_state_vital (field,content) {
    if (content != '') {
      document.getElementById("txt_ef_"+field).value = cls_general.val_dec(content,1,0,1);
      document.getElementById("txt_pe_"+field).value = cls_general.val_dec(content,1,0,1);
    }else{
      document.getElementById("txt_ef_"+field).value = content;
      document.getElementById("txt_pe_"+field).value = content;
    }
    M.updateTextFields();
  }
  blur_examination_textarea(field, name){
    console.log('run');
    var text = field.value;
    var splited = text.split(',');
    var unsorted_splited=[];
    for (const a in splited) {
      unsorted_splited.push((splited[a].trim()).toLowerCase())
    }
    for (let i = 0; i < splited.length; i++) {
      var indices = [];
      var idx = unsorted_splited.indexOf(unsorted_splited[i].trim());
      while (idx != -1) {
        indices.push(idx);
        idx = unsorted_splited.indexOf(unsorted_splited[i], idx + 1);
      }
      if (indices.length > 1) {
        M.toast({html: 'Verifique el campo '+name+', hay elementos repetidos.'});
        return false;
      }
    }
  }
  ef_filter_list (target,str) {
    var haystack = raw_eflist[target];
    var needles = str.split(' ');
    var raw_filtered = new Object;
    for (var i in haystack) {
      var ocurrencys = 0;
      for (const a in needles) {
        if (haystack[i]['tx_' + target + '_value'].toLowerCase().indexOf(needles[a].toLowerCase()) > -1) { ocurrencys++ }
      }
      if (ocurrencys === needles.length) {
        raw_filtered[i] = haystack[i]['tx_' + target + '_value'];
      }
    }
    ef_render_list (target, ef_reorder_list(raw_filtered));
  }
  

}
class class_diagnostic {
  constructor(json_selected){
    var raw_selected = JSON.parse(json_selected);
    this.diagnostic_selected = [];
    for (const a in raw_selected) {
      this.diagnostic_selected.push(raw_selected[a]);
    }
  }
  filter_list (str) {
    var haystack = raw_diagnosticlist;
    var needles = str.split(' ');
    var raw_filtered = new Object;
    for (var i in haystack) {
      var ocurrencys = 0;
      for (const a in needles) {
        if (haystack[i].toLowerCase().indexOf(needles[a].toLowerCase()) > -1) { ocurrencys++ }
      }
      if (ocurrencys === needles.length) {
        raw_filtered[i] = haystack[i];
      }
    }
    this.render_list ('diagnostic_list', this.reorder_list(raw_filtered));
  }
  render_list (target, obj) {
    var body_list = '';
    for (var a in obj) {  body_list += `<div id="${a}" class="item compact truncate" onclick="pick_list('diagnostic',this.id,this.innerHTML)">${obj[a]}</div>`;  }
    document.getElementById(target).innerHTML = body_list;
  }
  reorder_list (obj) {
    var raw_ordered = []; var raw_returned = new Object;
    for (var a in obj) {  raw_ordered.push(obj[a]+'*-*'+a); }
    raw_ordered.sort();
    for (var i = 0; i < raw_ordered.length; i++) {
     var splited = raw_ordered[i].split("*-*");
     raw_returned[""+splited[1]+""] = splited[0];
    }
    return raw_returned
  }
  pick_list (id,content) {
    if (this.diagnostic_selected.indexOf(id) < 0) {
      var new_value = '';
      new_value += ((document.getElementById('txt_history_diagnostic').value).length < 1) ? content : `, ${content}`;
      document.getElementById('txt_history_diagnostic').value += new_value;
      this.diagnostic_selected.push(id);      
      class_diagnostic.prototype.diagnostic_selected = this.diagnostic_selected;
    }else{
      M.toast({html: '¡Ya Existe!'});
    }
  }
}
class class_plan {
  filter_list (str,target='plan_list') {
    var haystack = raw_planlist;
    var needles = str.split(' ');
    var raw_filtered = new Object;
    for (var i in haystack) {
      var ocurrencys = 0;
      for (const a in needles) {
        if (haystack[i].toLowerCase().indexOf(needles[a].toLowerCase()) > -1) { ocurrencys++ }
      }
      if (ocurrencys === needles.length) {
        raw_filtered[i] = haystack[i];
      }
    }
    this.render_list(target, this.reorder_list(raw_filtered));
  }
  render_list (target, obj) {
    var body_list = '';
    for (var a in obj) {  body_list += `<div id="${obj[a]}" class="item compact truncate" onclick="pick_list('plan',this.id,this.innerHTML)">${a}</div>`;  }
    document.getElementById(target).innerHTML = body_list;
  }
  reorder_list (obj) {
    var raw_ordered = []; var raw_returned = new Object;
    for (var a in obj) {  raw_ordered.push(obj[a]+'*-*'+a); }
    raw_ordered.sort();
    for (var i = 0; i < raw_ordered.length; i++) {
     var splited = raw_ordered[i].split("*-*");
     raw_returned[""+splited[1]+""] = splited[0];
    }
    return raw_returned
  }
  pick_list(id, content, target ='txt_history_plan') {
    var old_value = document.getElementById(target).value;
    var expresion = new RegExp(content);
    if (!expresion.test(old_value)) {
      var new_value = '';
      new_value += ((document.getElementById(target).value).length < 1) ? content : `\n${content}`;
      document.getElementById(target).value += new_value;
    }else{
      M.toast({html: '¡Ya Existe!'});
    }
  }
}


// ######################    function to ef
function ef_render_list (target, obj) {
  var body_list = '';
  for (var a in obj) {  body_list += `<div class="item compact truncate" title="${obj[a]}" onclick="ef_pick_list('${target}',this.innerHTML)">${obj[a]}</div>`;  }
  document.getElementById('ef_'+target+'_list').innerHTML = body_list;
}
function ef_reorder_list (obj) {
  var raw_ordered = []; var raw_returned = new Object;
  for (var a in obj) {  raw_ordered.push(obj[a]+'*-*'+a); }
  raw_ordered.sort();
  for (var i = 0; i < raw_ordered.length; i++) {
   var splited = raw_ordered[i].split("*-*");
   raw_returned[""+splited[1]+""] = splited[0];
  }
  return raw_returned
}
function ef_pick_list (target,content) {
  content = content.toLowerCase();
  var old_value = (document.getElementById('txt_ef_'+target).value).toLowerCase();
  var expresion = new RegExp(content);
  if (!expresion.test(old_value)) {
    var new_value = '';
    new_value += ((document.getElementById('txt_ef_'+target).value).length < 1) ? cls_general.uc_first(content) : `, ${content}`;
    document.getElementById('txt_ef_'+target).value += new_value;
  }else{
    M.toast({html: '¡Ya Existe!'});
  }
}

// #################      PASTE PHISICAL EXAM       #################

class class_physical_exam
{
  constructor(skin, head, orl, neck, respiratory, cardiac, auscultation, inspection, palpation, hip, condition, breathing, hydration, fever, pupils){
    this.skin = skin;
    this.head = head;
    this.orl = orl;
    this.neck = neck;
    this.respiratory = respiratory;
    this.cardiac = cardiac;
    this.auscultation = auscultation;
    this.inspection = inspection;
    this.palpation = palpation;
    this.hip = hip;
    this.condition = condition;
    this.breathing = breathing;
    this.hydration = hydration;
    this.fever = fever;
    this.pupils = pupils;
  }
}
// #################      CLASE HISTORIA MEDICA       #################
class class_medical_history {
  constructor(date_id)
  {
    this.array_medical_history = new Object;
    this.array_medical_history[date_id] = new Object();
    this.array_medical_history[date_id]['physical_exam'] = new Object();
    this.array_medical_history[date_id]['history'] = new Object();
    this.array_medical_history[date_id]['laboratory'] = new Object();
  }
  make_json_pe () {
    var condition = document.getElementById('sel_ef_condition').value;
    var breathing = document.getElementById('sel_ef_breathing').value;
    var hydration = document.getElementById('sel_ef_hydration').value;
    var fever = document.getElementById('sel_ef_fever').value;
    var pupils = document.getElementById('sel_ef_pupils').value;

    var skin = (document.getElementById('txt_ef_skin').value).toLowerCase();
    var head = (document.getElementById('txt_ef_head').value).toLowerCase();
    var orl = (document.getElementById('txt_ef_orl').value).toLowerCase();
    var neck = (document.getElementById('txt_ef_neck').value).toLowerCase();
    var respiratory = (document.getElementById('txt_ef_respiratory').value).toLowerCase();
    var cardiac = (document.getElementById('txt_ef_cardiac').value).toLowerCase();
    var auscultation = (document.getElementById('txt_ef_auscultation').value).toLowerCase();
    var inspection = (document.getElementById('txt_ef_inspection').value).toLowerCase();
    var palpation = (document.getElementById('txt_ef_palpation').value).toLowerCase();
    var hip = (document.getElementById('txt_ef_hip').value).toLowerCase();
    const obj_physical_exam = new class_physical_exam(skin, head, orl, neck, respiratory, cardiac, auscultation, inspection, palpation, hip, condition, breathing, hydration, fever, pupils);
    return obj_physical_exam;
  }
  make_json_history () {    
    requiredFields (['txt_ef_fc','txt_ef_fr']);
    var valid = check_invalid(['txt_ef_fc','txt_ef_fr']);
    if (!valid || document.getElementById('txt_ef_fc').value < 0.01 || document.getElementById('txt_ef_fr').value < 0.01) { 
      $('html, body').animate({ scrollTop: $("li.tab").offset().top }, 500);
      // document.getElementById("li_laboratory").classList.remove('active');
      // document.getElementById("li_history").classList.add('active');
      M.toast({html: '¡Faltan Campos!'});
      return false;
    }
    const reason = Object.create(class_reason.prototype);
    const antecedent = Object.create(class_antecedent.prototype);
    const diagnostic = Object.create(class_diagnostic.prototype);
    var obj_history = {}; 
    obj_history['reason'] = {};
    obj_history['reason']['selected'] = (reason.reason_selected) ? reason.reason_selected : [];
    obj_history['reason']['content'] = document.getElementById("txt_history_reason").value;
    obj_history['current'] = {};
    obj_history['current']['content'] = document.getElementById("txt_history_currentillness").value;
    obj_history['antecedent'] = {};
    obj_history['antecedent']['selected'] = (antecedent.antecedent_selected) ? antecedent.antecedent_selected : [];
    obj_history['antecedent']['content'] = document.getElementById("txt_history_antecedent").value;
    obj_history['examination'] = {};
    obj_history['examination']['content'] = document.getElementById("txt_history_examination").value;
    obj_history['diagnostic'] = {};
    obj_history['diagnostic']['selected'] = (diagnostic.diagnostic_selected) ? diagnostic.diagnostic_selected : [];
    obj_history['diagnostic']['content'] = document.getElementById("txt_history_diagnostic").value;
    obj_history['comment'] = {};
    obj_history['comment']['content'] = document.getElementById("txt_history_comment").value;
    obj_history['plan'] = {};
    obj_history['plan']['content'] = document.getElementById("txt_history_plan").value;
    obj_history['vital_sign'] = {};
    obj_history['vital_sign']['fc'] = document.getElementById("txt_ef_fc").value;
    obj_history['vital_sign']['fr'] = document.getElementById("txt_ef_fr").value;
    obj_history['vital_sign']['tas'] = document.getElementById("txt_ef_tas").value;
    obj_history['vital_sign']['tad'] = document.getElementById("txt_ef_tad").value;
    obj_history['vital_sign']['temp'] = document.getElementById("txt_ef_temp").value;
    obj_history['vital_sign']['gc'] = document.getElementById("txt_ef_gc").value;
    return obj_history;
  }
  paste_pe () {
    const physical_exam = this.make_json_pe();
    requiredFields (['txt_ef_fc','txt_ef_fr']);
    var valid = check_invalid(['txt_ef_fc','txt_ef_fr']);
    if (!valid) { return false; }
    if (document.getElementById('txt_ef_fc').value < 0.01 || document.getElementById('txt_ef_fr').value < 0.01) {
      $('html, body').animate({ scrollTop: $("li.tab").offset().top }, 500);
      M.toast({html: '¡Faltan Campos!'});
      return false;
    }
    var fc = document.getElementById('txt_ef_fc').value;
    var fr = document.getElementById('txt_ef_fr').value;
    var tas = (document.getElementById('txt_ef_tas').value != '') ? 'TAS: '+document.getElementById('txt_ef_tas').value+',' : '';
    var tad = (document.getElementById('txt_ef_tad').value != '') ? 'TAD: '+document.getElementById('txt_ef_tad').value+',' : '';
    var temp = (document.getElementById('txt_ef_temp').value != '') ? 'Temp: '+document.getElementById('txt_ef_temp').value+'º,' : '';
    var gc = (document.getElementById('txt_ef_gc').value != '') ? 'GC: '+document.getElementById('txt_ef_gc').value+'.' : '';
    var ef_skin = (physical_exam['skin'] != '') ? 'Piel: '+physical_exam['skin']+';' : '';
    var ef_head = (physical_exam['head'] != '') ? 'Cabeza: '+physical_exam['head']+';' : '';
    var ef_orl = (physical_exam['orl'] != '') ? 'Orl: '+physical_exam['orl']+';' : '';
    var ef_neck = (physical_exam['neck'] != '') ? 'Cuello: '+physical_exam['neck']+';' : '';
    var ef_respiratory = (physical_exam['respiratory'] != '') ? physical_exam['respiratory'] : '';
    var ef_cardiac = (physical_exam['cardiac'] != '') ? physical_exam['cardiac'] : '';
    var torax = ef_respiratory;
    if (torax != '') {
      torax += (ef_cardiac != '') ? ', '+ef_cardiac : '';
    }else{
      torax += (ef_cardiac != '') ? ef_cardiac : '';
    }
    var ef_torax = (torax != '') ? 'Torax: '+torax+';' : '';
    var ef_auscultation = (physical_exam['auscultation'] != '') ? physical_exam['auscultation'] : '';
    var ef_inspection = (physical_exam['inspection'] != '') ? physical_exam['inspection'] : '';
    var ef_palpation = (physical_exam['palpation'] != '') ? physical_exam['palpation'] : '';
    var abdomen = (ef_auscultation != '') ? ef_auscultation : '';
    if (abdomen != '') {
      abdomen += (ef_inspection != '') ? ', '+ef_inspection : '';
    }else{
      abdomen += (ef_inspection != '') ? ef_inspection : '';
    }
    if (abdomen != '') {
      abdomen += (ef_palpation != '') ? ', '+ef_palpation : '';
    }else{
      abdomen += (ef_palpation != '') ? ef_palpation : '';
    }
    var ef_abdomen = (abdomen != '') ? 'Abdomen: '+abdomen+';' : '';
    var ef_hip = (physical_exam['hip'] != '') ? 'Pelvis: '+physical_exam['hip']+'.' : '';

    var condition = document.getElementById("sel_ef_condition").options[document.getElementById("sel_ef_condition").selectedIndex].text;
    var breathing = document.getElementById("sel_ef_breathing").options[document.getElementById("sel_ef_breathing").selectedIndex].text;
    var hydration = document.getElementById("sel_ef_hydration").options[document.getElementById("sel_ef_hydration").selectedIndex].text;
    var fever = document.getElementById("sel_ef_fever").options[document.getElementById("sel_ef_fever").selectedIndex].text;
    var pupils = document.getElementById("sel_ef_pupils").options[document.getElementById("sel_ef_pupils").selectedIndex].text;

    var content_examination = '';
    content_examination += `FC: ${fc} FR: ${fr} ${tas} ${tad} ${temp} ${gc}
${condition}, ${breathing}, ${hydration}, ${fever}, ${pupils} ${ef_skin} ${ef_head} ${ef_orl} ${ef_neck} ${ef_torax} ${ef_abdomen} ${ef_hip}`;
    var regexp = / +/g;
    document.getElementById('txt_history_examination').value = content_examination.replace(regexp," ");
  }
  save_history(date_id, obj_physical_exam, obj_history, obj_laboratory) {
    this.array_medical_history[date_id]['physical_exam'] = obj_physical_exam;
    this.array_medical_history[date_id]['history'] = obj_history;
    this.array_medical_history[date_id]['laboratory'] = obj_laboratory;
    // console.log(this.array_medical_history);
    var url = '/history'; var method = 'POST';
    var body = JSON.stringify({ a: this.array_medical_history });
    var funcion = function (history_obj) {
      M.toast({ html: history_obj['message'], classes: 'blue' });
      content = '';
      for (const key in history_obj['answer']['laboratory']) {
        const obj_lab = history_obj['answer']['laboratory'][key];
        var alarm = (obj_lab['alarm'] === 1) ? 'Resultados Anormales' : 'Resultados Normales';
        var background = (obj_lab['alarm'] === 1) ? 'red accent-2' : 'teal lighten-3';
        content += `
        <div class="col s3">
          <div class="card  ${background} ">
            <div class="card-image card_laboratory waves-effect waves-block waves-light activator">
              <div class="activator right-align">
                <h3 class="activator">${obj_lab['date']}</h3>
              </div>
              <div class="activator">
                <span class="font_bolder">
                  Alarma:
                </span>
                <h5 class="activator sanson_title">${alarm} </h5>
              </div>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4 bolder"><?php echo date('d-m-Y',strtotime($obj_lab['date'])); ?><i class="material-icons right">close</i></span>
              <p>
              ${obj_lab['content']}
              </p>
            </div>
          </div>
        </div>
        `;
      }
      document.getElementById("card_container").innerHTML = content;     
    }
    laravel_request(url, method, funcion, body);

  }
    // FIN DE CLASE HISTORIA
}

class class_order 
{
  new_order (field,target) {
    var laboratory = document.getElementById(field).value;
    document.getElementById(target).value = uc_first(laboratory);
    M.updateTextFields();
  }
  // generate_order_list(raw_order) {
  //   var order_content = '';
  //   for (const x in raw_order) {
  //     order_content += `<div id="${x}" class="item compact" onclick="cls_order.pick_laboratory_list(this.innerHTML)">${raw_order[x]}</div>`;
  //   }
  //   return order_content;
  // }
  search_order(str,type) {
    switch (type) {
      case 'laboratory':
        var haystack = raw_laboratorylist;  break;
      case 'complementary':
        var haystack = raw_complementarylist; break;
      case 'profile':
        var haystack = raw_profilelist; break;
    }
    var needles = str.split(' ');
    var raw_filtered = new Object;
    for (var i in haystack) {
      var ocurrencys = 0;
      for (const a in needles) {
        if (haystack[i].toLowerCase().indexOf(needles[a].toLowerCase()) > -1) { ocurrencys++ }
      }
      if (ocurrencys === needles.length) { 
        raw_filtered[i] = haystack[i];
      }
    }
    return this.reorder_list(raw_filtered)
  }
  reorder_list (obj) {    
    var raw_ordered = []; var raw_returned = new Object;
    for (var a in obj) {  raw_ordered.push(obj[a]+'*-*'+a); }
    raw_ordered.sort();
    for (var i = 0; i < raw_ordered.length; i++) {
     var splited = raw_ordered[i].split("*-*");
     raw_returned["'"+splited[1]+"'"] = splited[0];
    }    
    return raw_returned
  }
  history_save_order(e,field,type,target) {
    e.preventDefault();
    var txt_order = document.getElementById(field).value;
    var url = '/order'; var method = 'POST';
    var body = JSON.stringify({ a: txt_order, b: type });
    // const cls_order = this;
    var funcion = function (order_obj) {
      M.toast({ html: order_obj['message'] });
      switch (type) {
        case 'laboratory': raw_laboratorylist = order_obj['order_list'];  break;
        case 'complementary': raw_complementarylist = order_obj['order_list']; break;
      }
      switch (target) {
        case 'laboratory_list':
          var order_content = cls_laboratory.generate_order_list(order_obj['order_list']);
          break;
        case 'medicalorder_laboratory_list':
          var order_content = cls_document.generate_laboratory_list(order_obj['order_list']);
          break;
        case 'medicalorder_complementary_list':
          var order_content = cls_document.generate_complementary_list(order_obj['order_list']);
          break;
      }
      document.getElementById(target).innerHTML = order_content;

    }
    laravel_request(url, method, funcion, body);
  }

  // filter_laboratory(str) {
  //   var ordered_list = this.search_order(str, 'laboratory');
  //   var order_content = this.generate_order_list(ordered_list);
  //   document.getElementById("laboratory_list").innerHTML = order_content;
  // }
  // pick_laboratory_list (content) {
  //   content = content.toLowerCase();
  //   var old_value = (document.getElementById('txt_laboratory_result').value).toLowerCase();
  //   var expresion = new RegExp(content);
  //   if (!expresion.test(old_value)) {
  //     var new_value = '';
  //     new_value += ((document.getElementById('txt_laboratory_result').value).length < 1) ? `${uc_first(content)}: ` : `\n${content}: `;
  //     document.getElementById('txt_laboratory_result').value += new_value;
  //     document.getElementById('txt_laboratory_result').focus();
  //   }else{
  //     M.toast({html: '¡Ya Existe!'});
  //   }
  // }
  // make_json_laboratory () {
  //   var raw_laboratory = {};
  //   var hemoglobin_result = document.getElementById('txt_laboratory_hemoblobin').value;
  //   var hemoglobin_alert = document.getElementById('cb_hemoglobin').checked;
  //   raw_laboratory['hemoglobin'] = [hemoglobin_result,hemoglobin_alert];

  //   var hematocrit_result = document.getElementById('txt_laboratory_hematocrit').value;
  //   var hematocrit_alert = document.getElementById('cb_hematocrit').checked;
  //   raw_laboratory['hematocrit'] = [hematocrit_result, hematocrit_alert];
    
  //   var platelet_result = document.getElementById('txt_laboratory_platelet').value;
  //   var platelet_alert = document.getElementById('cb_platelet').checked;
  //   raw_laboratory['platelet'] = [platelet_result, platelet_alert];

  //   var redbloodcell_result = document.getElementById('txt_laboratory_redbloodcell').value;
  //   var redbloodcell_alert = document.getElementById('cb_redbloodcell').checked;
  //   raw_laboratory['redbloodcell'] = [redbloodcell_result, redbloodcell_alert];

  //   var urea_result = document.getElementById('txt_laboratory_urea').value;
  //   var urea_alert = document.getElementById('cb_urea').checked;
  //   raw_laboratory['urea'] = [urea_result, urea_alert];

  //   var creatinine_result = document.getElementById('txt_laboratory_creatinine').value;
  //   var creatinine_alert = document.getElementById('cb_creatinine').checked;
  //   raw_laboratory['creatinine'] = [creatinine_result, creatinine_alert];

  //   var whitebloodcell_result = document.getElementById('txt_laboratory_whitebloodcell').value;
  //   var whitebloodcell_alert = document.getElementById('cb_whitebloodcell').checked;
  //   raw_laboratory['whitebloodcell'] = [whitebloodcell_result, whitebloodcell_alert];

  //   var lymphocytes_result = document.getElementById('txt_laboratory_lymphocytes').value;
  //   var lymphocytes_alert = document.getElementById('cb_lymphocytes').checked;
  //   raw_laboratory['lymphocytes'] = [lymphocytes_result, lymphocytes_alert];

  //   var neutrophils_result = document.getElementById('txt_laboratory_neutrophils').value;
  //   var neutrophils_alert = document.getElementById('cb_neutrophils').checked;
  //   raw_laboratory['neutrophils'] = [neutrophils_result, neutrophils_alert];

  //   var monocytes_result = document.getElementById('txt_laboratory_monocytes').value;
  //   var monocytes_alert = document.getElementById('cb_monocytes').checked;
  //   raw_laboratory['monocytes'] = [monocytes_result, monocytes_alert];

  //   var basophils_result = document.getElementById('txt_laboratory_basophils').value;
  //   var basophils_alert = document.getElementById('cb_basophils').checked;
  //   raw_laboratory['basophils'] = [basophils_result, basophils_alert];

  //   var eosinophils_result = document.getElementById('txt_laboratory_eosinophils').value;
  //   var eosinophils_alert = document.getElementById('cb_eosinophils').checked;
  //   raw_laboratory['eosinophils'] = [eosinophils_result, eosinophils_alert];

  //   var result_result = document.getElementById('txt_laboratory_result').value;
  //   var result_alert = document.getElementById('cb_result').checked;
  //   raw_laboratory['result'] = [result_result, result_alert];
  //   return raw_laboratory;
  // }
  // FIN DE CLASE LABORATORIO
}
class class_laboratory {
  generate_order_list(raw_order) {
    var order_content = '';
    for (const x in raw_order) {
      order_content += `<div id="${x}" class="item compact" onclick="cls_laboratory.pick_laboratory_list(this.innerHTML)">${raw_order[x]}</div>`;
    }
    return order_content;
  }
  filter_laboratory(str) {
    var ordered_list = cls_order.search_order(str, 'laboratory');
    var order_content = this.generate_order_list(ordered_list);
    document.getElementById("laboratory_list").innerHTML = order_content;
  }
  pick_laboratory_list(content) {
    content = content.toLowerCase();
    var old_value = (document.getElementById('txt_laboratory_result').value).toLowerCase();
    var expresion = new RegExp(content);
    if (!expresion.test(old_value)) {
      var new_value = '';
      new_value += ((document.getElementById('txt_laboratory_result').value).length < 1) ? `${uc_first(content)}: ` : `\n${content}: `;
      document.getElementById('txt_laboratory_result').value += new_value;
      document.getElementById('txt_laboratory_result').focus();
    } else {
      M.toast({ html: '¡Ya Existe!' });
    }
  }
  make_json_laboratory() {
    var raw_laboratory = {};
    var hemoglobin_result = document.getElementById('txt_laboratory_hemoblobin').value;
    var hemoglobin_alert = document.getElementById('cb_hemoglobin').checked;
    raw_laboratory['hemoglobin'] = [hemoglobin_result, hemoglobin_alert];

    var hematocrit_result = document.getElementById('txt_laboratory_hematocrit').value;
    var hematocrit_alert = document.getElementById('cb_hematocrit').checked;
    raw_laboratory['hematocrit'] = [hematocrit_result, hematocrit_alert];

    var platelet_result = document.getElementById('txt_laboratory_platelet').value;
    var platelet_alert = document.getElementById('cb_platelet').checked;
    raw_laboratory['platelet'] = [platelet_result, platelet_alert];

    var redbloodcell_result = document.getElementById('txt_laboratory_redbloodcell').value;
    var redbloodcell_alert = document.getElementById('cb_redbloodcell').checked;
    raw_laboratory['redbloodcell'] = [redbloodcell_result, redbloodcell_alert];

    var urea_result = document.getElementById('txt_laboratory_urea').value;
    var urea_alert = document.getElementById('cb_urea').checked;
    raw_laboratory['urea'] = [urea_result, urea_alert];

    var creatinine_result = document.getElementById('txt_laboratory_creatinine').value;
    var creatinine_alert = document.getElementById('cb_creatinine').checked;
    raw_laboratory['creatinine'] = [creatinine_result, creatinine_alert];

    var whitebloodcell_result = document.getElementById('txt_laboratory_whitebloodcell').value;
    var whitebloodcell_alert = document.getElementById('cb_whitebloodcell').checked;
    raw_laboratory['whitebloodcell'] = [whitebloodcell_result, whitebloodcell_alert];

    var lymphocytes_result = document.getElementById('txt_laboratory_lymphocytes').value;
    var lymphocytes_alert = document.getElementById('cb_lymphocytes').checked;
    raw_laboratory['lymphocytes'] = [lymphocytes_result, lymphocytes_alert];

    var neutrophils_result = document.getElementById('txt_laboratory_neutrophils').value;
    var neutrophils_alert = document.getElementById('cb_neutrophils').checked;
    raw_laboratory['neutrophils'] = [neutrophils_result, neutrophils_alert];

    var monocytes_result = document.getElementById('txt_laboratory_monocytes').value;
    var monocytes_alert = document.getElementById('cb_monocytes').checked;
    raw_laboratory['monocytes'] = [monocytes_result, monocytes_alert];

    var basophils_result = document.getElementById('txt_laboratory_basophils').value;
    var basophils_alert = document.getElementById('cb_basophils').checked;
    raw_laboratory['basophils'] = [basophils_result, basophils_alert];

    var eosinophils_result = document.getElementById('txt_laboratory_eosinophils').value;
    var eosinophils_alert = document.getElementById('cb_eosinophils').checked;
    raw_laboratory['eosinophils'] = [eosinophils_result, eosinophils_alert];

    var result_result = document.getElementById('txt_laboratory_result').value;
    var result_alert = document.getElementById('cb_result').checked;
    raw_laboratory['result'] = [result_result, result_alert];
    return raw_laboratory;
  }
}

class class_document {
  constructor(date_id,json_drugselected) {
    this.array_document = new Object;
    this.array_document[date_id] = new Object();
    this.array_document[date_id]['medicalorder'] = new Object();
    this.array_document[date_id]['prescription'] = new Object();
    this.array_document[date_id]['incapacity'] = new Object();
    this.medicine_selected = (JSON.parse(json_drugselected) === null) ? [] : JSON.parse(json_drugselected);
  }
  filter_laboratory(str) {
    var ordered_list = cls_order.search_order(str, 'laboratory');
    var order_content = this.generate_laboratory_list(ordered_list);
    document.getElementById("medicalorder_laboratory_list").innerHTML = order_content;      
  }
  filter_profile(str) {
    var ordered_list = cls_order.search_order(str, 'profile');
    var order_content = this.generate_laboratory_list(ordered_list,"\\n");
    document.getElementById("medicalorder_profile_list").innerHTML = order_content;
  }
  generate_laboratory_list(raw_order,breakline='') {
    var order_content = '';
    for (const x in raw_order) {
      order_content += `<div id="${x}" class="item compact truncate" onclick="cls_document.laboratory_pick_list(this.innerHTML,'${breakline}')">${raw_order[x]}</div>`;
    }
    return order_content;
  }
  laboratory_pick_list(content, breakline) {
    content = content.toLowerCase();
    var old_value = (document.getElementById('txt_document_laboratory').value).toLowerCase();
    var expresion = new RegExp(content);
    if (!expresion.test(old_value)) {
      var new_value = '';
      var substring = old_value.substr(-1, 1);
      if ((document.getElementById('txt_document_laboratory').value).length < 1) {
        new_value = uc_first(content);
      } else {
        if (substring === '\n') {
          new_value = uc_first(content);
        } else {
          new_value = `, ${content}`;
        }
      }
      document.getElementById('txt_document_laboratory').value += new_value;
      document.getElementById('txt_document_laboratory').focus();
    } else {
      M.toast({ html: '¡Ya Existe!' });
    }
  }

  filter_complementary(str) {
    var ordered_list = cls_order.search_order(str, 'complementary');
    var order_content = this.generate_complementary_list(ordered_list);
    document.getElementById("medicalorder_complementary_list").innerHTML = order_content;
  }
  generate_complementary_list(raw_order, breakline = '') {
    var order_content = '';
    for (const x in raw_order) {
      order_content += `<div id="${x}" class="item compact" onclick="cls_document.complementary_pick_list(this.innerHTML,'${breakline}')">${raw_order[x]}</div>`;
    }
    return order_content;
  }
  complementary_pick_list(content) {
    content = content.toLowerCase();
    var old_value = (document.getElementById('txt_document_complementary').value).toLowerCase();
    var expresion = new RegExp(content);
    if (!expresion.test(old_value)) {
      var new_value = '';
      var substring = old_value.substr(-1, 1);
      if ((document.getElementById('txt_document_complementary').value).length < 1) {
        new_value = uc_first(content);
      }else{
        if (substring === '\n') {          
          new_value = uc_first(content);
        } else {
          new_value = `, ${content}`;
        }
      }
      document.getElementById('txt_document_complementary').value += new_value;
      document.getElementById('txt_document_complementary').focus();
    } else {
      M.toast({ html: '¡Ya Existe!' });
    }
  }
  // JSON PARA ORDENES MEDICAS
  make_json_medicalorder() {
    var raw_medicalorder = {};
    var laboratory_order = document.getElementById("txt_document_laboratory").value;
    var complementary_order = document.getElementById("txt_document_complementary").value;
    raw_medicalorder['laboratory'] = laboratory_order;
    raw_medicalorder['complementary'] = complementary_order;
    return raw_medicalorder; 
  }

  // FUNCIONES PARA PRESCRIPCION MEDICA
  filter_medicine (str) {
    var raw_drug = this.lookfor_medicine(str);  
    var content_list = this.generate_druglist(raw_drug);
    document.getElementById('recipe_medicine_list').innerHTML = content_list;
  }
  lookfor_medicine (str) {
    var haystack = raw_druglist;
    var needles = str.split(' ');
    var raw_filtered = new Object;
    for (var i in haystack) {
      var ocurrencys = 0;
      for (const a in needles) {
        if (haystack[i]['generic'].toLowerCase().indexOf(needles[a].toLowerCase()) > -1 || haystack[i]['comercial'].toLowerCase().indexOf(needles[a].toLowerCase()) > -1) { ocurrencys++ }
      }
      if (ocurrencys === needles.length) {
        raw_filtered[i] = haystack[i];
      }
    }    
    return this.reorder_druglist(raw_filtered)
  }
  reorder_druglist(obj) {
    var raw_ordered = []; var raw_returned = new Object;
    for (var a in obj) { raw_ordered.push(obj[a]['generic'] + '*-*' + a); }
    raw_ordered.sort();
    for (var i = 0; i < raw_ordered.length; i++) {
      var splited = raw_ordered[i].split("*-*");
      raw_returned[splited[1]] = new Object;
      raw_returned[splited[1]]['generic'] = splited[0];
      raw_returned[splited[1]]['comercial'] = obj[splited[1]]['comercial'];
    }  
    return raw_returned
  }
  generate_druglist(raw_drug) {
    var content_list = '';
    for (const x in raw_drug) {
      content_list += `<div id="${x}" class="sidenav-trigger item compact" data-target="side_nav" onclick="cls_document.medicine_picklist(this)" title="${raw_drug[x]['comercial']}">${raw_drug[x]['generic']}</div>`;
    }
    return content_list;
  }
  medicine_picklist (div_obj) {
    var drug_id = parseInt(div_obj.id);    
    if (this.medicine_selected.indexOf(drug_id) >= 0) {
      M.toast({ html: '¡Ya Existe!'});
    }
    var url = '/drug_info/' + drug_id; var method = 'GET';
    var body = '';
    var funcion = function (ans_obj) {
      set_sidenav(`/php/side_panel/inc_prescription_paste.php?drug_generic=${ans_obj.tx_drug_generic}&drug_comertial=${ans_obj.tx_drug_comertial}&dose_json=${ans_obj.tx_drug_dose}&frecuency_json=${ans_obj.tx_drug_frecuency}&presentation_json=${ans_obj.presentation}&drug=${drug_id}`);
      var raw_frecuency = JSON.parse(ans_obj.tx_drug_frecuency);
      var raw_dose = JSON.parse(ans_obj.tx_drug_dose);
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
      }, 300)
    }
    laravel_request(url, method, funcion, body);
  }
  sidenav_prescription_add(event,drug_id) {
    event.preventDefault();
    requiredFields(['txt_prescription_dose', 'txt_prescription_frecuency']);
    var drug_description = document.getElementById('txt_prescription_drug').value;
    var drug_comertial = document.getElementById('txt_prescription_drug').getAttribute('alt');
    var prescription_quantity = document.getElementById('txt_prescription_quantity').value;
    var prescription_dose = document.getElementById('txt_prescription_dose').value;
    var presentation = document.getElementById('sel_prescription_presentation');
    var prescription_presentation = presentation[presentation.selectedIndex].innerHTML;
    var prescription_duration = document.getElementById('txt_prescription_duration').value;
    var prescription_frecuency = document.getElementById('txt_prescription_frecuency').value;
    var select_interval = document.getElementById('sel_prescription_interval');
    var interval_factor = select_interval[select_interval.selectedIndex].getAttribute('alt');
    var prescription_interval = select_interval[select_interval.selectedIndex].value;
    if (prescription_interval === '' && prescription_duration != '' || prescription_interval != '' && prescription_duration === '' ) {
      document.getElementById('txt_prescription_duration').classList.add('invalid');
    }else{
      document.getElementById('txt_prescription_duration').classList.remove('invalid');
      document.getElementById('txt_prescription_duration').classList.add('valid');
    }
    var total_quantity = Math.round(prescription_quantity * ((24 / prescription_frecuency) * (prescription_duration * interval_factor)));
    if (prescription_interval === '' && prescription_duration === '') {
      document.getElementById('txt_prescription_duration').classList.remove('invalid');
      document.getElementById('txt_prescription_duration').classList.add('valid');
      prescription_duration = 'nuevo aviso';
      total_quantity = 'Caja de';
    }
    var valid = check_invalid(['txt_prescription_dose', 'txt_prescription_frecuency','txt_prescription_duration']);
    if (!valid) { return false; }

    var recipe_content = `${total_quantity} ${drug_description} (${drug_comertial}) de ${prescription_dose}`;
    var new_recipe = ((document.getElementById('ta_recipe_medicine').value).length < 1) ? recipe_content : `\n${recipe_content}`;
    
    var indication_content = `${drug_description} Adm. ${prescription_quantity} ${prescription_presentation} de ${prescription_dose} cada ${prescription_frecuency} horas hasta ${prescription_duration} ${prescription_interval}.`;
    var new_indication = ((document.getElementById('ta_recipe_indication').value).length < 1) ? indication_content : `\n${indication_content}`;
    
    document.getElementById('ta_recipe_medicine').value += new_recipe;
    document.getElementById('ta_recipe_indication').value += new_indication;
    if (this.medicine_selected.indexOf(drug_id) < 0) {
      this.medicine_selected.push(drug_id);
    }    
    var url = '/save_frecuency_dose'; var method = 'POST';
    var body = JSON.stringify({ a: prescription_dose, b: drug_id, c: prescription_frecuency });
    var funcion = function (ans_obj) {
      M.toast({ html: ans_obj['message'] });
    }
    laravel_request(url, method, funcion, body);
    $('.sidenav').sidenav('close');
  }
  // TRATAMIENTO
  filter_treatment (str) {
    var raw_treatment = this.lookfor_treatment(str);     
    var content_list = this.generate_treatment_list(raw_treatment);
    document.getElementById('recipe_treatment_list').innerHTML = content_list;
  }
  lookfor_treatment(str) {
    var haystack = raw_treatmentlist; var needles = str.split(' ');
    var raw_filtered = new Object;
    for (var i in haystack) {
      var ocurrencys = 0; 
      for (const a in needles) {  if (haystack[i]['title'].toLowerCase().indexOf(needles[a].toLowerCase()) > -1) { ocurrencys++ }  }
      if (ocurrencys === needles.length) {  raw_filtered[i] = haystack[i];  }
    }       
    return this.reorder_treatment(raw_filtered)
  }
  reorder_treatment(raw_filtered) {
    var raw_ordered = []; var raw_returned = new Object;
    for (var a in raw_filtered) { raw_ordered.push(raw_filtered[a]['title'] + '*-*' + a); }
    raw_ordered.sort();
    for (var i = 0; i < raw_ordered.length; i++) {  
      var splited = raw_ordered[i].split("*-*"); 
      raw_returned[splited[1]] = new Object;
      raw_returned[splited[1]]['title'] = splited[0];  
      raw_returned[splited[1]]['slug'] = raw_filtered[splited[1]]['slug'];
    }
    return raw_returned;
  }
  generate_treatment_list(raw_treatment) {
    var content_list = '';
    for (const x in raw_treatment) {       
      content_list += `<div id="${raw_treatment[x]['slug']}" class="item compact"  onclick="cls_document.treatment_picklist(this.id)">${raw_treatment[x]['title']}</div>`; 
    }
    return content_list;
  }
  treatment_picklist(treatment_slug) {
    var url = '/treatment/'+treatment_slug; var method = 'GET';
    var funcion = function (ans_obj) {
      var array_treatment = JSON.parse(ans_obj['tx_treatment_json']);
      var recipe_content = ''; var new_recipe = '';
      var indication_content = ''; var new_indication = '';
      for (const a in array_treatment) {
        var drug_comertial = (array_treatment[a]['comertial'] != '' && array_treatment[a]['comertial'] != null) ? array_treatment[a]['comertial'] : '';
        var prescription_duration = array_treatment[a]['duration'];
        var total_quantity = (array_treatment[a]['duration'] * array_treatment[a]['interval_factor']) * (24 / array_treatment[a]['frecuency']) * array_treatment[a]['quantity'];
        total_quantity = Math.round(total_quantity);
        if (array_treatment[a]['interval'] === '' && array_treatment[a]['duration'] === '') {
          prescription_duration = 'nuevo aviso';
          total_quantity = 'Caja de';
        }
        var line_content = `${total_quantity} ${array_treatment[a]['description']} (${drug_comertial}) de ${array_treatment[a]['dose']}`;
        recipe_content += (recipe_content.length < 1) ? line_content : `\n${line_content}`;

        var line_indication = `${array_treatment[a]['description']} Adm. ${array_treatment[a]['quantity']} ${array_treatment[a]['presentation']} de ${array_treatment[a]['dose']} cada ${array_treatment[a]['frecuency']} horas hasta ${prescription_duration} ${array_treatment[a]['interval']}.`;
        indication_content += (indication_content.length < 1) ? line_indication : `\n${line_indication}`;
      }
      new_recipe += ((document.getElementById('ta_recipe_medicine').value).length < 1) ? recipe_content : `\n${recipe_content}`;
      new_indication += ((document.getElementById('ta_recipe_indication').value).length < 1) ? indication_content : `\n${indication_content}`;  
      document.getElementById('ta_recipe_medicine').value += new_recipe;
      document.getElementById('ta_recipe_indication').value += new_indication;
      M.toast({ html: 'Agregado Correctamente' });
    }
    laravel_request(url, method, funcion);
  }

  make_json_prescription() {
    var raw_prescription = {};
    var prescription_recipe = document.getElementById("ta_recipe_medicine").value;
    var prescription_indication = document.getElementById("ta_recipe_indication").value;
    raw_prescription['recipe'] = prescription_recipe;
    raw_prescription['indication'] = prescription_indication;
    raw_prescription['drug_selected'] = this.medicine_selected;
    return raw_prescription;
  }

  // CONSTANCIA E INCAPACIDAD
  make_json_incapacity () {
    var raw_incapacity = {};
    raw_incapacity['firstdate'] = document.getElementById('txt_modal_incapacity_firstdate').value;
    raw_incapacity['lastdate'] = document.getElementById('txt_modal_incapacity_lastdate').value;
    raw_incapacity['firsthour'] = document.getElementById('txt_modal_incapacity_firsthour').value;
    raw_incapacity['lasthour'] = document.getElementById('txt_modal_incapacity_lasthour').value;
    return raw_incapacity;
  }

  // GUARDAR PAPELERIA
  save_document(date_id, obj_medicalorder, obj_prescription, obj_incapacity) {
    this.array_document[date_id]['medicalorder'] = obj_medicalorder;
    this.array_document[date_id]['prescription'] = obj_prescription;
    this.array_document[date_id]['incapacity'] = obj_incapacity;
    var url = '/document'; var method = 'POST';
    var body = JSON.stringify({ a: this.array_document });
    var funcion = function (history_obj) {
      M.toast({ html: history_obj['message'] });
    }
    laravel_request(url, method, funcion, body);
  }  
}




function generate_laboratory_reveal (div) {
  div.innerHTML = 'probando';
}

