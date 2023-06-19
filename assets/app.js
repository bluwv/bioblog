/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/app.js":
/*!***********************!*\
  !*** ./src/js/app.js ***!
  \***********************/
/***/ (() => {

eval("document.addEventListener('DOMContentLoaded', () => {\n  /**\n   * Affiche le menu au clic sur le burger.\n   * Mobile only. Récupere l'id du burger qui correspond à l'id du menu.\n   */\n  document.querySelectorAll('.burger').forEach(burger => {\n    burger.addEventListener('click', e => {\n      e.preventDefault();\n      let menuID = e.currentTarget.dataset.menu;\n      document.querySelector(`#${menuID}`).classList.toggle('active');\n    });\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9mcm9udC1jc3MvLi9zcmMvanMvYXBwLmpzPzkwZTkiXSwibmFtZXMiOlsiZG9jdW1lbnQiLCJhZGRFdmVudExpc3RlbmVyIiwicXVlcnlTZWxlY3RvckFsbCIsImZvckVhY2giLCJidXJnZXIiLCJlIiwicHJldmVudERlZmF1bHQiLCJtZW51SUQiLCJjdXJyZW50VGFyZ2V0IiwiZGF0YXNldCIsIm1lbnUiLCJxdWVyeVNlbGVjdG9yIiwiY2xhc3NMaXN0IiwidG9nZ2xlIl0sIm1hcHBpbmdzIjoiQUFBQUEsUUFBUSxDQUFDQyxnQkFBVCxDQUEwQixrQkFBMUIsRUFBOEMsTUFBTTtBQUVuRDtBQUNEO0FBQ0E7QUFDQTtBQUNDRCxFQUFBQSxRQUFRLENBQUNFLGdCQUFULENBQTBCLFNBQTFCLEVBQXFDQyxPQUFyQyxDQUE4Q0MsTUFBTSxJQUFJO0FBQ3ZEQSxJQUFBQSxNQUFNLENBQUNILGdCQUFQLENBQXdCLE9BQXhCLEVBQWlDSSxDQUFDLElBQUk7QUFDckNBLE1BQUFBLENBQUMsQ0FBQ0MsY0FBRjtBQUVBLFVBQUlDLE1BQU0sR0FBR0YsQ0FBQyxDQUFDRyxhQUFGLENBQWdCQyxPQUFoQixDQUF3QkMsSUFBckM7QUFDQVYsTUFBQUEsUUFBUSxDQUFDVyxhQUFULENBQXdCLElBQUdKLE1BQU8sRUFBbEMsRUFBcUNLLFNBQXJDLENBQStDQyxNQUEvQyxDQUFzRCxRQUF0RDtBQUNBLEtBTEQ7QUFNQSxHQVBEO0FBUUEsQ0FkRCIsInNvdXJjZXNDb250ZW50IjpbImRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ0RPTUNvbnRlbnRMb2FkZWQnLCAoKSA9PiB7XG5cblx0LyoqXG5cdCAqIEFmZmljaGUgbGUgbWVudSBhdSBjbGljIHN1ciBsZSBidXJnZXIuXG5cdCAqIE1vYmlsZSBvbmx5LiBSw6ljdXBlcmUgbCdpZCBkdSBidXJnZXIgcXVpIGNvcnJlc3BvbmQgw6AgbCdpZCBkdSBtZW51LlxuXHQgKi9cblx0ZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmJ1cmdlcicpLmZvckVhY2goIGJ1cmdlciA9PiB7XG5cdFx0YnVyZ2VyLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZSA9PiB7XG5cdFx0XHRlLnByZXZlbnREZWZhdWx0KCk7XG5cblx0XHRcdGxldCBtZW51SUQgPSBlLmN1cnJlbnRUYXJnZXQuZGF0YXNldC5tZW51O1xuXHRcdFx0ZG9jdW1lbnQucXVlcnlTZWxlY3RvcihgIyR7bWVudUlEfWApLmNsYXNzTGlzdC50b2dnbGUoJ2FjdGl2ZScpO1xuXHRcdH0pO1xuXHR9KTtcbn0pO1xuIl0sImZpbGUiOiIuL3NyYy9qcy9hcHAuanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/js/app.js\n");

/***/ }),

/***/ "./src/scss/app.scss":
/*!***************************!*\
  !*** ./src/scss/app.scss ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvc2Nzcy9hcHAuc2Nzcy5qcyIsInNvdXJjZXMiOlsid2VicGFjazovL2Zyb250LWNzcy8uL3NyYy9zY3NzL2FwcC5zY3NzPzkwOTYiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Il0sIm1hcHBpbmdzIjoiO0FBQUE7Iiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./src/scss/app.scss\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	__webpack_modules__["./src/js/app.js"](0, {}, __webpack_require__);
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./src/scss/app.scss"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;