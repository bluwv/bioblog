// console.log('hello');

/**
 * Check que le DOM ai fini d'être généré. Tous les éléments sont disponibles pour modification.
 */
// document.addEventListener('DOMContentLoaded', () => {});
document.addEventListener('DOMContentLoaded', function() {

	if ( document.body.classList.contains('categorie') ) {
		document.querySelectorAll('[data-click="delete"]').forEach( function( button ) {
			button.addEventListener('click', function( element ) {

				element.preventDefault();

				document.querySelector('body').classList.add('has-modal-active');
				document.querySelector('.modal-delete').classList.add('active');

				let category_id = element.currentTarget.closest('form').querySelector('[type="hidden"]').value;
				document.querySelector('.modal-delete').querySelector('[type="hidden"]').value = category_id;

			});
		});

		/**
		 * Click pour ouvrir la modal d'ajout d'une nouvelle catégorie
		 */
		document.querySelector('[data-click="new-category"]').addEventListener('click', function( button ) {
			button.preventDefault();

			document.querySelector('body').classList.add('has-modal-active');
			document.querySelector('.modal-add').classList.add('active');

			// let category_id = element.currentTarget.closest('form').querySelector('[type="hidden"]').value;
			// document.querySelector('.modal').querySelector('[type="hidden"]').value = category_id;

		});

		document.querySelectorAll('[data-click="close"]').forEach( function( button ) {
			button.addEventListener('click', function( element ) {
				document.querySelector('body').classList.remove('has-modal-active');
				element.currentTarget.closest('.modal.active').classList.remove('active');
			});
		});
	}

	if ( document.body.classList.contains('home') ) {
		document.querySelector('[name="categorie"]').addEventListener('change', function( select ) {
			select.target.closest('form').submit();
		});
	}

	if ( document.body.classList.contains('single') ) {
		/**
		 * Utilisation d'une librairie pour réaliser des sliders.
		 * Pas oublier de lier le CSS et JS par défaut dans les bons fichiers.
		 * https://glidejs.com/docs/options/#gap
		 */

		var glide = new Glide('.glide', {
			type: 'carousel',
			// autoplay: 4000,
			animationDuration: 600,
			gap: 24,
			startAt: 0,
			perView: 3,
			breakpoints: {
				1000: {
					perView: 2
				},
				600: {
					perView: 1
				}
			}
		})

		glide.mount();
	}

});

/**
 * Check que tous les fichiers ai fini de charger. Images, fichiers externes, …
 */
window.addEventListener('load', function() {

});
