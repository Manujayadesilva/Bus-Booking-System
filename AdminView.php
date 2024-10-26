<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Tickets Booking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Bootstrap Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <style>
        .bus-icon {
            width: 50px; 
            height: 50px;
            margin-right: 10px;
        }
        .travelling-aid {
            font-size: 2em; 
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header class="navbar navbar-dark bg-dark">
        <div class="container">
             <img src="bus icon.webp" alt="Bus Icon" class="bus-icon">
             <span class="text-white travelling-aid">Voyage Facile</span>
             <h1 class="text-white">(Admin View)</h1>
        </div>
    </header>

    <div class="container mt-4">
        <form id="searchForm">
            <div class="form-group">
                <label for="busType">Bus Name</label>
                <select class="form-control" id="busType">
                    
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="text" class="form-control" id="date" placeholder="YYYY/MM/DD" autocomplete="off">
            </div>
            <button type="button" class="btn btn-info mb-3" onclick="searchBookingDetails()">Search Booking Details of Travellers</button>
        </form>
        <div id="bookingResults" class="mt-4"></div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Add Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        window.onload = function() {
        fetch('get_reserve_data.php')
            .then(response => response.json())
            .then(data => {
                const busRouteSelect = document.getElementById('busType');
                data.forEach(bus => {
                    const option = document.createElement('option');
                    option.value = bus.id;
                    option.textContent = bus.highway_bus_name;
                    busRouteSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching bus data:', error));
    };
        // Initialize Bootstrap Datepicker
        $('#date').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true
        });

        // Populate bus names dropdown
        $(document).ready(function(){
            $.ajax({
                url: 'businfo.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var select = $('#busType');
                    $.each(data, function(index, value) {
                        select.append('<option value="' + value + '">' + value + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching bus names:', error);
                }
            });
        });

        // Rest of your JavaScript code here
        function searchBookingDetails() {
            var busType = document.getElementById("busType").value;
            var date = document.getElementById("date").value;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'search.php?busType=' + busType + '&date=' + date, true);
            xhr.send();

            xhr.onload = function () {
                if (xhr.status != 200) {
                    alert('Error ' + xhr.status + ': ' + xhr.statusText);
                } else {
                    var results = JSON.parse(xhr.responseText);
                    updateTable(results);
                }
            };
        }

        function updateTable(data) {
            var tableHtml = '<table class="table">';
            tableHtml += '<thead><tr><th>BUS</th><th>Date</th><th>Number_Of_Tickets</th><th>Seat_Numbers</th></tr></thead>';
            tableHtml += '<tbody>';

            for (var i = 0; i < data.length; i++) {
                tableHtml += '<tr>';
                tableHtml += '<td>' + data[i]['Bus_name'] + '</td>';
                tableHtml += '<td>' + data[i]['date'] + '</td>';
                tableHtml += '<td>' + data[i]['Number_of_seats'] + '</td>';
                tableHtml += '<td>' + data[i]['seat_numbers'] + '</td>';
                tableHtml += '</tr>';
            }

            tableHtml += '</tbody></table>';

            document.getElementById("bookingResults").innerHTML = tableHtml;
        }
    </script>
</body>
</html>
