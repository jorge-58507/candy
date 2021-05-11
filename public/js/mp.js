// JavaScript Document
/*DEVELOPED BY JORGE SALDAÑA*/
// ___________________________
// _____****_________****_____
// ____******_______******____
// __***********_***********__
// __***********************__ 
// __*****_____________*****__
// ___****_____________****___
// ___***____*******____***___
// ___***____**___***___***___
// ____**____*******____**____
// ____**____**_________**____
// ____*_____**__________*____
// ___________________________
/*####MOUSTACHED##PLUMBER####*/

class general_funct {
  set_invalid(array_selector) {
    for (const a in array_selector) {
      array_selector[a].classList.remove("input_valid");
      array_selector[a].className += " input_invalid";
    }
  }
  set_valid(array_selector) {
    for (const a in array_selector) {
      array_selector[a].classList.remove("input_invalid");
      array_selector[a].className += " input_valid";
    }
  }
  set_neutral(selector) {
    for (const a in array_selector) {
      array_selector[a].classList.remove("input_valid");
      array_selector[a].classList.remove("input_invalid");
    }
  }
  validate_date(inputText) {
    var valid = true;
    // var dateformat = /^(0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/;
    var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
    // Match the date format through regular expression
    if (inputText.value.match(dateformat)) {
      //Test which seperator is used '/' or '-'
      var opera1 = inputText.value.split('/');
      var opera2 = inputText.value.split('-');
      var lopera1 = opera1.length;
      var lopera2 = opera2.length;
      // Extract the string into month, date and year
      if (lopera1 > 1) {
        var pdate = inputText.value.split('/');
      }
      else if (lopera2 > 1) {
        var pdate = inputText.value.split('-');
      }
      var mm = parseInt(pdate[1]);
      var dd = parseInt(pdate[0]);
      var yy = parseInt(pdate[2]);
      // Create list of days of a month [assume there is no leap year by default]
      var ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
      if (mm == 1 || mm > 2) {
        if (dd > ListofDays[mm - 1]) {
          cls_general.shot_toast('Fecha Invalida');
          return valid = false;
        }
      }
      if (mm == 2) {
        var lyear = false;
        if ((!(yy % 4) && yy % 100) || !(yy % 400)) {
          lyear = true;
        }
        if ((lyear == false) && (dd >= 29)) {
          cls_general.shot_toast('Fecha Invalida');
          return valid = false;
        }
        if ((lyear == true) && (dd > 29)) {
          cls_general.shot_toast('Fecha Invalida');
          return valid = false;
        }
      }
    }
    else {
      inputText.className += " invalid";
      cls_general.shot_toast('Fecha Invalida');
      return valid = false;
    }
    return valid;
  }
  // ###############3   VERIFICAR VACIOS
  validate_empty(array_form){
    var valid = true;
    for (let a = 0; a < array_form.length; a++) {
      if (cls_general.isEmpty(array_form[a]) === 0) {
        valid = false;
      }
    }
    return valid;
  }
  isEmpty(field,set_class=true) {
    if (field.value.length === 0 || /^\s+$/.test(field.value)) {
      if (set_class) {  this.set_invalid([field]);  }
      return 0;  //Vacio
    } else {
      if (set_class) { this.set_valid([field]); }
      return 1;  //Lleno
    }
  } 
  is_empty_var(string) {
    if (string === null || string.length === 0 || /^\s+$/.test(string)) {
      return 0;  //Vacio
    } else {
      return 1;  //Lleno
    }
  }
  set_empty(selector) {
    selector.value = '';
    this.set_neutral(selector);
  }
  // #########        LARAVEL REQUEST-fetch
  laravel_request(url, method, funcion, body_json = '') //method es un string
  {
    var myHeaders = new Headers({ "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'), "Content-Type": "application/json" });
    var myInit = { method: method, headers: myHeaders, mode: 'cors', cache: 'default' };
    if (body_json != '') {
      myInit['body'] = body_json
    }
    var myRequest = new Request(url, myInit);
    fetch(myRequest)
      .then(function (response) {
        return response.json();
      })
      .then(function (json_obj) {
        if (json_obj) {
          funcion(json_obj);
        }
      })
      .catch(function (error) {
        console.log(error);
      });
  }
  // #########        ASYNC-AWAIT LARAVEL REQUEST-fetch
  async async_laravel_request(url, method, funcion, body_json = '') //method es un string
  {
    /* Creado por: Jorge Saldaña, jorgesaldar@gmail.com */
    var myHeaders = new Headers({ "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'), "Content-Type": "application/json" });
    var myInit = { method: method, headers: myHeaders, mode: 'cors', cache: 'default' };
    if (body_json != '') {
      myInit['body'] = body_json
    }
    var myRequest = new Request(url, myInit);
    let response = await fetch(myRequest)
    let json_obj = await response.json();
    if (json_obj) { funcion(json_obj); }
  }

  shot_toast(message,opt={}) {
    M.toast({ html: message,opt })

    // var counter = $('#toast_container').find('div').length
    // var content = `
    //   <div id="toast_${counter+1}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    //     <div class="toast-header">
    //       <strong class="mr-auto">Notification</strong>
    //       <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
    //         <span aria-hidden="true">&times;</span>
    //       </button>
    //     </div>
    //     <div class="toast-body">
    //       ${message}
    //     </div>
    //   </div>
    // `
    // document.getElementById("toast_container").innerHTML += content;     
    // var option = { "delay": 2000 };
    // for (const a in opt) {
    //   option[a] = opt[a];
    // }    
    // $('.toast').toast(option);

    // $(`#toast_${counter + 1}`).toast('show');
    // setTimeout(() => {
    //   $(`#toast_${counter + 1}`).toast('hide');
    // }, 6000);
  }
  date_converter(from, to, string) {
    var raw_fecha = string.split('-');
    var from_splited = from.split('');
    var array_fecha = {};
    for (const a in from_splited) {
      array_fecha[from_splited[a]] = raw_fecha[a];
    }
    var to_splited = to.split('');
    return array_fecha[to_splited[0]] + '-' + array_fecha[to_splited[1]] + '-' + array_fecha[to_splited[2]];
  }
  datetime_converter(from, to, datetime) {
    var split = datetime.split(' ');
    var string = split[0];
    var raw_fecha = string.split('-');
    var from_splited = from.split('');
    var array_fecha = {};
    for (const a in from_splited) {
      array_fecha[from_splited[a]] = raw_fecha[a];
    }
    var to_splited = to.split('');
    return array_fecha[to_splited[0]] + '-' + array_fecha[to_splited[1]] + '-' + array_fecha[to_splited[2]]+' '+split[1];
  }
  //  ###### FUNCION DE REPORTE A PPT
  validFranz(selector, raw_acept, alt = '') { // raw_acept = array; selector = "string"
    var characters = '';
    for (var i in raw_acept) {
      switch (raw_acept[i]) {
        case 'number': characters += '0123456789'; break;
        case 'symbol': characters += '¡!¿?@&%$"#º\''; break;
        case 'punctuation': characters += ',.:;'; break;
        case 'mathematic': characters += '+-*/='; break;
        case 'close': characters += '[]{}()<>'; break;
        case 'word': characters += ' abcdefghijklmnñopqrstuvwxyzáéíóú'; break;
      }
    }
    $("#" + selector).validCampoFranz(characters + alt);
  }
  open_datepicker(originDate) {
    var defaultDate = new Date();
    defaultDate.setFullYear(originDate);

    var datepicker = document.querySelectorAll('.datepicker');
    var instances_datepicker = M.Datepicker.init(datepicker, { "autoClose": true, "format": 'dd-mm-yyyy', "container": 'body', "defaultDate": defaultDate });

    // instances_datepicker.open();
  }
  requiredFields(raw_id) { //   es un array que contiene los ID de los campos
    for (var i in raw_id) {
      if (document.getElementById(raw_id[i]).value.length === 0 || /^\s+$/.test(document.getElementById(raw_id[i]).value)) {
        document.getElementById(raw_id[i]).classList.add('invalid');
      } else {
        document.getElementById(raw_id[i]).classList.remove('invalid');
        document.getElementById(raw_id[i]).classList.add('valid');
      }
    }
  }
  requiredAlts(raw_id) { //   es un array que contiene los ID de los campos
    for (var i in raw_id) {
      var field_alt = document.getElementById(raw_id[i]).getAttribute("alt");
      if (field_alt === null || field_alt.length === 0 || /^\s+$/.test(field_alt)) {
        document.getElementById(raw_id[i]).classList.add('invalid');
      } else {
        document.getElementById(raw_id[i]).classList.remove('invalid');
        document.getElementById(raw_id[i]).classList.add('valid');
      }
    }
  }
  check_invalid(inputs) { // inputs es un array que contiene los name de los campos
    // #######    VERIFICA SI HAY CAMPOS CON LA CLASE "INVALID"
    var valid = true;
    for (var x in inputs) {
      var selector = document.getElementsByName(inputs[x]);
      if ((" " + selector[0].className + " ").replace(/[\n\t]/g, " ").indexOf(" invalid ") > -1) {
        valid = false;
      }
    }
    return valid;
  }
  isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }
  disable_submit(button){
    button.disabled = true;
    setTimeout(() => {
      button.disabled = false;
    }, 5000);
  }
  set_sidenav(url) {
  // #######    SETEA EL SIDENAV
  var myRequest = new Request(url);
  fetch(myRequest)
    .then(function (response) { return response.text(); })
    .then(function (mytext) { document.getElementById('side_nav').innerHTML = mytext; })
    .catch(function (error) { console.log(error); });
  }
  toggle(selector) {  //selector = STRING
  //   #####   IMPLEMENTACION DE TOOGLE
  var elem = document.getElementById(selector);
  if ((" " + elem.className + " ").replace(/[\n\t]/g, " ").indexOf(" toggle_on ") > -1) {
    elem.classList.remove('toggle_on');
    elem.classList.add('toggle_off');
  } else {
    elem.classList.remove('toggle_off');
    elem.classList.add('toggle_on');
  }  
}
uc_first(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}
val_dec(str,decimal,refill,split){
  var ans = isNaN(str)
  str = (ans) ? 0 : str;
	if (str === '') { return false;	}
	str = parseFloat(str);
	var pat = new RegExp('(^[-][0-9]{1}|^[0-9]+|[0-9]+)([.][0-9]{1,'+decimal+'})?$');
  if(!pat.test(str)) { return false; }
	var str_splited = (str.toString()).split('.');
	var decimal_part = '';
	for (var i = 0; i < decimal; i++) { 	decimal_part+='0';	}
	if(str_splited.length > '1') {
		if(str_splited.length > '2') {
			str_splited.splice(2);
		}
		if (str_splited[0].length === 0) {
			str_splited[0]='0';
		}
		if (refill === 1) {
			str_splited[1]+=decimal_part;  // REFILL
		}
		if (split === 1) {
			str_splited[1] = str_splited[1].substr(0, decimal)  // SPLIT
		}
		str = str_splited[0] + '.' + str_splited[1];
  } else {
		if (refill === 1) {
			str = str_splited[0] + '.'+decimal_part;;  // REFILL
		}
	}
	return str;
}

}
//   #######################     GENERALES



