function shiftedDiff(first, second) {
    let splitted = first.split('')
    let interations = 0;
    while (splitted.join('') !== second) {
        if(interations > splitted.length) {
            return -1
        }
        splitted.unshift(splitted.pop())
        interations += 1  
    }
    return interations
}

console.log(shiftedDiff('moose', 'Moose'))