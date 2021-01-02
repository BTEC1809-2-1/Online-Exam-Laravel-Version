/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/updateQuestion.js":
/*!****************************************!*\
  !*** ./resources/js/updateQuestion.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $(function () {
    $('#edit').one('click', function (e) {
      e.preventDefault();
      $(this).html() == "Edit" ? updateOn() : submitUpdate();
    });
  });
  var is_correct = null;

  function updateOn() {
    $('#edit').parent().css('display', 'none');
    $('#update').show();
    $('#difficult').append("\n            <select class=\"form-control\" name=\"level_of_difficult\" required>\n                <option value=\"1\">Normal</option>\n                <option value=\"2\">Medium</option>\n                <option value=\"3\">Hard</option>\n            </select> ");
    $('#difficult').children('input').remove();
    var question_type = $('#type').val();
    console.log(question_type);

    if (question_type == 'Single Choice 4' || question_type == 'True False') {
      is_correct = 0;
    } else {
      is_correct = [$('#1').children().val() == 'Correct' ? 1 : 0, $('#2').children().val() == 'Correct' ? 1 : 0, $('#3').children().val() == 'Correct' ? 1 : 0, $('#4').children().val() == 'Correct' ? 1 : 0];
    }

    console.log(is_correct);
    var old_select_index = 1;
    $('.is_correct').empty();
    $('.is_correct').each(function (index) {
      $(this).append("\n                <select class=\"form-control\" id=\"select_is_correct" + index + "\" required>\n                    <option selected value=\"0\"></option>\n                    <option value=\"0\">Not Correct</option>\n                    <option value=\"1\">Correct</option>\n                </select>");
      $('#select_is_correct' + index).on('change', function () {
        if (question_type == 'Single Choice 4' || question_type == 'True False') {
          if ($(this).children('option:selected').val() == 1) {
            $('[id^=select_is_correct').not($(this)).val(0).change();
            is_correct = $(this).parent().attr('id');
          }
        } else {
          is_correct[index] = "0";

          if ($(this).children('option:selected').val() == 1) {
            is_correct[index] = String($(this).parent().attr('id'));
          } else {
            is_correct[index] = "0";
          }
        }

        console.log(is_correct);
        old_select_index = index;
      });
    });
    $(".editable").prop('readonly', false);
  }

  $('#submitUpdate').on('click', function () {
    $('#form').append("<input type=\"hidden\" name=\"is_correct\" value=\"" + is_correct + "\">");
    $('#form').submit();
  });
});

/***/ }),

/***/ 4:
/*!**********************************************!*\
  !*** multi ./resources/js/updateQuestion.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/lebinhan/Workspace/Code/onlineexam/resources/js/updateQuestion.js */"./resources/js/updateQuestion.js");


/***/ })

/******/ });