function updateScore(game){
    let topScore=0;
    let bonus=0;
    let bottomScore=0;
    for (const box in game.scoreBoxes){
        switch (box.name){
            case "ones":
                topScore+=box.score;
                break;
            case "twos":
                topScore+=box.score;
                break;
            case "threes":
                topScore+=box.score;
                break;
            case "fours":
                topScore+=box.score;
                break;
            case "fives;":
                topScore+=box.score;
                break;
            case "sixes":
                topScore+=box.score;
                break;
            default:
                bottomScore+=box.score;
        }
    }
    if(topScore>=63){bonus=35;}
    return topScore+bonus+bottomScore;
}


function scoreTurn(game, scoreBox){
    switch (scoreBox) {
        case "ones":
            return numberScore(game.dice, 1);
            break;
        case "twos":
            return numberScore(game.dice, 2);
            break;
        case "threes":
            return  numberScore(game.dice, 3);
            break;
        case "fours":
            return numberScore(game.dice, 4);
            break;
        case "fives;":
            return numberScore(game.dice, 5);
            break;
        case "sixes":
            return numberScore(game.dice, 6);
            break;
        case "three_of_a_kind":
            return threeOfaKind(game.dice);
            break;
        case "four_of_a_kind":
            return fourOfaKind(game.dice);
            break;
        case "full_house":
            return fullHouse(game.dice);
            break;
        case "small_straight":
            return straight(game.dice,4);
            break;
        case "large_straight":
            return straight(game.dice,5);
            break;
        case "yatzee":
            return fiveOfaKind(game.dice);
            break;
        case "chance":
            let score=0;
            for (const die in game.dice) {
                score+=die;
            }
            return score;
            break;
    }
}

function numberScore(dice, number){
    let score=0;
    for (const die in dice) {
        if(die===number){
            score+=number;
        }
    }
    return score;
}

function straight(dice, num){
    if(straightCheck(dice, dice[0])>=num){
        return num===3? 30:40;
    }
    else return 0;

}

function straightCheck(dice, die){
    let num=0;
    if(dice.includes(die+1)){
        num+=straightCheck(dice.filter(function(d){return d===die+1}),die+1);
    }
    else if(dice.includes(die-1)){
        num+=straightCheck(dice.filter(function(d){return d===die-1}),die-1);
    }
    return num;
}

function threeOfaKind(dice){
    return numberScore(dice, 3);
}

function fourOfaKind(dice){
    return numberScore(dice, 4);
}

function fiveOfaKind(dice){
    return numberScore(dice, 5)>0? 50:0;
}

function numOfaKind(dice, num){
    let goodCount=false;
    let score=0;
    const dieMap=dieMapper(dice);
    dieMap.forEach(function(value, key){
        score+=key;
        if(value>=num)goodCount=true;
    });
    return goodCount? score:0;
}

function fullHouse(dice){
    let pair=false;
    let three=false;
    const dieMap=dieMapper(dice);
    dieMap.forEach(function(value, key){
        if(value===2)pair=true;
        else if(value===3)three=true;
    });
    return (three&&pair)? 25:0;
}

function dieMapper(dice){
    const dieMap= new Map();
    for (const die in dice){
        if(!dieMap.has(die)){
            dieMap.set(die,1);
        }else{
            dieMap.set(die,dieMap.get(die)+1);
        }
    }
    return dieMap;
}