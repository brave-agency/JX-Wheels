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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/*!***********************!*\
  !*** ./src/blocks.js ***!
  \***********************/
/*! no exports provided */
/*! all exports used */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("Object.defineProperty(__webpack_exports__, \"__esModule\", { value: true });\n/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__block_block_js__ = __webpack_require__(/*! ./block/block.js */ 1);\n/**\n * Gutenberg Blocks\n *\n * All blocks related JavaScript files should be imported here.\n * You can create a new block folder in this dir and include code\n * for that block here as well.\n *\n * All blocks should be included here since this is the file that\n * Webpack is compiling as the input file.\n */\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3NyYy9ibG9ja3MuanM/N2I1YiJdLCJzb3VyY2VzQ29udGVudCI6WyIvKipcbiAqIEd1dGVuYmVyZyBCbG9ja3NcbiAqXG4gKiBBbGwgYmxvY2tzIHJlbGF0ZWQgSmF2YVNjcmlwdCBmaWxlcyBzaG91bGQgYmUgaW1wb3J0ZWQgaGVyZS5cbiAqIFlvdSBjYW4gY3JlYXRlIGEgbmV3IGJsb2NrIGZvbGRlciBpbiB0aGlzIGRpciBhbmQgaW5jbHVkZSBjb2RlXG4gKiBmb3IgdGhhdCBibG9jayBoZXJlIGFzIHdlbGwuXG4gKlxuICogQWxsIGJsb2NrcyBzaG91bGQgYmUgaW5jbHVkZWQgaGVyZSBzaW5jZSB0aGlzIGlzIHRoZSBmaWxlIHRoYXRcbiAqIFdlYnBhY2sgaXMgY29tcGlsaW5nIGFzIHRoZSBpbnB1dCBmaWxlLlxuICovXG5cbmltcG9ydCAnLi9ibG9jay9ibG9jay5qcyc7XG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gLi9zcmMvYmxvY2tzLmpzXG4vLyBtb2R1bGUgaWQgPSAwXG4vLyBtb2R1bGUgY2h1bmtzID0gMCJdLCJtYXBwaW5ncyI6IkFBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///0\n");

/***/ }),
/* 1 */
/*!****************************!*\
  !*** ./src/block/block.js ***!
  \****************************/
/*! exports provided: RevSlider, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("/* unused harmony export RevSlider */\n/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__style_scss__ = __webpack_require__(/*! ./style.scss */ 2);\n/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__style_scss___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__style_scss__);\n/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__editor_scss__ = __webpack_require__(/*! ./editor.scss */ 3);\n/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__editor_scss___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__editor_scss__);\nvar _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if (\"value\" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();\n\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\nfunction _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError(\"this hasn't been initialised - super() hasn't been called\"); } return call && (typeof call === \"object\" || typeof call === \"function\") ? call : self; }\n\nfunction _inherits(subClass, superClass) { if (typeof superClass !== \"function\" && superClass !== null) { throw new TypeError(\"Super expression must either be null or a function, not \" + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }\n\n/**\n * Block dependencies\n */\n\n\n\n/**\n * Internal block libraries\n */\nvar __ = wp.i18n.__;\nvar registerBlockType = wp.blocks.registerBlockType;\nvar _wp$components = wp.components,\n    TextControl = _wp$components.TextControl,\n    Button = _wp$components.Button;\nvar Component = wp.element.Component;\n\n/**\n * RevSlider Editor Element\n */\n\nvar RevSlider = function (_Component) {\n  _inherits(RevSlider, _Component);\n\n  function RevSlider() {\n    _classCallCheck(this, RevSlider);\n\n    var _this = _possibleConstructorReturn(this, (RevSlider.__proto__ || Object.getPrototypeOf(RevSlider)).apply(this, arguments));\n\n    var _this$props$attribute = _this.props.attributes,\n        text = _this$props$attribute.text,\n        sliderTitle = _this$props$attribute.sliderTitle,\n        modal = _this$props$attribute.modal;\n\n    _this.state = {\n      text: text,\n      sliderTitle: sliderTitle,\n      modal: modal\n    };\n    return _this;\n  }\n\n  /* \n   componentDidMount() {\n      console.log(this.props.attributes.checked);\n  \tif(!this.props.attributes.checked) {\n  \t\t\n  \t\tthis.props.attributes.checked = true;\n  \t\tRS_SC_WIZARD.openTemplateLibrary();\n  \t\t\n  \t}\n  \t\n   }\n   */\n\n  _createClass(RevSlider, [{\n    key: 'render',\n    value: function render() {\n      var _this2 = this;\n\n      var _props = this.props,\n          _props$attributes = _props.attributes,\n          text = _props$attributes.text,\n          sliderTitle = _props$attributes.sliderTitle,\n          modal = _props$attributes.modal,\n          setAttributes = _props.setAttributes;\n\n\n      window.revslider_react = this;\n      var openDialog = function openDialog() {\n\n        RS_SC_WIZARD.openTemplateLibrary();\n      };\n\n      var openSliderEditor = function openSliderEditor() {\n\n        RS_SC_WIZARD.openSliderEditor();\n      };\n\n      return wp.element.createElement(\n        'div',\n        { className: 'revslider_block', 'data-modal': this.state.modal },\n        wp.element.createElement(\n          'span',\n          null,\n          wp.element.createElement(\n            'i',\n            { 'class': 'material-icons' },\n            'picture_in_picture'\n          ),\n          this.state.sliderTitle,\n          '\\xA0'\n        ),\n        wp.element.createElement(TextControl, {\n          className: 'slider_slug',\n          value: this.state.text,\n          onChange: function onChange(text) {\n            return setAttributes({ text: _this2.state.text });\n          }\n        }),\n        wp.element.createElement(\n          Button,\n          {\n            isDefault: true,\n            onClick: openSliderEditor,\n            icon: 'edit',\n            className: 'slider_editor_button'\n          },\n          'edit'\n        ),\n        wp.element.createElement(\n          Button,\n          {\n            isDefault: true,\n            onClick: openDialog,\n            className: 'slider_edit_button'\n          },\n          'Select Module'\n        )\n      );\n    }\n  }]);\n\n  return RevSlider;\n}(Component);\n\n/**\n * Register block\n */\n/* unused harmony default export */ var _unused_webpack_default_export = (registerBlockType('themepunch/revslider', {\n  title: __('Slider Revolution', 'revslider'),\n  description: __('Add your Slider Revolution.', 'revslider'),\n  category: 'themepunch',\n  icon: {\n    src: 'update',\n    background: 'rgb(94,53,177)',\n    color: 'white',\n    viewbox: \"0 0 24 24\"\n  },\n  keywords: [__('Banner', 'revslider'), __('CTA', 'revslider'), __('Slider', 'revslider')],\n  attributes: {\n    checked: {\n      type: 'boolean',\n      default: false\n    },\n    modal: {\n      type: 'boolean',\n      default: false\n    },\n    text: {\n      selector: '.revslider',\n      type: 'string',\n      source: 'text'\n    },\n    sliderTitle: {\n      selector: '.revslider',\n      type: 'string',\n      source: 'attribute',\n      attribute: 'data-slidertitle'\n    }\n  },\n  edit: function edit(props) {\n    var setAttributes = props.setAttributes;\n\n    return wp.element.createElement(\n      'div',\n      null,\n      wp.element.createElement(RevSlider, Object.assign({ setAttributes: setAttributes }, props))\n    );\n  },\n  save: function save(props) {\n    var _props$attributes2 = props.attributes,\n        text = _props$attributes2.text,\n        sliderTitle = _props$attributes2.sliderTitle,\n        modal = _props$attributes2.modal;\n\n    return wp.element.createElement(\n      'div',\n      { className: 'revslider', 'data-modal': modal, 'data-slidertitle': sliderTitle },\n      text\n    );\n  },\n  deprecated: [{\n    attributes: {\n      checked: {\n        type: 'boolean',\n        default: false\n      },\n      text: {\n        selector: '.revslider',\n        type: 'string',\n        source: 'text'\n      },\n      sliderTitle: {\n        selector: '.revslider',\n        type: 'string',\n        source: 'attribute',\n        attribute: 'data-slidertitle'\n      }\n    },\n    save: function save(props) {\n      return wp.element.createElement(\n        'div',\n        { className: 'revslider', 'data-slidertitle': props.attributes.sliderTitle },\n        props.attributes.text\n      );\n    }\n  }]\n}));//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMS5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3NyYy9ibG9jay9ibG9jay5qcz85MjFkIl0sInNvdXJjZXNDb250ZW50IjpbInZhciBfY3JlYXRlQ2xhc3MgPSBmdW5jdGlvbiAoKSB7IGZ1bmN0aW9uIGRlZmluZVByb3BlcnRpZXModGFyZ2V0LCBwcm9wcykgeyBmb3IgKHZhciBpID0gMDsgaSA8IHByb3BzLmxlbmd0aDsgaSsrKSB7IHZhciBkZXNjcmlwdG9yID0gcHJvcHNbaV07IGRlc2NyaXB0b3IuZW51bWVyYWJsZSA9IGRlc2NyaXB0b3IuZW51bWVyYWJsZSB8fCBmYWxzZTsgZGVzY3JpcHRvci5jb25maWd1cmFibGUgPSB0cnVlOyBpZiAoXCJ2YWx1ZVwiIGluIGRlc2NyaXB0b3IpIGRlc2NyaXB0b3Iud3JpdGFibGUgPSB0cnVlOyBPYmplY3QuZGVmaW5lUHJvcGVydHkodGFyZ2V0LCBkZXNjcmlwdG9yLmtleSwgZGVzY3JpcHRvcik7IH0gfSByZXR1cm4gZnVuY3Rpb24gKENvbnN0cnVjdG9yLCBwcm90b1Byb3BzLCBzdGF0aWNQcm9wcykgeyBpZiAocHJvdG9Qcm9wcykgZGVmaW5lUHJvcGVydGllcyhDb25zdHJ1Y3Rvci5wcm90b3R5cGUsIHByb3RvUHJvcHMpOyBpZiAoc3RhdGljUHJvcHMpIGRlZmluZVByb3BlcnRpZXMoQ29uc3RydWN0b3IsIHN0YXRpY1Byb3BzKTsgcmV0dXJuIENvbnN0cnVjdG9yOyB9OyB9KCk7XG5cbmZ1bmN0aW9uIF9jbGFzc0NhbGxDaGVjayhpbnN0YW5jZSwgQ29uc3RydWN0b3IpIHsgaWYgKCEoaW5zdGFuY2UgaW5zdGFuY2VvZiBDb25zdHJ1Y3RvcikpIHsgdGhyb3cgbmV3IFR5cGVFcnJvcihcIkNhbm5vdCBjYWxsIGEgY2xhc3MgYXMgYSBmdW5jdGlvblwiKTsgfSB9XG5cbmZ1bmN0aW9uIF9wb3NzaWJsZUNvbnN0cnVjdG9yUmV0dXJuKHNlbGYsIGNhbGwpIHsgaWYgKCFzZWxmKSB7IHRocm93IG5ldyBSZWZlcmVuY2VFcnJvcihcInRoaXMgaGFzbid0IGJlZW4gaW5pdGlhbGlzZWQgLSBzdXBlcigpIGhhc24ndCBiZWVuIGNhbGxlZFwiKTsgfSByZXR1cm4gY2FsbCAmJiAodHlwZW9mIGNhbGwgPT09IFwib2JqZWN0XCIgfHwgdHlwZW9mIGNhbGwgPT09IFwiZnVuY3Rpb25cIikgPyBjYWxsIDogc2VsZjsgfVxuXG5mdW5jdGlvbiBfaW5oZXJpdHMoc3ViQ2xhc3MsIHN1cGVyQ2xhc3MpIHsgaWYgKHR5cGVvZiBzdXBlckNsYXNzICE9PSBcImZ1bmN0aW9uXCIgJiYgc3VwZXJDbGFzcyAhPT0gbnVsbCkgeyB0aHJvdyBuZXcgVHlwZUVycm9yKFwiU3VwZXIgZXhwcmVzc2lvbiBtdXN0IGVpdGhlciBiZSBudWxsIG9yIGEgZnVuY3Rpb24sIG5vdCBcIiArIHR5cGVvZiBzdXBlckNsYXNzKTsgfSBzdWJDbGFzcy5wcm90b3R5cGUgPSBPYmplY3QuY3JlYXRlKHN1cGVyQ2xhc3MgJiYgc3VwZXJDbGFzcy5wcm90b3R5cGUsIHsgY29uc3RydWN0b3I6IHsgdmFsdWU6IHN1YkNsYXNzLCBlbnVtZXJhYmxlOiBmYWxzZSwgd3JpdGFibGU6IHRydWUsIGNvbmZpZ3VyYWJsZTogdHJ1ZSB9IH0pOyBpZiAoc3VwZXJDbGFzcykgT2JqZWN0LnNldFByb3RvdHlwZU9mID8gT2JqZWN0LnNldFByb3RvdHlwZU9mKHN1YkNsYXNzLCBzdXBlckNsYXNzKSA6IHN1YkNsYXNzLl9fcHJvdG9fXyA9IHN1cGVyQ2xhc3M7IH1cblxuLyoqXG4gKiBCbG9jayBkZXBlbmRlbmNpZXNcbiAqL1xuaW1wb3J0ICcuL3N0eWxlLnNjc3MnO1xuaW1wb3J0ICcuL2VkaXRvci5zY3NzJztcblxuLyoqXG4gKiBJbnRlcm5hbCBibG9jayBsaWJyYXJpZXNcbiAqL1xudmFyIF9fID0gd3AuaTE4bi5fXztcbnZhciByZWdpc3RlckJsb2NrVHlwZSA9IHdwLmJsb2Nrcy5yZWdpc3RlckJsb2NrVHlwZTtcbnZhciBfd3AkY29tcG9uZW50cyA9IHdwLmNvbXBvbmVudHMsXG4gICAgVGV4dENvbnRyb2wgPSBfd3AkY29tcG9uZW50cy5UZXh0Q29udHJvbCxcbiAgICBCdXR0b24gPSBfd3AkY29tcG9uZW50cy5CdXR0b247XG52YXIgQ29tcG9uZW50ID0gd3AuZWxlbWVudC5Db21wb25lbnQ7XG5cbi8qKlxuICogUmV2U2xpZGVyIEVkaXRvciBFbGVtZW50XG4gKi9cblxuZXhwb3J0IHZhciBSZXZTbGlkZXIgPSBmdW5jdGlvbiAoX0NvbXBvbmVudCkge1xuICBfaW5oZXJpdHMoUmV2U2xpZGVyLCBfQ29tcG9uZW50KTtcblxuICBmdW5jdGlvbiBSZXZTbGlkZXIoKSB7XG4gICAgX2NsYXNzQ2FsbENoZWNrKHRoaXMsIFJldlNsaWRlcik7XG5cbiAgICB2YXIgX3RoaXMgPSBfcG9zc2libGVDb25zdHJ1Y3RvclJldHVybih0aGlzLCAoUmV2U2xpZGVyLl9fcHJvdG9fXyB8fCBPYmplY3QuZ2V0UHJvdG90eXBlT2YoUmV2U2xpZGVyKSkuYXBwbHkodGhpcywgYXJndW1lbnRzKSk7XG5cbiAgICB2YXIgX3RoaXMkcHJvcHMkYXR0cmlidXRlID0gX3RoaXMucHJvcHMuYXR0cmlidXRlcyxcbiAgICAgICAgdGV4dCA9IF90aGlzJHByb3BzJGF0dHJpYnV0ZS50ZXh0LFxuICAgICAgICBzbGlkZXJUaXRsZSA9IF90aGlzJHByb3BzJGF0dHJpYnV0ZS5zbGlkZXJUaXRsZSxcbiAgICAgICAgbW9kYWwgPSBfdGhpcyRwcm9wcyRhdHRyaWJ1dGUubW9kYWw7XG5cbiAgICBfdGhpcy5zdGF0ZSA9IHtcbiAgICAgIHRleHQ6IHRleHQsXG4gICAgICBzbGlkZXJUaXRsZTogc2xpZGVyVGl0bGUsXG4gICAgICBtb2RhbDogbW9kYWxcbiAgICB9O1xuICAgIHJldHVybiBfdGhpcztcbiAgfVxuXG4gIC8qIFxuICAgY29tcG9uZW50RGlkTW91bnQoKSB7XG4gICAgICBjb25zb2xlLmxvZyh0aGlzLnByb3BzLmF0dHJpYnV0ZXMuY2hlY2tlZCk7XG4gIFx0aWYoIXRoaXMucHJvcHMuYXR0cmlidXRlcy5jaGVja2VkKSB7XG4gIFx0XHRcbiAgXHRcdHRoaXMucHJvcHMuYXR0cmlidXRlcy5jaGVja2VkID0gdHJ1ZTtcbiAgXHRcdFJTX1NDX1dJWkFSRC5vcGVuVGVtcGxhdGVMaWJyYXJ5KCk7XG4gIFx0XHRcbiAgXHR9XG4gIFx0XG4gICB9XG4gICAqL1xuXG4gIF9jcmVhdGVDbGFzcyhSZXZTbGlkZXIsIFt7XG4gICAga2V5OiAncmVuZGVyJyxcbiAgICB2YWx1ZTogZnVuY3Rpb24gcmVuZGVyKCkge1xuICAgICAgdmFyIF90aGlzMiA9IHRoaXM7XG5cbiAgICAgIHZhciBfcHJvcHMgPSB0aGlzLnByb3BzLFxuICAgICAgICAgIF9wcm9wcyRhdHRyaWJ1dGVzID0gX3Byb3BzLmF0dHJpYnV0ZXMsXG4gICAgICAgICAgdGV4dCA9IF9wcm9wcyRhdHRyaWJ1dGVzLnRleHQsXG4gICAgICAgICAgc2xpZGVyVGl0bGUgPSBfcHJvcHMkYXR0cmlidXRlcy5zbGlkZXJUaXRsZSxcbiAgICAgICAgICBtb2RhbCA9IF9wcm9wcyRhdHRyaWJ1dGVzLm1vZGFsLFxuICAgICAgICAgIHNldEF0dHJpYnV0ZXMgPSBfcHJvcHMuc2V0QXR0cmlidXRlcztcblxuXG4gICAgICB3aW5kb3cucmV2c2xpZGVyX3JlYWN0ID0gdGhpcztcbiAgICAgIHZhciBvcGVuRGlhbG9nID0gZnVuY3Rpb24gb3BlbkRpYWxvZygpIHtcblxuICAgICAgICBSU19TQ19XSVpBUkQub3BlblRlbXBsYXRlTGlicmFyeSgpO1xuICAgICAgfTtcblxuICAgICAgdmFyIG9wZW5TbGlkZXJFZGl0b3IgPSBmdW5jdGlvbiBvcGVuU2xpZGVyRWRpdG9yKCkge1xuXG4gICAgICAgIFJTX1NDX1dJWkFSRC5vcGVuU2xpZGVyRWRpdG9yKCk7XG4gICAgICB9O1xuXG4gICAgICByZXR1cm4gd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFxuICAgICAgICAnZGl2JyxcbiAgICAgICAgeyBjbGFzc05hbWU6ICdyZXZzbGlkZXJfYmxvY2snLCAnZGF0YS1tb2RhbCc6IHRoaXMuc3RhdGUubW9kYWwgfSxcbiAgICAgICAgd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFxuICAgICAgICAgICdzcGFuJyxcbiAgICAgICAgICBudWxsLFxuICAgICAgICAgIHdwLmVsZW1lbnQuY3JlYXRlRWxlbWVudChcbiAgICAgICAgICAgICdpJyxcbiAgICAgICAgICAgIHsgJ2NsYXNzJzogJ21hdGVyaWFsLWljb25zJyB9LFxuICAgICAgICAgICAgJ3BpY3R1cmVfaW5fcGljdHVyZSdcbiAgICAgICAgICApLFxuICAgICAgICAgIHRoaXMuc3RhdGUuc2xpZGVyVGl0bGUsXG4gICAgICAgICAgJ1xceEEwJ1xuICAgICAgICApLFxuICAgICAgICB3cC5lbGVtZW50LmNyZWF0ZUVsZW1lbnQoVGV4dENvbnRyb2wsIHtcbiAgICAgICAgICBjbGFzc05hbWU6ICdzbGlkZXJfc2x1ZycsXG4gICAgICAgICAgdmFsdWU6IHRoaXMuc3RhdGUudGV4dCxcbiAgICAgICAgICBvbkNoYW5nZTogZnVuY3Rpb24gb25DaGFuZ2UodGV4dCkge1xuICAgICAgICAgICAgcmV0dXJuIHNldEF0dHJpYnV0ZXMoeyB0ZXh0OiBfdGhpczIuc3RhdGUudGV4dCB9KTtcbiAgICAgICAgICB9XG4gICAgICAgIH0pLFxuICAgICAgICB3cC5lbGVtZW50LmNyZWF0ZUVsZW1lbnQoXG4gICAgICAgICAgQnV0dG9uLFxuICAgICAgICAgIHtcbiAgICAgICAgICAgIGlzRGVmYXVsdDogdHJ1ZSxcbiAgICAgICAgICAgIG9uQ2xpY2s6IG9wZW5TbGlkZXJFZGl0b3IsXG4gICAgICAgICAgICBpY29uOiAnZWRpdCcsXG4gICAgICAgICAgICBjbGFzc05hbWU6ICdzbGlkZXJfZWRpdG9yX2J1dHRvbidcbiAgICAgICAgICB9LFxuICAgICAgICAgICdlZGl0J1xuICAgICAgICApLFxuICAgICAgICB3cC5lbGVtZW50LmNyZWF0ZUVsZW1lbnQoXG4gICAgICAgICAgQnV0dG9uLFxuICAgICAgICAgIHtcbiAgICAgICAgICAgIGlzRGVmYXVsdDogdHJ1ZSxcbiAgICAgICAgICAgIG9uQ2xpY2s6IG9wZW5EaWFsb2csXG4gICAgICAgICAgICBjbGFzc05hbWU6ICdzbGlkZXJfZWRpdF9idXR0b24nXG4gICAgICAgICAgfSxcbiAgICAgICAgICAnU2VsZWN0IE1vZHVsZSdcbiAgICAgICAgKVxuICAgICAgKTtcbiAgICB9XG4gIH1dKTtcblxuICByZXR1cm4gUmV2U2xpZGVyO1xufShDb21wb25lbnQpO1xuXG4vKipcbiAqIFJlZ2lzdGVyIGJsb2NrXG4gKi9cbmV4cG9ydCBkZWZhdWx0IHJlZ2lzdGVyQmxvY2tUeXBlKCd0aGVtZXB1bmNoL3JldnNsaWRlcicsIHtcbiAgdGl0bGU6IF9fKCdTbGlkZXIgUmV2b2x1dGlvbicsICdyZXZzbGlkZXInKSxcbiAgZGVzY3JpcHRpb246IF9fKCdBZGQgeW91ciBTbGlkZXIgUmV2b2x1dGlvbi4nLCAncmV2c2xpZGVyJyksXG4gIGNhdGVnb3J5OiAndGhlbWVwdW5jaCcsXG4gIGljb246IHtcbiAgICBzcmM6ICd1cGRhdGUnLFxuICAgIGJhY2tncm91bmQ6ICdyZ2IoOTQsNTMsMTc3KScsXG4gICAgY29sb3I6ICd3aGl0ZScsXG4gICAgdmlld2JveDogXCIwIDAgMjQgMjRcIlxuICB9LFxuICBrZXl3b3JkczogW19fKCdCYW5uZXInLCAncmV2c2xpZGVyJyksIF9fKCdDVEEnLCAncmV2c2xpZGVyJyksIF9fKCdTbGlkZXInLCAncmV2c2xpZGVyJyldLFxuICBhdHRyaWJ1dGVzOiB7XG4gICAgY2hlY2tlZDoge1xuICAgICAgdHlwZTogJ2Jvb2xlYW4nLFxuICAgICAgZGVmYXVsdDogZmFsc2VcbiAgICB9LFxuICAgIG1vZGFsOiB7XG4gICAgICB0eXBlOiAnYm9vbGVhbicsXG4gICAgICBkZWZhdWx0OiBmYWxzZVxuICAgIH0sXG4gICAgdGV4dDoge1xuICAgICAgc2VsZWN0b3I6ICcucmV2c2xpZGVyJyxcbiAgICAgIHR5cGU6ICdzdHJpbmcnLFxuICAgICAgc291cmNlOiAndGV4dCdcbiAgICB9LFxuICAgIHNsaWRlclRpdGxlOiB7XG4gICAgICBzZWxlY3RvcjogJy5yZXZzbGlkZXInLFxuICAgICAgdHlwZTogJ3N0cmluZycsXG4gICAgICBzb3VyY2U6ICdhdHRyaWJ1dGUnLFxuICAgICAgYXR0cmlidXRlOiAnZGF0YS1zbGlkZXJ0aXRsZSdcbiAgICB9XG4gIH0sXG4gIGVkaXQ6IGZ1bmN0aW9uIGVkaXQocHJvcHMpIHtcbiAgICB2YXIgc2V0QXR0cmlidXRlcyA9IHByb3BzLnNldEF0dHJpYnV0ZXM7XG5cbiAgICByZXR1cm4gd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFxuICAgICAgJ2RpdicsXG4gICAgICBudWxsLFxuICAgICAgd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFJldlNsaWRlciwgT2JqZWN0LmFzc2lnbih7IHNldEF0dHJpYnV0ZXM6IHNldEF0dHJpYnV0ZXMgfSwgcHJvcHMpKVxuICAgICk7XG4gIH0sXG4gIHNhdmU6IGZ1bmN0aW9uIHNhdmUocHJvcHMpIHtcbiAgICB2YXIgX3Byb3BzJGF0dHJpYnV0ZXMyID0gcHJvcHMuYXR0cmlidXRlcyxcbiAgICAgICAgdGV4dCA9IF9wcm9wcyRhdHRyaWJ1dGVzMi50ZXh0LFxuICAgICAgICBzbGlkZXJUaXRsZSA9IF9wcm9wcyRhdHRyaWJ1dGVzMi5zbGlkZXJUaXRsZSxcbiAgICAgICAgbW9kYWwgPSBfcHJvcHMkYXR0cmlidXRlczIubW9kYWw7XG5cbiAgICByZXR1cm4gd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFxuICAgICAgJ2RpdicsXG4gICAgICB7IGNsYXNzTmFtZTogJ3JldnNsaWRlcicsICdkYXRhLW1vZGFsJzogbW9kYWwsICdkYXRhLXNsaWRlcnRpdGxlJzogc2xpZGVyVGl0bGUgfSxcbiAgICAgIHRleHRcbiAgICApO1xuICB9LFxuICBkZXByZWNhdGVkOiBbe1xuICAgIGF0dHJpYnV0ZXM6IHtcbiAgICAgIGNoZWNrZWQ6IHtcbiAgICAgICAgdHlwZTogJ2Jvb2xlYW4nLFxuICAgICAgICBkZWZhdWx0OiBmYWxzZVxuICAgICAgfSxcbiAgICAgIHRleHQ6IHtcbiAgICAgICAgc2VsZWN0b3I6ICcucmV2c2xpZGVyJyxcbiAgICAgICAgdHlwZTogJ3N0cmluZycsXG4gICAgICAgIHNvdXJjZTogJ3RleHQnXG4gICAgICB9LFxuICAgICAgc2xpZGVyVGl0bGU6IHtcbiAgICAgICAgc2VsZWN0b3I6ICcucmV2c2xpZGVyJyxcbiAgICAgICAgdHlwZTogJ3N0cmluZycsXG4gICAgICAgIHNvdXJjZTogJ2F0dHJpYnV0ZScsXG4gICAgICAgIGF0dHJpYnV0ZTogJ2RhdGEtc2xpZGVydGl0bGUnXG4gICAgICB9XG4gICAgfSxcbiAgICBzYXZlOiBmdW5jdGlvbiBzYXZlKHByb3BzKSB7XG4gICAgICByZXR1cm4gd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFxuICAgICAgICAnZGl2JyxcbiAgICAgICAgeyBjbGFzc05hbWU6ICdyZXZzbGlkZXInLCAnZGF0YS1zbGlkZXJ0aXRsZSc6IHByb3BzLmF0dHJpYnV0ZXMuc2xpZGVyVGl0bGUgfSxcbiAgICAgICAgcHJvcHMuYXR0cmlidXRlcy50ZXh0XG4gICAgICApO1xuICAgIH1cbiAgfV1cbn0pO1xuXG5cbi8vLy8vLy8vLy8vLy8vLy8vL1xuLy8gV0VCUEFDSyBGT09URVJcbi8vIC4vc3JjL2Jsb2NrL2Jsb2NrLmpzXG4vLyBtb2R1bGUgaWQgPSAxXG4vLyBtb2R1bGUgY2h1bmtzID0gMCJdLCJtYXBwaW5ncyI6IkFBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///1\n");

/***/ }),
/* 2 */
/*!******************************!*\
  !*** ./src/block/style.scss ***!
  \******************************/
/*! dynamic exports provided */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMi5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3NyYy9ibG9jay9zdHlsZS5zY3NzPzgwZjMiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW5cblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyAuL3NyYy9ibG9jay9zdHlsZS5zY3NzXG4vLyBtb2R1bGUgaWQgPSAyXG4vLyBtb2R1bGUgY2h1bmtzID0gMCJdLCJtYXBwaW5ncyI6IkFBQUEiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///2\n");

/***/ }),
/* 3 */
/*!*******************************!*\
  !*** ./src/block/editor.scss ***!
  \*******************************/
/*! dynamic exports provided */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMy5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3NyYy9ibG9jay9lZGl0b3Iuc2Nzcz80OWQyIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIHJlbW92ZWQgYnkgZXh0cmFjdC10ZXh0LXdlYnBhY2stcGx1Z2luXG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gLi9zcmMvYmxvY2svZWRpdG9yLnNjc3Ncbi8vIG1vZHVsZSBpZCA9IDNcbi8vIG1vZHVsZSBjaHVua3MgPSAwIl0sIm1hcHBpbmdzIjoiQUFBQSIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///3\n");

/***/ })
/******/ ]);