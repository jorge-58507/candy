function check_invalid (inputs) { // inputs es un array que contiene los name de los campos
  // #######    VERIFICA SI HAY CAMPOS CON LA CLASE "INVALID"
  var valid = true;
  for (var x in inputs) {
    var selector = document.getElementsByName(inputs[x]);
    if ( (" " + selector[0].className + " ").replace(/[\n\t]/g, " ").indexOf(" invalid ") > -1 ){
      valid = false;
    }
  }
  return valid;
}
function requiredFields(raw_id) { //   es un array que contiene los ID de los campos
  for (var i in raw_id) {
    if (document.getElementById(raw_id[i]).value.length === 0 || /^\s+$/.test(document.getElementById(raw_id[i]).value)) {
      document.getElementById(raw_id[i]).classList.add('invalid');
    } else {
      document.getElementById(raw_id[i]).classList.remove('invalid');
      document.getElementById(raw_id[i]).classList.add('valid');
    }
  }
}
function requiredAlts(raw_id) { //   es un array que contiene los ID de los campos
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
function set_sidenav (url) {
  // #######    SETEA EL SIDENAV
  var myRequest = new Request(url);
  fetch(myRequest)
  .then(function(response) {  return response.text(); })
  .then(function(mytext) {  document.getElementById('side_nav').innerHTML = mytext;  })
  .catch(function(error){ console.log(error); });
}
function toggle (selector) {
  //   #####   IMPLEMENTACION DE TOOGLE
  var elem = document.getElementById(selector);
  if ( (" " + elem.className + " ").replace(/[\n\t]/g, " ").indexOf(" toggle_on ") > -1 ){
    elem.classList.remove('toggle_on');
    elem.classList.add('toggle_off');
  }else{
    elem.classList.remove('toggle_off');
    elem.classList.add('toggle_on');
  }
}
function validFranz (selector,acept,alt='') { 
  var raw_acept = acept.split(' '); // Allowed separated by spaces
  characters = '';
  for (var i in raw_acept) {
    switch (raw_acept[i]) {
      case 'number':  characters += '0123456789';  break;
      case 'simbol':  characters += '¡!¿?@&%$"#º\'';   break;
      case 'punctuation': characters += ',.:;';    break;
      case 'mathematic':  characters += '+-*/=';   break;
      case 'close':   characters += '[]{}()<>';      break;
      case 'letter':  characters += ' abcdefghijklmnñopqrstuvwxyzáéíóú';  break;
    }
  }
  $("#"+selector).validCampoFranz(characters+alt);
}
// #########        LARAVEL REQUEST-fetch
function laravel_request (url,method,funcion,body_json='') //method es un string
{
  myHeaders = new Headers({"X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content'),"Content-Type" : "application/json"});
  var myInit = { method: method, headers: myHeaders, mode: 'cors', cache: 'default'};
  if (body_json != '') {
    myInit['body'] = body_json
  }
  var myRequest = new Request(url, myInit);
  fetch(myRequest)
  .then(function(response) {
    return response.json();
  })
  .then(function(json_obj) {
    if (json_obj) {
      funcion(json_obj);
    }
  })
  .catch(function(error){
    console.log(error);
  });
}
// #########        ASYNC-AWAIT LARAVEL REQUEST-fetch
async function async_laravel_request(url, method, funcion, body_json = '') //method es un string
{
  myHeaders = new Headers({ "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'), "Content-Type": "application/json" });
  var myInit = { method: method, headers: myHeaders, mode: 'cors', cache: 'default' };
  if (body_json != '') {
    myInit['body'] = body_json
  }
  var myRequest = new Request(url, myInit);
  let response = await fetch(myRequest)
  let json_obj = await response.json();
  if (json_obj) { funcion(json_obj);  }
}
function uc_first(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}
function open_datepicker (originDate) {
  var defaultDate = new Date();
  defaultDate.setFullYear(originDate);

  var datepicker = document.querySelectorAll('.datepicker');
  var instances_datepicker = M.Datepicker.init(datepicker,{"autoClose":true,"format":'dd-mm-yyyy',"container":'body',"defaultDate":defaultDate});

  instances_datepicker.open();
}
function val_dec(str,decimal,refill,split){
  var ans = isNaN(str)
  str = (ans) ? 0 : str;
	if (str === '') { return false;	}
	str = parseFloat(str);
	var pat = new RegExp('(^[-][0-9]{1}|^[0-9]+|[0-9]+)([.][0-9]{1,'+decimal+'})?$');
  if(!pat.test(str)) { return false; }
	var str_splited = (str.toString()).split('.');
	decimal_part = '';
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
	// console.log("devuelto: "+str);
	return str;
}
var win_children;
function print_html (url) {
  if (!win_children) {
    win_children = window.open(url);
  }else{
    win_children.close();
    win_children = window.open(url);
  }
}

function set_focus(field_str) {
  document.getElementById(field_str).focus();
}
function set_empty(field_str) {
  document.getElementById(field_str).value = '';
}