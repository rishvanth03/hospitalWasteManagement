    $('#modalvcatg').on('change', function() {
        console.log(this.value);
        // $('#manageVehicleDetailsPanel').hide();
        $.ajax({
            url: 'api/vehicle_apis/manage/vehicle/getVehicle.php',
            method: 'post',
            data: {
                'catgId': this.value
            },
            dataType: 'json',
            success: function(result) {
                if (result.success === true) {
                    var data = result.data;
                    $('#modalvehicle').empty();
                    $('#modalvehicle').append(`<option value="0" selected disabled>
                                       Choose...
                                  </option>`)
                    data.map((e, index) => {
                        $('#modalvehicle').append(`<option value="${e.id}">
                                       ${e.vehicle_no} - ${e.vehicle_id}
                                  </option>`)
                    });
                } else if (result.success == false) {
                    alert(result.error);
                }
            }
        });
    });

    function updateEditFuelModal(id) {
        $.ajax({
            url: 'api/vehicle_apis/manage/vehicle/editDeleteFuelIndent.php',
            method: 'post',
            data: {
                'id': id,
                'mode': 1
            },
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    let data = result.data;
                    console.log(data);
                    $('#modalindid').val(data.id);
                    $('#modalvid').val(data.vvid);
                    $('#modalvcatg').val(data.category_name);
                    $('#modalvehicle').val(data.vid + ' - ' + data.vno);
                    $('#modalfuelfilled').val(data.fuel_filled);
                    $('#modaldriver').val(data.name + ' - ' + data.sid);
                    $('#modalkmfilled').val(data.kilometer);
                    $('#modalfuelprice').val(data.fuel_price);

                } else if (result.success == false) {
                    alert(result.error);
                    $('#modalEditFuelIndent').modal('hide');
                }
            }
        });
    }

    function edit() {
        id = $('#modalindid').val();
        vid = $('#modalvid').val();
        fuel = $('#modalfuelfilled').val();
        km = $('#modalkmfilled').val();
        price = $('#modalfuelprice').val();

        $.ajax({
            url: 'api/vehicle_apis/manage/vehicle/editDeleteFuelIndent.php',
            method: 'post',
            data: {
                'mode': 2,
                'id': id,
                'vid': vid,
                'fuel': fuel,
                'km': km,
                'price': price,
            },
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    alert(result.msg);
                    window.location.reload();
                } else if (result.success == false) alert(result.error);
            }
        });
    }

    function deleteIndent(id) {
        if (confirm('Do you really want to delete this record?') == true) {
            $.ajax({
                url: 'api/vehicle_apis/manage/vehicle/editDeleteFuelIndent.php',
                method: 'post',
                data: {
                    'mode': 3,
                    'id': id,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        alert(result.msg);
                        window.location.reload();
                    } else if (result.success == false) alert(result.error);
                }
            });
        }
    }

    function tableFuelIndent(data) {
        let appendData = '';
        let status = '';
        let sno = 1;
        // for (let i = 0; i < data.length; i++) {
        data.forEach(e => {

            if (e['status'] == 1) status = 'Indent Rised';
            else if (e['status'] == 2) status = 'Fuel Filled';
            appendData += "<tr><td>" + (sno++) + "</td><td>" + e['fuel_rised'] + "</td><td>";
            appendData += e['fuel_filled'] + "</td><td>" + e['name'] + " - " + e['sid'];
            appendData += "</td><td>" + e['kilometer'] + "</td><td>" + e['fuel_price'] + "</td>";
            appendData += "<td>" + e['total_cost'] + "</td><td>" + e['mileage'] + "</td>";
            appendData += "<td> " + status + " </td><td>" + e['inserted_on'];
            appendData += "</td><td>" + e['updated_on'] + "</td><td><button type='button'";
            appendData += " class='btn btn-primary' data-bs-toggle = 'modal' ";
            appendData += "data-bs-target = '#modalEditFuelIndent'";
            appendData += " onclick='updateEditFuelModal(" + e['id'] + ")'";
            appendData += "><i class='uil-edit-alt'></i></button></td><td><button type='button' class='btn btn-primary'";
            appendData += "onclick='deleteIndent(" + e['id'] + ")'><i class='mdi mdi-delete'></i></button></td></tr> ";
        });
        // }
        $('#tableFuelIndent').html(appendData);
    }

    $('#manageVehicleVehicListDropDown').on('change', function() {
        $.ajax({
            url: 'api/vehicle_apis/manage/vehicle/getIndentListForVehicle.php',
            method: 'post',
            data: {
                'vehicleId': this.value
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success == true) {
                    let data = result.data;
                    if (data.length > 0) {
                        $('#tableFuelIndent').html();
                        tableFuelIndent(data);
                        $('#driverForFuelIndent').val(result.driver_id);
                        $('#fuelRiseIndent').focus();
                    } else $('#tableFuelIndent').html();
                } else $('#tableFuelIndent').html();
            },
            error: function(failed) {
                console.log(failed);
                $('#tableFuelIndent').html('');
            }
        });

        function tableDailyKilometer(data) {
            let appendData = '';
            let status = '';
            let sno = 1;
            data.forEach(e => {
                var diff = e['close_km'] - e['start_km'];
                appendData += "<tr><td>" + sno + "</td><td>" + e['start_km'];
                appendData += "</td><td>" + e['close_km'] + "</td><td>" + diff + "</td><td>";
                appendData += e['name'] + " - " + e['sid'] + "</td><td>" + e['inserted_on'] + "</td></tr>";
            });
            $('#tableDailyKilometer').html(appendData);
        }

        $.ajax({
            url: 'api/vehicle_apis/manage/vehicle/getDailyKilometerUpdate.php',
            method: 'post',
            data: {
                'vehicleId': this.value
            },
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    let data = result.data;
                    tableDailyKilometer(data);
                }
            }
        });
    });

    function btnRiseFuelIndent() {
        var cid = $('#manageVehicleVCatgDropDown').val();
        var vid = $('#manageVehicleVehicListDropDown').val();
        var fuel = $('#fuelRiseIndent').val();
        var driver = $('#driverForFuelIndent').val();

        $.ajax({
            url: 'api/vehicle_apis/manage/vehicle/fuelRise.php',
            method: 'post',
            data: {
                'cid': cid,
                'vid': vid,
                'fuelRise': fuel,
                'driver': driver
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success === true) {
                    alert(result.msg);
                    // window.location.href = './manage.php';
                    location.reload();

                } else if (result.success == false) {
                    alert(result.error);
                }
            },
            error: function(data) {
                // console.log(data);
                console.log(data.status);
                console.log(data.statusText);
                console.log(data.responseText);
            }
        });
        console.log('closed');
    }