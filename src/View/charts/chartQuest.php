<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="http://localhost/mini_forms/src/Libs/fonts/Helvetica/style.css">
    <style>
        * {
            font-family: "Helvetica", Arial, sans-serif;
        }

        #box-dash {
            display: grid;
            grid-template-columns: 70% 30%;
        }

        #box-panel {
            display: grid;
            grid-auto-rows: 70% 15%;
        }

        #options {
            display: grid;
            grid-template-rows: repeat(2, 40px 60px);
            justify-items: center;
            align-items: center;
        }

        #options select {
            border: none;
            outline: none;
            padding: 5px;
            font-size: 20px;
            border-radius: 5px;
            background-color: #1D3557;
            color: #fff;
        }

        #options label {
            border-bottom: 2px solid #1D3557;
        }

        .box-message__button {
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 18px;
            background-color: #1D3557;
            color: #fff;
            cursor: pointer;
        }

        .box-message__button:hover {
            background-color: #457B9D;
            color: #fff;
        }

        .box-message__button:active {
            background-color: #F1FAEE;
            color: #1D3557;
        }
    </style>
</head>
<body>

<div id="box-dash">
    <div id="box-charts__complete-forms"></div>
    <div id="box-panel">
        <div id="options">
            <label for="box-panel__option-forms">Selecciona el formulario</label>
            <select id="box-panel__option-forms">
            </select>
            <label for="box-panel__option-quest">Selecciona la pregunta</label>
            <select id="box-panel__option-quest">
            </select>
        </div>
        <button class="box-message__button" id="box-panel__button-update">Visualizar</button>
    </div>
</div>

<script>

    let chart;

    async function getQuets(idQuest) {
        return await fetch("http://localhost/mini_forms/request/?req=charting_answers", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({idQuest})
        }).then(quest => quest.json());
    }

    async function loadForms() {
        const formularios = await fetch('http://localhost/mini_forms/request/?req=get_forms').then(forms => forms.json());
        return formularios.valueOf();
    }


    async function getTypeQuest(idForm) {
        return await fetch("http://localhost/mini_forms/request/?req=quest_type", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({idForm})
        }).then(types => types.json())
    }

    document.addEventListener('DOMContentLoaded', async () => {
        let forms = await loadForms();
        const options = document.getElementById('box-panel__option-forms');
        const quests = document.getElementById('box-panel__option-quest');
        for (let i = 0; i < forms.length; i++) {
            const option = document.createElement('option');
            option.value = forms[i]['id_form'];
            option.innerText = forms[i]['title_form'];
            options.appendChild(option);
        }

        // render();
        options.onchange = () => renderQuest();

        let typeQuest = await getTypeQuest(forms[0]['id_form']);
        for (let i = 0; i < typeQuest.length; i++) {
            const option = document.createElement('option');
            option.innerText = typeQuest[i]['description_question'];
            option.value = typeQuest[i]['id_question'];
            quests.appendChild(option);
        }

        const btn = document.getElementById('box-panel__button-update');
        btn.onclick = async () => await reRender();

        await reRender();
    });

    async function reRender() {
        console.log('hola')
        const quests = document.getElementById('box-panel__option-quest');
        let dataQuest = await getQuets(quests.value);
        let labels = [];
        let amounts = [];
        for (let i = 0; i < dataQuest.length; i++) {
            labels.push([dataQuest[i]['options_text']]);
            amounts.push(dataQuest[i]['options_count']);
        }
        render(labels, amounts);
    }

    async function renderQuest() {
        const forms = document.getElementById('box-panel__option-forms');
        const quests = document.getElementById('box-panel__option-quest');
        const content = quests.parentElement;
        quests.remove();
        const newQuest = document.createElement('select');
        newQuest.id = 'box-panel__option-quest';
        content.appendChild(newQuest);
        let typeQuest = await getTypeQuest(forms.value);
        for (let i = 0; i < typeQuest.length; i++) {
            const option = document.createElement('option');
            option.innerText = typeQuest[i]['description_question'];
            option.value = typeQuest[i]['id_question'];
            newQuest.appendChild(option);
        }
    }

    function render(labels, amounts) {
        let options = {
            series: [{
                // data: [21, 22, 10, 28, 16, 21, 13, 30]
                data: amounts
            }],
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function (chart, w, e) {
                    }
                }
            },
            colors: ['#218380', '#8f2d56', '#ffbc42', '#d81159', '#6a4c93', '#8ac926', '#ff90b3', '#EF7A85'],
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                    distributed: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                // categories: [
                //     ['Sistemas', 'Computacionales'],
                //     ['Electromecánica'],
                //     ['Telecomunicaciones'],
                //     ['Arquitectura'],
                //     ['Logística'],
                //     ['Alimentarias'],
                //     ['Gestión Empresarial'],
                //     ['Industrial'],
                // ],
                categories: labels,
                labels: {
                    style: {
                        colors: ['#000'],
                        fontSize: '16px'
                    }
                }
            }
        };

        chart = new ApexCharts(document.querySelector("#box-charts__complete-forms"), options);
        chart.render();
    }
</script>

</body>
</html>
