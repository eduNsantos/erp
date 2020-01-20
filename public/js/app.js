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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: C:\\wamp\\www\\erp\\resources\\js\\app.js: Unexpected token (15:19)\n\n\u001b[0m \u001b[90m 13 | \u001b[39m    $\u001b[33m.\u001b[39majax({\u001b[0m\n\u001b[0m \u001b[90m 14 | \u001b[39m        url\u001b[33m:\u001b[39m url\u001b[33m,\u001b[39m\u001b[0m\n\u001b[0m\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 15 | \u001b[39m        beforeSend(() \u001b[33m=>\u001b[39m $(menuContent)\u001b[33m.\u001b[39mhtml(\u001b[32m'Carregando...'\u001b[39m))\u001b[0m\n\u001b[0m \u001b[90m    | \u001b[39m                   \u001b[31m\u001b[1m^\u001b[22m\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 16 | \u001b[39m    })\u001b[0m\n\u001b[0m \u001b[90m 17 | \u001b[39m    \u001b[33m.\u001b[39mdone(response \u001b[33m=>\u001b[39m $(menuContent)\u001b[33m.\u001b[39mhtml(response))\u001b[33m;\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 18 | \u001b[39m})\u001b[33m;\u001b[39m\u001b[0m\n    at Parser.raise (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:7013:17)\n    at Parser.unexpected (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:8384:16)\n    at Parser.parseIdentifierName (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:10325:18)\n    at Parser.parseIdentifier (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:10303:23)\n    at Parser.parseBindingAtom (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:8741:17)\n    at Parser.parseMaybeDefault (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:8801:25)\n    at Parser.parseAssignableListItem (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:8783:23)\n    at Parser.parseBindingList (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:8775:24)\n    at Parser.parseFunctionParams (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:11386:24)\n    at Parser.parseMethod (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:10159:10)\n    at Parser.parseObjectMethod (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:10077:19)\n    at Parser.parseObjPropValue (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:10119:23)\n    at Parser.parseObjectMember (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:10043:10)\n    at Parser.parseObj (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9963:25)\n    at Parser.parseExprAtom (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9582:28)\n    at Parser.parseExprSubscripts (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9219:23)\n    at Parser.parseMaybeUnary (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9199:21)\n    at Parser.parseExprOps (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9067:23)\n    at Parser.parseMaybeConditional (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9040:23)\n    at Parser.parseMaybeAssign (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9000:21)\n    at Parser.parseExprListItem (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:10295:18)\n    at Parser.parseCallExpressionArguments (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9404:22)\n    at Parser.parseSubscript (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9310:31)\n    at Parser.parseSubscripts (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9240:19)\n    at Parser.parseExprSubscripts (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9229:17)\n    at Parser.parseMaybeUnary (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9199:21)\n    at Parser.parseExprOps (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9067:23)\n    at Parser.parseMaybeConditional (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9040:23)\n    at Parser.parseMaybeAssign (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:9000:21)\n    at Parser.parseExpression (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:8950:23)\n    at Parser.parseStatementContent (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:10787:23)\n    at Parser.parseStatement (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:10658:17)\n    at Parser.parseBlockOrModuleBlockBody (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:11234:25)\n    at Parser.parseBlockBody (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:11221:10)\n    at Parser.parseBlock (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:11205:10)\n    at Parser.parseFunctionBody (C:\\wamp\\www\\erp\\node_modules\\@babel\\parser\\lib\\index.js:10220:24)");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\wamp\www\erp\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\wamp\www\erp\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });