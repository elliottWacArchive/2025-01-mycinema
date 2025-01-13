function searchUser() {
	const select = document.getElementById('selectName').value;
	const name = document.getElementById('name').value.trim();
    fetch(`functions/listUser.php?${select}=${name}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('userResults').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
}

function searchMovie() {
	const select = document.getElementById('selectMovie').value;
	const movie = document.getElementById('movie').value;
	fetch(`functions/listMovie.php?${select}=${movie}`)
		.then(response => response.text())
		.then(data => {
			document.getElementById('movieResults').innerHTML = data;
		})
		.catch(error => console.error('Error:', error));
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
	if (document.querySelector('#userManager h2').id) {
		userId = document.querySelector('#userManager h2').id;
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
	if (document.querySelector('#userManager h2').id) {
		userId = document.querySelector('#userManager h2').id;
	} else {
		alert('Please select a user first');
		return;
	}
	console.log(userId);
	fetch(`functions/viewLog.php?id=${userId}`)
	.then(response => response.text())
	.then(data => {
		document.getElementById('log').innerHTML = data;
	})
	.catch(error => console.error('Error:', error));
}

function searchSubscription(id) {
	document.querySelector('#userManager h2').innerHTML = 'User id : ' + id;
	document.querySelector('#userManager h2').id = id;
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
		document.getElementById('firstname').innerHTML = "Firstname : " + firstname;
		document.getElementById('lastname').innerHTML = "Lastname : " + lastname;
		document.getElementById('email').innerHTML = "Email : " + email;
		document.getElementById('zipcode').innerHTML = "Zipcode : " + zipcode;
		document.getElementById('city').innerHTML = "City : " + city;
		document.getElementById('address').innerHTML = "Address : " + address;
		document.getElementById('country').innerHTML = "Country : " + country;
		searchSubscription(id);
	} else if (event.target.classList.contains('movie')) {
		let id = event.target.id;
		const title = await getMovie(id, 'title');
		const director = await getMovie(id, 'director');
		const genre = await getMovie(id, 'genre');
		const release = await getMovie(id, 'release_date');
		const rating = await getMovie(id, 'rating');
		const duration = await getMovie(id, 'duration');
		document.querySelector('#movieManager h2').innerHTML = 'Movie id : ' + id;
		document.getElementById('title').innerHTML = "Title : " + title;
		document.getElementById('director').innerHTML = "Director : " + director;
		document.getElementById('genre').innerHTML = "Genre : " + genre;
		document.getElementById('date').innerHTML = "Date : " + release;
		document.getElementById('rating').innerHTML = "Rating : " + rating;
		document.getElementById('duration').innerHTML = "Duration : " + duration;
	}
});
