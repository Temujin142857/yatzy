
class YatzyGame {
    constructor() {
        this.rolls = 0;
        this.dice = [0, 0, 0, 0, 0];
        this.keep = [false, false, false, false, false];
        this.score=0;
        this.scoreCard = {ones:0, twos:0, threes:0, fours:0, fives:0, sixes:0, three_of_a_kind:0, four_of_a_kind:0, full_house:0, small_straight:0, large_straight:0, yatzee:0, chance:0};
    }

    roll() {
        if (this.rolls < 3) {
            for (let i = 0; i < this.dice.length; i++) {
                if (!this.keep[i]) {
                    this.dice[i] = rollDie();
                }
            }
            this.rolls++;
        }
    }

    toggleKeep(index) {
        if (index >= 0 && index < this.dice.length) {
            this.keep[index] = !this.keep[index];
        }
    }

    reset() {
        this.rolls = 0;
        this.dice = [0, 0, 0, 0, 0];
        this.keep = [false, false, false, false, false];
        this.scoreCard = {ones:0, twos:0, threes:0, fours:0, fives:0, sixes:0, three_of_a_kind:0, four_of_a_kind:0, full_house:0, small_straight:0, large_straight:0, yatzee:0, chance:0};
        this.score=0;
    }

    turnReset(){
        this.rolls = 0;
        this.dice = [0, 0, 0, 0, 0];
        this.keep = [false, false, false, false, false];
    }

    getGameState() {
        return {
            rolls: this.rolls,
            dice: this.dice,
            keep: this.keep,
            scoreCard: this.scoreCard
        };
    }
}
