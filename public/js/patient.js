class patient_funct {
  verify_identification(elem) {
    cls_general.requiredFields(['txt_patient_identification']);
    var valid = cls_general.check_invalid(['txt_patient_identification']);
    if (!valid) { return false; }
    var url = '/verify_identification/' + elem.value; var method = 'GET';
    var body = '';
    var funcion = function (patient_obj) {
      if (patient_obj['count'] > 0) {
        M.toast({ html: 'Esta C&eacute;dula ya existe.' })
        elem.classList.remove('valid');
        elem.classList.add('invalid');
      } else {
        elem.classList.remove('invalid');
        elem.classList.add('valid');
      }
    }
    general_funct.prototype.laravel_request(url, method, funcion, body);
  }
  verify_historynumber(elem) {
    cls_general.requiredFields(['txt_patient_history']);
    var valid = cls_general.check_invalid(['txt_patient_history']);
    if (!valid) { M.toast({html: 'Verifique la historia.'}); return false; }
    var url = '/verify_historynumber/' + elem.value; var method = 'GET';
    var body = '';
    var funcion = function (patient_obj) {
      if (patient_obj['count'] > 0) {
        M.toast({ html: 'Este numero de historia ya existe.' })
        elem.classList.remove('valid');
        elem.classList.add('invalid');
      } else {
        elem.classList.remove('invalid');
        elem.classList.add('valid');
      }
    }
    general_funct.prototype.laravel_request(url, method, funcion, body);
  }
  sidenav_patient_save(event) {
    event.preventDefault();
    cls_general.disable_submit(document.getElementById('sidenav_send_patient'));
    cls_general.requiredFields(['txt_patient_name', 'txt_patient_identification', 'txt_patient_birthday', 'sel_patient_gender', 'txt_patient_history', 'txt_patient_direction']);
    this.verify_historynumber(document.getElementById('txt_patient_history'));
    this.verify_identification(document.getElementById('txt_patient_identification'));
    var valid = cls_general.check_invalid(['txt_patient_name', 'txt_patient_identification', 'txt_patient_birthday', 'sel_patient_gender', 'txt_patient_history', 'txt_patient_direction']);
    if (!valid) { cls_general.shot_toast('Verifique los campos.'); return false; }
    var patient_name = (document.getElementById('txt_patient_name').value).replace(/\b\w/g, function (l) { return l.toUpperCase() });
    var identification = document.getElementById('txt_patient_identification').value;
    var birthday = document.getElementById('txt_patient_birthday').value; var gender = document.getElementById('sel_patient_gender').value;
    var history = document.getElementById('txt_patient_history').value; var direction = document.getElementById('txt_patient_direction').value;
    var url = '/save_sidenav_patient/'; var method = 'POST';
    var body = JSON.stringify({ a: patient_name, b: identification, c: birthday, d: gender, e: history, f: direction });
    var funcion = function (mytext) {
      if (mytext) {
        M.toast({ html: mytext['message'] })
        if (mytext['status'] === 'success') {
          document.getElementById("txt_date_patient").value = patient_name;
          document.getElementById("lbl_date_patient").classList.add('active');
          document.getElementById("txt_date_patient").setAttribute("alt", mytext['patient_id']);
          $('.sidenav').sidenav('close');
          $('#txt_date_patient').autocomplete('updateData', mytext['patient_list']);
        } else {
          cls_general.shot_toast('No se guardo el paciente.');
        }
      }
    }
    general_funct.prototype.laravel_request(url, method, funcion, body);
  }
}