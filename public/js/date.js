class date_funct
{
  save_new_date (event,selector) {
    event.preventDefault();
    cls_general.disable_submit(document.getElementById("submit_newdate"));
    cls_general.requiredFields (['txt_date_time','txt_date_date']);
    cls_general.requiredAlts(['txt_date_patient', 'txt_date_reason']);
    var valid = cls_general.check_invalid(['txt_date_patient','txt_date_reason','txt_date_time','txt_date_date']);
    if (!valid) { 
      // document.getElementById("submit_newdate").disabled = false;  
      M.toast({ html: "Faltan datos.", classes: "orange lighten-2" });
      return false;
    }
    var date_patient = document.getElementById('txt_date_patient').getAttribute("alt");
    var date_reason = document.getElementById('txt_date_reason').getAttribute("alt");
    var date_time = document.getElementById('txt_date_time').value;
    var date_date = document.getElementById('txt_date_date').value;
    var url = '/date'; var method = 'POST';
    var body = JSON.stringify({a: date_patient, b: date_reason, c: date_time, d: date_date});
    var funcion = function(date_obj) {
      M.toast({html: date_obj['message']});
      date_funct.prototype.render_table_dates(date_obj['date_list']);
      document.getElementById('txt_date_patient').setAttribute("alt","");
      document.getElementById('txt_date_reason').setAttribute("alt","");
      document.getElementById('txt_date_patient').value = '';
      document.getElementById('txt_date_reason').value = '';
      document.getElementById('txt_date_time').value = '';
      general_funct.prototype.toggle('div_create_date');
    }
    cls_general.laravel_request(url,method,funcion,body);
  }
  render_table_dates(obj_date) {
    var body = '';
    for (var a in obj_date) {
      var status_value = (obj_date[a]['tx_date_status'] === 1) ? 'SIN ATENDER'  : 'ATENDIDO';
      var status_color = (obj_date[a]['tx_date_status'] === 1) ? '#006600'      : '#b92c28';
      var attend_button = (obj_date[a]['tx_date_status'] === 1) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-ban"></i>';
      var class_button = (obj_date[a]['tx_date_status'] === 1) ? 'teal' : 'orange';
      body += `
      <div class="bb_1 border_teal">
        <div class="col s5 m6 l4 py_5 center-align truncate" title="${obj_date[a]['tx_patient_name']}">${obj_date[a]['tx_patient_name']}</div>
        <div class="col s3 m2 py_5 center-align truncate" title="${obj_date[a]['tx_date_time']}">${obj_date[a]['tx_date_time']}</div>
        <div class="col s2 hide-on-med-and-down py_5 center-align truncate" title="${obj_date[a]['tx_reason_value']}">${obj_date[a]['tx_reason_value']}</div>
        <div class="col s2 hide-on-med-and-down py_5 center-align" style="color:${status_color};text-decoration:underline ${status_color};">
          ${status_value}
        </div>
        <div class="col s4 m4 l2 py_5 center-align">
          <a class="waves-effect waves-light btn ${class_button} btn-small" onclick="cls_date.open_date('${obj_date[a]['tx_date_slug']}')">${attend_button}</a>
          <a class="waves-effect waves-light btn red darken-2 btn-small" onclick="cls_date.delete_date(${obj_date[a]['tx_date_slug']})"><i class="fa fa-times"></i></a>
        </div>
      </div>
      `;
    }
    if (body.length == 0) {
      body += `
      <div class="bb_1 border_teal">
        <div class="col s12 py_5"></div>
      </div>
      `;
    }
    $("#dtbl_date").hide();
    document.getElementById('dtbl_date').innerHTML = body;
    $("#dtbl_date").toggle(500);
  }
  filter_date(date) {
    var url = '/filter_date_by_date/'+date; var method = 'GET';
    var body = '';
    var funcion = function(date_obj) {
      if (date_obj['response'] === 'failed') {
        document.location.href = './';
      }
      this.render_table_dates(date_obj['date_list']);
    }
    cls_general.laravel_request(url,method,funcion,body);
  }
  delete_date (date_slug) {
    var url = '/date/'+date_slug; var method = 'DELETE';
    var body = '';
    var funcion = function(date_obj) {
      M.toast({html: date_obj['message']});
      date_funct.prototype.render_table_dates(date_obj['date_list']);
    }
    cls_general.laravel_request(url,method,funcion,body);
  }
  open_date (date_slug) {
    var url = '/date/'+date_slug; var method = 'PUT';
    var body = '';
    var funcion = function(date_obj) {
      if (date_obj['response'] === 'success') {
        document.location.href = '/history';
      }else{
        M.toast({html: date_obj['message'], classes: 'red darken-4'})
      }
    }
    cls_general.laravel_request(url,method,funcion,body);
  }



  filter_date(date) {
    var url = '/filter_date_by_date/'+date; var method = 'GET';
    var body = '';
    var funcion = function(date_obj) {
      if (date_obj['response'] === 'failed') {
        document.location.href = './';
      }
      date_funct.prototype.render_table_dates(date_obj['date_list']);
    }
    cls_general.laravel_request(url,method,funcion,body);
  }
// function delete_date (date_slug) {
//   var url = '/date/'+date_slug; var method = 'DELETE';
//   var body = '';
//   var funcion = function(date_obj) {
//     M.toast({html: date_obj['message']});
//     render_table_dates(date_obj['date_list']);
//   }
//   laravel_request(url,method,funcion,body);
// }
// function open_date (date_slug) {
//   var url = '/date/'+date_slug; var method = 'PUT';
//   var body = '';
//   var funcion = function(date_obj) {
//     if (date_obj['response'] === 'success') {
//       document.location.href = '/history';
//     }else{
//       M.toast({html: date_obj['message'], classes: 'red darken-4'})
//     }
//   }
//   laravel_request(url,method,funcion,body);
// }

}

// function filter_date(date) {
//   var url = '/filter_date_by_date/'+date; var method = 'GET';
//   var body = '';
//   var funcion = function(date_obj) {
//     if (date_obj['response'] === 'failed') {
//       document.location.href = './';
//     }
//     render_table_dates(date_obj['date_list']);
//   }
//   laravel_request(url,method,funcion,body);
// }
// function delete_date (date_slug) {
//   var url = '/date/'+date_slug; var method = 'DELETE';
//   var body = '';
//   var funcion = function(date_obj) {
//     M.toast({html: date_obj['message']});
//     render_table_dates(date_obj['date_list']);
//   }
//   laravel_request(url,method,funcion,body);
// }
// function open_date (date_slug) {
//   var url = '/date/'+date_slug; var method = 'PUT';
//   var body = '';
//   var funcion = function(date_obj) {
//     if (date_obj['response'] === 'success') {
//       document.location.href = '/history';
//     }else{
//       M.toast({html: date_obj['message'], classes: 'red darken-4'})
//     }
//   }
//   laravel_request(url,method,funcion,body);
// }
