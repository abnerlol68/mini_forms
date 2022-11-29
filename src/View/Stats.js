async function getData() {
    return await fetch("http://localhost/mini_forms/request/?req=charting").then(data => data.json());
}

document.addEventListener('DOMContentLoaded', async () => {
    let info = await getData();
    console.log(info)
});


// let dataJson = {};
// let dataClean = [];

// document.addEventListener('DOMContentLoaded', async () => {
//     let dataCrude = await getData();
//     dataClean = [];
//     let dataString = "";
//     for (let i = 0; i < dataCrude.length; i++) {
//         dataClean.push(dataCrude[i][1]);
//         dataString += dataCrude[i][1].toString().concat(',');
//     }
//
//     dataJson = {...dataClean};
//     console.log(dataJson);
//     console.log(dataClean);
//     // const contaiterToData = document.getElementById('data-charts-crude');
//     // contaiterToData.innerText = dataString;
// });