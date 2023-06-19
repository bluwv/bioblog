document.addEventListener('DOMContentLoaded', () => {

	/**
	 * Affiche le menu au clic sur le burger.
	 * Mobile only. Récupere l'id du burger qui correspond à l'id du menu.
	 */
	document.querySelectorAll('.burger').forEach( burger => {
		burger.addEventListener('click', e => {
			e.preventDefault();

			let menuID = e.currentTarget.dataset.menu;
			document.querySelector(`#${menuID}`).classList.toggle('active');
		});
	});
});
