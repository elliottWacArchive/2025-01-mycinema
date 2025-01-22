async function getMovie(date1, date2) {
	const response = await fetch(`../../sources/user-interface/getMovie.php?date1=${date1}&date2=${date2}`);
	const data = await response.text();
	return data;
}

async function getPoster($name, $id) {
	const key = '6bf02cf0';
	const img = document.getElementById($id).getElementsByTagName('img')[0];
	const url = `https://www.omdbapi.com/?t=${$name}&apikey=${key}`;
	fetch(url)
	.then(response => response.json())
	.then(data => {
		img.src = data.Poster;
	});
}

document.addEventListener('DOMContentLoaded', async function() {
	document.getElementById('movie-container').innerHTML = await getMovie('2018-01-01', '2018-01-03');
	for (let i = 0; i < document.getElementsByClassName('movie-card').length; i++) {
		let card = document.getElementsByClassName('movie-card')[i];
		let id = card.id;
		let name = card.getElementsByClassName('movie-title')[0].innerText;
		await getPoster(name, id);
	}
});