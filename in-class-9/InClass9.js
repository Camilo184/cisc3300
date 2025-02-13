function pinecone(string) {
    console.log(string)
    console.log(string.includes("pinecone").toString())
    return string.includes("pinecone");
}

const sentenceArr = [" this sentence does include the word pinecone"]

const filteredSentences = sentenceArr.filter(pinecone);

console.log(filteredSentences);
