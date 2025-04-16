/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */
const barConfig = {
    type: "bar",
    data: {
        labels: ["January", "February"],
        datasets: [
            {
                label: "Shoes",
                backgroundColor: "#0694a2",
                borderWidth: 1,
                data: [-3, 14],
            },
            {
                label: "Bags",
                backgroundColor: "#7e3af2",
                borderWidth: 1,
                data: [66, 33],
            },
        ],
    },
    options: {
        indexAxis: "y", // 👈 ESTO GIRA EL GRÁFICO A HORIZONTAL
        responsive: true,
        plugins: {
            legend: {
                display: false,
            },
        },
        scales: {
            x: {
                ticks: {
                    beginAtZero: true,
                },
            },
            y: {
                ticks: {
                    autoSkip: false,
                },
            },
        },
    },
};

const barsCtx = document.getElementById("bars");
window.myBar = new Chart(barsCtx, barConfig);
