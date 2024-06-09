
class YatzyGame {
    constructor() {
        this.rolls = 0;
        this.dice = [0, 0, 0, 0, 0];
        this.keep = [false, false, false, false, false];
    }

    roll() {
        if (this.rolls < 3) {
            for (let i = 0; i < this.dice.length; i++) {
                if (!this.keep[i]) {
                    this.dice[i] = rollDice();
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
    }

    getGameState() {
        return {
            rolls: this.rolls,
            dice: this.dice,
            keep: this.keep
        };
    }
}
