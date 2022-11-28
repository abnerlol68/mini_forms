async function getData(){
    return await fetch("request/?req=charting").then(data => data.json());
}

document.addEventListener('DOMContentLoaded', async () => {
    let dataRecovered = await getData();
    console.log(dataRecovered);
});