/*
*draw bar chart for in and out stock or moth
find to div id chartExportInMonth
*/
const chartExportInMonth = document.getElementById('chartExportInMonth');

new Chart(chartExportInMonth, {
    type: 'bar',
    data: {
        labels: ['Ngày 01', 'Ngày 02', 'Ngày 03', 'Ngày 04', 'Ngày 05'],
        datasets: [
            {
                label: 'Đơn nhập 01-08-2025',
                data: [120, 150, 180, 90, 200],
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
            },
            {
                label: 'Đơn xuất 01-08-2025',
                data: [100, 140, 160, 120, 250],
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
            }
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
/**
 * draw pie chart for rate of in and out stock per month
 * find to div id areaImportExportRatioMonth
 */
const _chartImportExportRatioMonth = document.getElementById('chartImportExportRatioMonth');

new Chart(_chartImportExportRatioMonth, {
    type: 'pie',
    data: {
        labels: [
            'Đơn Nhập',
            'Đơn Xuất'
        ],
        datasets: [{
            label: 'thống kê tỉ lệ nhâp xuất trong tháng',
            data: [300, 50, 100],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    },
});
/**
 * draw line chart for interest rate 
 * find to div id chartInterestRate
 */
const chartInterestRate = document.getElementById('chartInterestRate');

new Chart(chartInterestRate, {
    type: 'line',
    data: {
        labels: ['Ngày 01', 'Ngày 02', 'Ngày 03', 'Ngày 04', 'Ngày 05', 'Ngày 06', 'Ngày 07'],
        datasets: [
            {
                label: 'lãi suất.',
                data: [120, 150, 180, 90, 200, 170, 250],
                backgroundColor:  'rgba(255, 99, 132, 0.7)',
                fill : false,
                borderColor: 'rgba(255, 99, 132, 1)',
                tension: 0.1
            },
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
/*
 * draw bar chart for product category
 * find to div id chartProductCategory
 */
const chartProductCategory = document.getElementById('chartProductCategory');

new Chart(chartProductCategory, {
    type: 'bar',
    data: {
        labels: ['laptop','pc', 'Điện thoại', 'Ti vi', 'phụ kiện'],
        datasets: [{
            label: 'Tổng đơn theo danh mục.',
            data: [120, 150, 180, 90],
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});