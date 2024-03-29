// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
// Fungsi untuk menghasilkan warna acak
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
// Pie Chart Example
fetch('/getIncomeByCategory')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Tangani respons dari backend
        var categoryPromises = data.map(item => {
            return getCategoryName(item.category_id)
                .then(categoryName => {
                    return {
                        label: categoryName,
                        value: item.total
                    };
                });
        });
        return Promise.all(categoryPromises);
    })
    .then(categoryData => {
        // Menghasilkan warna acak untuk setiap kategori
        var randomColors = categoryData.map(() => getRandomColor());

        var ctx = document.getElementById("incomePieCharts");
        var incomePieCharts = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: categoryData.map(item => item.label),
                datasets: [{
                    data: categoryData.map(item => item.value),
                    backgroundColor: randomColors,
                    hoverBackgroundColor: randomColors.map(color => shadeColor(color, -10)), // Menjadikan warna lebih gelap saat hover
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
        // Tambahkan label tambahan ke dalam div
        var additionalLabelsDiv = document.getElementById('additionalLabels');
        categoryData.forEach((item, index) => {
            var labelSpan = document.createElement('span');
            labelSpan.classList.add('mr-2');
            labelSpan.innerHTML = `<i class="fas fa-circle" style="color: ${randomColors[index]}"></i> ${item.label}`;
            additionalLabelsDiv.appendChild(labelSpan);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

// Fungsi untuk menghasilkan warna acak
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

// Fungsi untuk menggelapkan atau mencerahkan warna
function shadeColor(color, percent) {
    var num = parseInt(color.slice(1), 16),
        amt = Math.round(2.55 * percent),
        R = (num >> 16) + amt,
        G = (num >> 8 & 0x00FF) + amt,
        B = (num & 0x0000FF) + amt;
    return "#" + (0x1000000 + (R < 255 ? (R < 1 ? 0 : R) : 255) * 0x10000 + (G < 255 ? (G < 1 ? 0 : G) : 255) * 0x100 + (B < 255 ? (B < 1 ? 0 : B) : 255)).toString(16).slice(1);
}

function getCategoryName(categoryId) {
    return fetch(`/getCategoryName/${categoryId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => data.name)
        .catch(error => {
            console.error('Error:', error);
            return "Kategori Tidak Dikenal";
        });
}

