// Define colors for the pie chart
var barColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
];

// Initialize empty arrays for x and y values
let xValues = [], yValues = [];
let total = document.getElementById("total");


// Function to update the chart with new data
function updateChart(xValues, yValues) {
    new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Statistics des audios"
            }
        }
    });
}

// Function to fetch data and update the chart
async function getData() {
    const url = "/statisticdata";
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const message = await response.json();
        xValues = message["xValues"];
        yValues = message["yValues"];
        total.textContent = message["total"]
        return message;
    } catch (error) {
        console.error(error.message);
        return null;
    }
}

// Function to handle the display of messages and update chart
async function displayMessage() {
    const message = await getData();
    if (message) {
        console.log("Data retrieved successfully");
        updateChart(xValues, yValues); // Update the chart with the fetched data
    }
}

// Add event listener to update the chart once the DOM is fully loaded
document.addEventListener('DOMContentLoaded', displayMessage);
