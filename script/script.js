let currentPage = 1;
const resultsPerPage = 30;
let totalResults = 0;
let currentId = null;

window.addEventListener('load', function() {
    var userManager = document.getElementById('userManager');
    var userResults = document.getElementById('userResults');
	var movieManager = document.getElementById('movieManager');
	var movieResults = document.getElementById('movieResults');
    userResults.style.height = userManager.offsetHeight + 'px';
	userResults.style.maxHeight = userManager.offsetHeight + 'px';
	movieResults.style.height = movieManager.offsetHeight + 'px';
	movieResults.style.maxHeight = movieManager.offsetHeight + 'px';
});

function addMovie() {
	if (currentId === null) {
		alert("Select a session first!");
		return;
	}
	let userId = document.querySelector('#userManager h3').id;
	fetch(`functions/addSession.php?id=${currentId}&userid=${userId}`)
        .then(response => response.text())
        .then(data => {
			console.log(data);
			viewLog();
        })
        .catch(error => console.error('Error:', error));
	currentId = null;
}

function searchUser(page = 0) {
    const select = document.getElementById('selectName').value;
    const name = document.getElementById('name').value.trim();
	if (page == 0) {
		page = 1;
		currentPage = 1;
	}
    fetch(`functions/listUser.php?${select}=${name}&page=${page}&resultsPerPage=${resultsPerPage}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('userResults').innerHTML = data.users.join('');
            totalResults = data.totalResults;		
            updateCurrentPageDisplay();
            updatePaginationButtons();
        })
        .catch(error => console.error('Error:', error));
}

function nextPage() {
    if (currentPage * resultsPerPage < totalResults) {
        currentPage++;
        searchUser(currentPage);
    }
}

async function getPoster(id) {
	const title = (await getMovie(id, 'title')).replace(/ /g, '+');
	const key = '6bf02cf0';
	const imageSection = document.getElementById('imgSection');
	console.log(title);
	const url = `https://www.omdbapi.com/?t=${title}&apikey=${key}`;
	fetch(url)
	.then(response => response.json())
	.then(data => {
		console.log(data.Poster);
		imgSection.style.display = 'block';
		imageSection.src = data.Poster;
	})
}

function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        searchUser(currentPage);
    }
}

function updateCurrentPageDisplay() {
    document.getElementById('curUser').innerText = `Page: ${currentPage}`;
}

function updatePaginationButtons() {
    document.getElementById('prevUser').style.display = currentPage > 1 ? 'inline-block' : 'none';
    document.getElementById('nextUser').style.display = currentPage * resultsPerPage < totalResults ? 'inline-block' : 'none';
}

function searchMovie(page = 0) {
    const select = document.getElementById('selectMovie').value;
    const movie = document.getElementById('movie').value.trim();
	if (page == 0) {
		page = 1;
		currentPage = 1;
	}
    fetch(`functions/listMovie.php?${select}=${movie}&page=${page}&resultsPerPage=${resultsPerPage}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('movieResults').innerHTML = data.movies.join('');
            totalResults = data.totalResults;
            updateCurrentPageDisplayMovie();
            updatePaginationButtonsMovie();
        })
        .catch(error => console.error('Error:', error));
}

function nextPageMovie() {
    if (currentPage * resultsPerPage < totalResults) {
        currentPage++;
        searchMovie(currentPage);
    }
}

function prevPageMovie() {
    if (currentPage > 1) {
        currentPage--;
        searchMovie(currentPage);
    }
}

function updateCurrentPageDisplayMovie() {
    document.getElementById('curMovie').innerText = `Page: ${currentPage}`;
}

function updatePaginationButtonsMovie() {
    document.getElementById('prevMovie').style.display = currentPage > 1 ? 'inline-block' : 'none';
    document.getElementById('nextMovie').style.display = currentPage * resultsPerPage < totalResults ? 'inline-block' : 'none';
}

async function getMovie(id, option) {
	let data = '';
	try {
		const response = await fetch(`functions/getMovie.php?id=${id}&option=${option}`);
		data = await response.text();
	} catch (error) {
		console.error('Error fetching movie:', error);
	}
	return data;
}

async function getUser(id, option) {
	let data = '';
	try {
		const response = await fetch(`functions/getUser.php?id=${id}&option=${option}`)
		data = await response.text();
	} catch (error) {
		console.error('Error fetching movie:', error);
	}
	return data;
}

function changeSubscription() {
	if (document.querySelector('#userManager h3').id) {
		userId = document.querySelector('#userManager h3').id;
	} else {
		alert('Please select a user first');
		return;
	}
	console.log(userId);
	const select = document.getElementById('selectSubscription').value;
	let subId = 0;
	if (select == "none") {
		subId = 0;
	} else if (select == "VIP") {
		subId = 1;
	} else if (select == "GOLD") {
		subId = 2;
	} else if (select == "Classic") {
		subId = 3;
	} else if (select == "Passday") {
		subId = 4;
	}
	fetch(`functions/editSub.php?id=${userId}&sub=${subId}`)
	.then(response => response.text())
	.then(data => {
		console.log(data);
		searchSubscription(userId);
	})
	.catch(error => console.error('Error:', error));
}

function viewLog() {
	if (document.querySelector('#userManager h3').id) {
		userId = document.querySelector('#userManager h3').id;
	} else {
		alert('Please select a user first');
		return;
	}
	fetch(`functions/viewLog.php?id=${userId}`)
	.then(response => response.text())
	.then(data => {
		if (data == "0 results") {
			document.getElementById('log').innerHTML = data;
			return;
		} else {
			document.getElementById('log').innerHTML = "<table></table>";
			document.querySelector('#log table').innerHTML = "<tr><th>title</th><th>date</th></tr>" + data;
		}
	})
	.catch(error => console.error('Error:', error));
}

function viewSession() {
	if (document.querySelector('#movieManager h3').id) {
		userId = document.querySelector('#movieManager h3').id;
	} else {
		alert('Please select a movie first');
		return;
	}
	fetch(`functions/viewSession.php?id=${userId}`)
	.then(response => response.text())
	.then(data => {
		if (data == "0 results") {
			document.getElementById('session').innerHTML = data;
			return;
		} else {
			document.getElementById('session').innerHTML = "<table></table>";
			document.querySelector('#session table').innerHTML ="<tr><th>selection</th><th>number</th><th>room</th><th>date</th><th>floor</th><th>seats</th></tr>" + data;
		}
	})
	.catch(error => console.error('Error:', error));
}

function viewSessionCreator() {
	document.getElementById('makeSession').style.display = "block";
}

function createSession() {
	const room = document.getElementById('selectRoom').value;
	const date = document.getElementById('dateSession').value;
	const time = document.getElementById('timeSession').value;
	const movieId = document.querySelector('#movieManager h3').id;
	if (date == "" || time == "") {
		alert('Please fill all the fields');
		return;
	}
	fetch(`functions/createSession.php?room=${room}&date=${date}&time=${time}&movieId=${movieId}`)
	.then(response => response.text())
	.then(data => {
		console.log(data);
		viewSession();
	})
}

function searchSubscription(id) {
	document.querySelector('#userManager h3').innerHTML = 'User id : ' + id;
	document.querySelector('#userManager h3').id = id;
	fetch(`functions/getSub.php?id=${id}`)
	.then(response => response.text())
	.then(data => {
		document.getElementById('subInfo').innerHTML = "Subscription information : " + data;
	})
	.catch(error => console.error('Error:', error));
}

document.addEventListener('click', async function (event) {
	if (event.target.classList.contains('user')) {
		let id = event.target.id;
		const firstname = await getUser(id, 'firstname');
		const lastname = await getUser(id, 'lastname');
		const email = await getUser(id, 'email');
		const zipcode = await getUser(id, 'zipcode');
		const city = await getUser(id, 'city');
		const address = await getUser(id, 'address');
		const country = await getUser(id, 'country');
		const birthdate = await getUser(id, 'birthdate');
		document.querySelector('#firstname .text-result').innerHTML = firstname;
		document.querySelector('#lastname .text-result').innerHTML = lastname;
		document.querySelector('#email .text-result').innerHTML = email;
		document.querySelector('#zipcode .text-result').innerHTML = zipcode;
		document.querySelector('#city .text-result').innerHTML = city;
		document.querySelector('#address .text-result').innerHTML = address;
		document.querySelector('#country .text-result').innerHTML = country;
		document.querySelector('#birthdate .text-result').innerHTML = birthdate;
		searchSubscription(id);
	} else if (event.target.classList.contains('movie')) {
		let id = event.target.id;
		const img = await getPoster(id);
		const title = await getMovie(id, 'title');
		const director = await getMovie(id, 'director');
		const genre = await getMovie(id, 'genrename');
		const release = await getMovie(id, 'release_date');
		const rating = await getMovie(id, 'rating');
		const duration = await getMovie(id, 'duration');
		const distributor = await getMovie(id, 'distname');
		document.querySelector('#movieManager h3').innerHTML = 'Movie id : ' + id;
		document.querySelector('#movieManager h3').id = id;
		document.querySelector('#title .text-result').innerHTML = title;
		document.querySelector('#director .text-result').innerHTML = director;
		document.querySelector('#genre .text-result').innerHTML = genre;
		document.querySelector('#date .text-result').innerHTML = release;
		document.querySelector('#rating .text-result').innerHTML = rating;
		document.querySelector('#duration .text-result').innerHTML = duration;
		document.querySelector('#distributor .text-result').innerHTML = distributor;
	} else if (event.target.classList.contains('movie-lign')) {
		currentId = event.target.id;
		const movieLigns = document.querySelectorAll('.movie-lign');
		movieLigns.forEach(e => {
			e.style.backgroundColor = "";
			e.style.color = "";
			e.innerText = "Select";
		});
		event.target.style.backgroundColor = "red";
		event.target.style.color = "black";
		event.target.innerText = "Selected";
	}
});
