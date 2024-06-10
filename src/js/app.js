// console.log('hello');

/**
 * Check que le DOM ai fini d'être généré. Tous les éléments sont disponibles pour modification.
 */
// document.addEventListener('DOMContentLoaded', () => {});
document.addEventListener('DOMContentLoaded', function() {

	document.querySelectorAll('[data-click="delete"]').forEach( function( button ) {
		button.addEventListener('click', function( element ) {

			element.preventDefault();

			document.querySelector('body').classList.add('has-modal-active');
			document.querySelector('.modal').classList.add('active');

			let category_id = element.currentTarget.closest('form').querySelector('[type="hidden"]').value;
			document.querySelector('.modal').querySelector('[type="hidden"]').value = category_id;

		});
	});

	document.querySelector('[data-click="close"]').addEventListener('click', function( button ) {
		document.querySelector('body').classList.remove('has-modal-active');
		button.currentTarget.closest('.modal').classList.remove('active');
	})


});

/**
 * Check que tous les fichiers ai fini de charger. Images, fichiers externes, …
 */
window.addEventListener('load', function() {

});
