class reason_funct
{
  sidenav_reason_save(event) {
    event.preventDefault();
    // cls_general.disable_submit(document.getElementById('sidenav_send_reason'));
    cls_general.requiredFields(['txt_reason_value']);
    var valid = cls_general.check_invalid(['txt_reason_value']);
    if (!valid) { return false; }
    var description = document.getElementById('txt_reason_value').value;
    var url = '/reason/'; var method = 'POST';
    var body = JSON.stringify({ a: description });
    var funcion = function (reason_obj) {
      var field = document.getElementById('txt_date_reason');
      field.setAttribute("alt", reason_obj['reason_id']);
      field.value = reason_obj['reason_value'];
      document.getElementById("lbl_date_reason").classList.add('active');
      $('.sidenav').sidenav('close');
      $('#txt_date_reason').autocomplete('updateData', reason_obj['reason_list']);
      cls_general.shot_toast('Motivo Guardado.')
    }
    cls_general.laravel_request(url, method, funcion, body);
  }
}