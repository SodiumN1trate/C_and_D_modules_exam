function replaceStrings(sentence, replacements) {
    replacements.forEach(par => {
        par.forEach(child => {
            if(typeof child == 'object') {
                sentence = sentence.replace(child[0], child[1])
                
            } else {
                sentence = sentence.replace(par[0], par[1])
            }
        });
    });
    return sentence
}

console.log(replaceStrings('Hello, World!', [[['Hello', 'Hey'], ['Hey', 'Hi']], ["World", "Universe"]]))
