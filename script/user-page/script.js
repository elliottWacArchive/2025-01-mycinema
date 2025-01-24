async function getMovie(date1, date2) {
	const response = await fetch(`../../sources/user-interface/getMovie.php?date1=${date1}&date2=${date2}`);
	const data = await response.text();
	return data;
}

async function getPoster($name, $id) {
	const key = '6bf02cf0';
	const img = document.getElementById($id).getElementsByClassName('movie-img')[0];
	const url = `https://www.omdbapi.com/?t=${$name}&apikey=${key}`;
	fetch(url)
	.then(response => response.json())
	.then(data => {
		img.style.backgroundImage = `url('${data.Poster}')`;
	});
}

async function getNewPoster($name, $id) {
	const key = '6bf02cf0';
	const img = document.getElementById($id);
	const url = `https://www.omdbapi.com/?t=${$name}&apikey=${key}`;
	fetch(url)
	.then(response => response.json())
	.then(data => {
		img.style.backgroundImage = `url('${data.Poster}')`;
	});
}

function cc(param) {
	console.log(param);
}

document.addEventListener('DOMContentLoaded', async function() {
	document.getElementById('movie-container').innerHTML = await getMovie('2018-01-01', '2018-01-03');
	for (let i = 0; i < document.getElementsByClassName('movie-card').length; i++) {
		let card = document.getElementsByClassName('movie-card')[i];
		card.id = i;
		let name = card.getElementsByClassName('movie-title')[0].innerText;
		await getPoster(name, i);
	}
});

document.addEventListener('DOMContentLoaded', async function() {
	document.addEventListener('click', async function (event) {
		if (event.target.classList.contains('select-movie')) {
			const movieId = event.target.id;
			window.location.href = `moviePage.php?id=${movieId}`;
		}
	});
});

async function updateDate() {
	const date1 = document.getElementById('date1').value;
	const date2 = document.getElementById('date2').value;
	document.getElementById('movie-container').innerHTML = await getMovie(date1, date2);
	for (let i = 0; i < document.getElementsByClassName('movie-card').length; i++) {
		let card = document.getElementsByClassName('movie-card')[i];
		let id = card.id;
		let name = card.getElementsByClassName('movie-title')[0].innerText;
		await getPoster(name, id);
	}
	
}

document.addEventListener('click', async function (event) {
	const userId = document.getElementById('idSelector').innerText;
	if (event.target.id === 'firstnameValidation') {
		const firstname = document.getElementById('firstname').value;
		const response = await fetch(`../../functions/user-interface/changeUser.php?id=${userId}&option=firstname&value=${firstname}`);
		const data = await response.text();
		document.getElementById('alert').innerHTML = data;
	} else if (event.target.id === 'lastnameValidation') {
		const lastname = document.getElementById('lastname').value;
		const response = await fetch(`../../functions/user-interface/changeUser.php?id=${userId}&option=lastname&value=${lastname}`);
		const data = await response.text();
		document.getElementById('alert').innerHTML = data;
	} else if (event.target.id === 'mailValidation') {
		const email = document.getElementById('mail').value;
		const response = await fetch(`../../functions/user-interface/changeUser.php?id=${userId}&option=email&value=${email}`);
		const data = await response.text();
		document.getElementById('alert').innerHTML = data;
	} else if (event.target.id === 'passwordValidation') {
		const password = document.getElementById('password').value;
		const response = await fetch(`../../functions/user-interface/changeUser.php?id=${userId}&option=password&value=${password}`);
		const data = await response.text();
		document.getElementById('alert').innerHTML = data;
	}
});