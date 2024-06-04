// console.log('hello');
// document.addEventListener('DOMContentLoaded', () => {});
document.addEventListener('DOMContentLoaded', function() {

	document.querySelectorAll('[data-click="delete"]').forEach( function( button ) {
		button.addEventListener('click', function( element ) {

			element.preventDefault();

			document.querySelector('.modal').classList.toggle('active');
			let category_id = element.currentTarget.closest('form').querySelector('[type="hidden"]').value;
			document.querySelector('.modal').querySelector('[type="hidden"]').value = category_id;

		});
	});

});

window.addEventListener('load', function() {

});
