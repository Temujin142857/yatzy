let currentPage = 1;
const rowsPerPage = 10;
let leaderboardData = [];

document.addEventListener('DOMContentLoaded', () => {
    fetchLeaderboard();
});

function fetchLeaderboard() {
    fetch('http://localhost/get_leaderboard.php')
        .then(response => response.json())
        .then(data => {
            leaderboardData = data;
            renderLeaderboard();
        })
        .catch(error => {
            renderLeaderboard();
            console.error('Error fetching leaderboard:', error);
        });
}

function renderLeaderboard() {
    const leaderboardBody = document.querySelector('#leaderboard tbody');
    leaderboardBody.innerHTML = '';

    if (leaderboardData.length === 0) {
        document.getElementById('no-data').style.display = 'block';
        document.getElementById('pagination').style.display = 'none';
        return;
    } else {
        document.getElementById('no-data').style.display = 'none';
        document.getElementById('pagination').style.display = 'flex';
    }

    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = leaderboardData.slice(start, end);

    pageData.forEach((player, index) => {
        const row = document.createElement('tr');

        const rankCell = document.createElement('td');
        rankCell.textContent = start + index + 1;
        row.appendChild(rankCell);

        const nameCell = document.createElement('td');
        nameCell.textContent = player.player_name;
        row.appendChild(nameCell);

        const scoreCell = document.createElement('td');
        scoreCell.textContent = player.highest_score;
        row.appendChild(scoreCell);

        leaderboardBody.appendChild(row);
    });

    updatePagination();
}

function updatePagination() {
    const totalPages = Math.ceil(leaderboardData.length / rowsPerPage);
    document.getElementById('page-number').textContent = `Page ${currentPage}`;
    document.getElementById('prev').disabled = currentPage === 1;
    document.getElementById('next').disabled = currentPage === totalPages;
}

function nextPage() {
    currentPage++;
    renderLeaderboard();
}

function prevPage() {
    currentPage--;
    renderLeaderboard();
}
