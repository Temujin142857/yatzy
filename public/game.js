document.addEventListener('DOMContentLoaded', () => {
    fetchGameState();
    fetchLeaderboard();
});

let currentPage = 1;
const rowsPerPage = 10;
let leaderboardData = [];

function fetchGameState() {
    fetch('update_game_state.php')
        .then(response => response.json())
        .then(data => updateGameState(data));
}


function startGame() {
    fetch('start_game.php')
        .then(response => response.json())
        .then(data => updateGameState(data));
}


function rollDice() {
    fetch('roll_dice.php')
        .then(response => response.json())
        .then(data => updateGameState(data));
}


function scoreCategory(category) {
    fetch('calculate_score.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ category: category })
    })
    .then(response => response.json())
    .then(data => updateGameState(data));
}


function updateLeaderboardWithNewScore(score, player = 'Anonymous') {
    fetch('update_leaderboard.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ score: score, player: player })
    })
    .then(response => response.json())
    .then(data => updateLeaderboard(data));
}


function updateGameState(data) {
   
  
    document.getElementById('die-1').innerText = data.dice[0];
    document.getElementById('die-2').innerText = data.dice[1];
    document.getElementById('die-3').innerText = data.dice[2];
    document.getElementById('die-4').innerText = data.dice[3];
    document.getElementById('die-5').innerText = data.dice[4];
    document.getElementById('remaining_rolls').innerText = data.rolls;
    document.getElementById('total_score').innerText = data.total_score;

   
    for (let category in data.scores) {
        document.getElementById(`score_${category}`).innerText = data.scores[category] !== null ? data.scores[category] : '-';
    }
}


function updateLeaderboard(data) {
    let leaderboardDiv = document.getElementById('leaderboard');
    leaderboardDiv.innerHTML = '';
    data.forEach((entry, index) => {
        leaderboardDiv.innerHTML += `<p>${index + 1}. ${entry.player}: ${entry.score}</p>`;
    });
}
