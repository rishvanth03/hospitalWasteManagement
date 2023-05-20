// manage driver choose drop down driver list loader

window.onload = onload();

function onload() {

    $('#manageDriverDetailsPanel').hide();
    $('#manageVehicleDetailsPanel').hide();
}

// manage driver choose drop down driver list loader
$('#manageDriverDropDown').on('change', function() {
    $.ajax({
        url: 'api/vehicle_apis/manage/driver/getDriverDetail.php',
        method: 'post',
        data: { 'driverId': this.value },
        dataType: 'json',
        success: function(result) {
            if (result.success == true) {
                $('#manageDriverDetailsPanel').show();
                let data = result.data;
                console.log(data);
                $('#idvalue').hide();
                $('#idvalue').text(data.id);
                $('#assignedVehicleLabel').text(data.assigned_vehicle);
                $('#staffidvalue').text(data.sid);
                $('#namevalue').text(data.name);
                $('#dobvalue').text(data.dob);
                $('#phonevalue').text(data.phone);
                $('#licensedatevalue').text(data.license_date);
                $('#typelicensevalue').text(data.type_of_license);
                $('#dlnovalue').text(data.dl_no);
                $('#batchnovalue').text(data.batch_no);
                $('#transportvalidvalue').text(data.transport_vehic_valid_upto);
                if (data.status == 1) {
                    $('#statusvalue').text('active');
                    $('#statusvalue').removeClass('text-danger');
                    $('#statusvalue').addClass('text-success');
                } else if (data.status == 0) {
                    $('#statusvalue').text('inactive');
                    $('#statusvalue').removeClass('text-danger');
                    $('#statusvalue').addClass('text-danger');
                }
            }
        }
    });
});

function btnEditManageDriver() {
    let id = $('#idvalue').text();
    id = window.btoa(id);
    window.location.href = 'manage-edit-driver.php?id=' + id;
}

// function btnAssignVehicle() {
//     let id = $('#idvalue').text();
//     id = window.btoa(id);
//     window.location.href = 'manage-edit-driver.php?id=' + id;
// }

function btnRemoveManageDriver() {
    let id = $('#idvalue').text();
    let status = $('#statusvalue').text();
    console.log(id);
    console.log(status);
    if (status.trim() == 'inactive') {
        alert('Driver already in inactive status.');
        return;
    } else {
        $.ajax({
            url: 'api/vehicle_apis/manage/driver/removeManageDriver.php',
            method: 'post',
            data: {
                'driverId': id,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success == true) {
                    alert(result.msg);
                } else if (result.success == false) {
                    alert(result.error);
                }
            }
        });
    }
}

function btnMakeActiveManageDriver() {
    let id = $('#idvalue').text();
    let status = $('#statusvalue').text();
    console.log(id);
    console.log(status);
    if (status.trim() == 'active') {
        alert('Driver already in active status.');
        return;
    } else {
        $.ajax({
            url: 'api/vehicle_apis/manage/driver/makeActiveManageDriver.php',
            method: 'post',
            data: {
                'driverId': id,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success == true) {
                    alert(result.msg);
                } else if (result.success == false) {
                    alert(result.error);
                }
            }
        });
    }
}

function btnDeleteManageDriver() {
    let id = $('#idvalue').text();

    $.ajax({
        url: 'api/vehicle_apis/manage/driver/deleteDriverManageDriver.php',
        method: 'post',
        data: {
            'driverId': id,
        },
        dataType: 'json',
        success: function(result) {
            console.log(result);
            if (result.success == true) {
                alert(result.msg);
            } else if (result.success == false) {
                alert(result.error);
            }
        }
    });
}


function btnSaveManageDriverEdit() {
    var staffid = $('#staffId').val();
    var name = $('#driverName').val();
    var dob = $('#dob').val();
    var phone = $('#phone').val();
    var licenseDate = $('#licenseDate').val();
    var licenseType = $('#licenseType').val();
    var dlno = $('#dlno').val();
    var batchno = $('#batchno').val();
    var transportVehicValid = $('#transportVehicValid').val();

    if (staffid.trim().length == '' || name.trim().length == '' || dob.trim().length == '' || phone.trim().length == '' || licenseDate.trim().length == '' || licenseType.trim().length == '' ||
        dlno.trim().length == '' || batchno.trim().length == '' || transportVehicValid.trim().length == '') {
        alert('Blank field not allowed');
        return;
    } else {
        $.ajax({
            url: 'api/vehicle_apis/manage/driver/updateManageDriverEdit.php',
            method: 'post',
            data: {
                'driverId': staffid.trim(),
                'name': name.trim(),
                'dob': dob,
                'phone': phone.trim(),
                'licenseDate': licenseDate,
                'licenseType': licenseType.trim(),
                'dlno': dlno.trim(),
                'batchno': batchno.trim(),
                'transportVehicValid': transportVehicValid
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success == true) {
                    if (result.success === true) {
                        alert(result.msg);
                        window.location.href = './manage.php';
                    }
                } else if (result.success == false) {
                    alert(result.error);
                }
            }
        });
    }
    console.log('closed');
}

function btnAddManageDriverAdd() {
    var staffid = $('#dcreatesid').val();
    var name = $('#dcreateName').val();
    var dob = $('#dcreateDOB').val();
    var phone = $('#dcreatePhone').val();
    var licenseDate = $('#dcreateLicenseDate').val();
    var licenseType = $('#dcreateLicenseType').val();
    var dlno = $('#dcreateDlno').val();
    var batchno = $('#dcreateBatchNo').val();
    var transportVehicValid = $('#dcreateTransVehicValid').val();

    if (staffid.trim().length == '' || name.trim().length == '' || dob.trim().length == '' || phone.trim().length == '' || licenseDate.trim().length == '' || licenseType.trim().length == '' ||
        dlno.trim().length == '' || batchno.trim().length == '' || transportVehicValid.trim().length == '') {
        alert('Blank field not allowed');
        return;
    } else {
        $.ajax({
            url: 'api/vehicle_apis/manage/driver/addDriverManageDriver.php',
            method: 'post',
            data: {
                'driverId': staffid.trim(),
                'name': name.trim(),
                'dob': dob,
                'phone': phone.trim(),
                'licenseDate': licenseDate,
                'licenseType': licenseType.trim(),
                'dlno': dlno.trim(),
                'batchno': batchno.trim(),
                'transportVehicValid': transportVehicValid
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success === true) {
                    alert(result.msg);
                    window.location.href = './manage.php';
                } else if (result.success == false) {
                    alert(result.error);
                }
            }
        });
    }
    console.log('closed');
}


function driverManageConfirmation(mode) {
    if (mode == 0) {
        var c = confirm('Are you sure want to remove?')
        if (c === true) {
            btnRemoveManageDriver();
            window.location.reload();
            console.log('remove driver');
        } else if (c === false) {
            console.log('driver not removed. terminated');
        }
    } else if (mode == 1) {
        var c = confirm('Are you sure want to make active?')
        if (c === true) {
            btnMakeActiveManageDriver();
            window.location.reload();
            console.log('make active driver');
        } else if (c === false) {
            console.log('make driver work terminated');
        }
    } else if (mode == 2) {
        var c = confirm("Are you sure want to delete permanantly?\nYou can't revert this action.")
        if (c === true) {
            btnDeleteManageDriver();
            window.location.reload();
            console.log('delete driver');
        } else if (c === false) {
            console.log('delete driver work terminated');
        }
    }
}



// Vehicle manage
$('#manageVehicleVCatgDropDown').on('change', function() {
    console.log(this.value);
    $('#manageVehicleDetailsPanel').hide();
    $.ajax({
        url: 'api/vehicle_apis/manage/vehicle/getVehicle.php',
        method: 'post',
        data: {
            'catgId': this.value
        },
        dataType: 'json',
        success: function(result) {
            console.log(result);
            if (result.success === true) {
                var data = result.data;
                $('#manageVehicleVehicListDropDown').empty();
                $('#manageVehicleVehicListDropDown').append(`<option value="0" selected disabled>
                                       Choose...
                                  </option>`)
                data.map((e, index) => {
                    $('#manageVehicleVehicListDropDown').append(`<option value="${e.id}">
                                       ${e.vehicle_no} - ${e.vehicle_id}
                                  </option>`)
                });
            } else if (result.success == false) {
                alert(result.error);
            }
        }
    });
});

$('#manageVehicleVehicListDropDown').on('change', function() {
    console.log(this.value);
    $.ajax({
        url: 'api/vehicle_apis/manage/vehicle/getVehicleDetail.php',
        method: 'post',
        data: {
            'vehicleIdName': this.value
        },
        dataType: 'json',
        success: function(result) {
            console.log(result);
            if (result.success === true) {
                var data = result.data;
                console.log(data);
                $('#manageVehicleDetailsPanel').show();

                $('#vehicleidvalue').hide();

                $('#vehicleidvalue').text('');
                $('#vehicleNovalue').text('data.vehicle_no');
                $('#vehicleIdNamevalue').text('');
                $('#vehicleTypevalue').text('');
                // $('#vehicleCatgvalue').text('');
                $('#modelvalue').text('');
                $('#scvalue').text('');
                $('#chassisNovalue').text('');
                $('#engineNovalue').text('');
                $('#gvvvalue').text('');
                $('#ulwvalue').text('');
                $('#regonvalue').text('');
                $('#roadTaxValidvalue').text('');
                $('#fcValidvalue').text('');
                $('#insureValidvalue').text('');
                $('#insureidvalue').text('');
                $('#permitValidvalue').text('');
                $('#greenTaxValidvalue').text('');
                $('#emissionValidvalue').text('');
                $('#emissionTestCertNovalue').text('');
                $('#dieselCardNovalue').text('');
                $('#runningSlnovalue').text('');


                $('#vehicleidvalue').text(data.id);
                $('#vehicleNovalue').text(data.vehicle_no);
                $('#vehicleIdNamevalue').text(data.vehicle_id);
                $('#vehicleTypevalue').text(data.vehicle_type);
                // $('#vehicleCatgvalue').text(data.vehicle_category);
                $('#modelvalue').text(data.model);
                $('#scvalue').text(data.sc);
                $('#chassisNovalue').text(data.chassis_no);
                $('#engineNovalue').text(data.engine_no);
                $('#gvvvalue').text(data.gvv);
                $('#ulwvalue').text(data.ulw);
                $('#regonvalue').text(data.reg_on);
                $('#roadTaxValidvalue').text(data.road_tax_valid_upto);
                $('#fcValidvalue').text(data.fc_valid_upto);
                $('#insureValidvalue').text(data.insurance_valid_upto);
                $('#insureidvalue').text(data.insurance_id);
                $('#permitValidvalue').text(data.permit_valid_upto);
                $('#greenTaxValidvalue').text(data.green_tax_valid_upto);
                $('#emissionValidvalue').text(data.emission_valid_upto);
                $('#emissionTestCertNovalue').text(data.emission_test_certificate_no);
                $('#dieselCardNovalue').text(data.diesel_card_no);
                $('#runningSlnovalue').text(data.running_sno);
                if (data.status == 1) {
                    $('#vehicleStatusvalue').text('active');
                    $('#vehicleStatusvalue').removeClass('text-danger');
                    $('#vehicleStatusvalue').addClass('text-success');
                } else if (data.status == 0) {
                    $('#vehicleStatusvalue').text('inactive');
                    $('#vehicleStatusvalue').removeClass('text-danger');
                    $('#vehicleStatusvalue').addClass('text-danger');
                }
            }
        }
    });
});

// assign vehicle
$('#manageVehicleVCatgDropDownAssignVehicle').on('change', function() {
    console.log(this.value);
    $('#manageVehicleDetailsPanel').hide();
    $.ajax({
        url: 'api/vehicle_apis/manage/vehicle/getVehicle.php',
        method: 'post',
        data: {
            'catgId': this.value
        },
        dataType: 'json',
        success: function(result) {
            console.log(result);
            if (result.success === true) {
                var data = result.data;
                $('#manageVehicleVehicListDropDownAssignVehicle').empty();
                $('#manageVehicleVehicListDropDownAssignVehicle').append(`<option value="0" selected disabled>
                                       Choose...
                                  </option>`)
                data.map((e, index) => {
                    $('#manageVehicleVehicListDropDownAssignVehicle').append(`<option value="${e.id}">
                                       ${e.vehicle_no} - ${e.vehicle_id}
                                  </option>`)
                });
            } else if (result.success == false) {
                alert(result.error);
            }
        }
    });
});

function assignVehicleForDriver() {
    var driver = $('#manageDriverDropDown').val();
    var category = $('#manageVehicleVCatgDropDownAssignVehicle').val();
    var vehicle = $('#manageVehicleVehicListDropDownAssignVehicle').val();

    $.ajax({
        url: 'api/vehicle_apis/manage/driver/assignVehicle.php',
        method: 'post',
        data: {
            'catgId': category,
            'driverId': driver,
            'vehicleId': vehicle
        },
        dataType: 'json',
        success: function(result) {
            console.log(result);
            if (result.success === true) {
                alert(result.msg);
                location.reload();

            } else if (result.success == false) {
                alert(result.error);
            }
        }
    });
}

function btnEditManageVehicle() {
    let id = $('#vehicleidvalue').text();
    id = window.btoa(id);
    window.location.href = 'manage-edit-vehicle.php?id=' + id;
}

function btnSaveManageVehicleEdit() {
    var id = $('#vehicleid').text().trim();
    var vehicleNo = $('#vehicleNo').val().trim();
    var vehicleIdName = $('#vehicleIdName').val().trim();
    var vehicleType = $('#vehicleType').val().trim();
    var vehicleCatg = $('#vehicleCatg').val().trim();
    var model = $('#model').val().trim();
    var sc = $('#sc').val().trim();
    var chassisNo = $('#chassisNo').val().trim();
    var engineNo = $('#engineNo').val().trim();
    var gvv = $('#gvv').val().trim();
    var ulw = $('#ulw').val().trim();
    var regOn = $('#regon').val().trim();
    var roadTaxValid = $('#roadTaxValid').val().trim();
    var fcValid = $('#fcValid').val().trim();
    var insureValid = $('#insureValid').val().trim();
    var insureId = $('#insureid').val().trim();
    var permitValid = $('#permitValid').val().trim();
    var greenTaxValid = $('#greenTaxValid').val().trim();
    var emissionValid = $('#emissionValid').val().trim();
    var emissionTestCertNo = $('#emissionTestCertNo').val().trim();
    var diselCardNo = $('#dieselCardNo').val().trim();
    var runningSlno = $('#runningSlno').val().trim();

    if (vehicleNo.trim().length == '') {
        alert('Enter Vehicle no.');
        return;
    } else if (vehicleIdName.trim().length == '') {
        alert('Enter Vehicle Id Name');
        return;
    } else if (vehicleCatg == 0) {
        alert('Select Vehicle Category');
        return;
    } else {
        $.ajax({
            url: 'api/vehicle_apis/manage/vehicle/updateManageVehicleEdit.php',
            method: 'post',
            data: {
                'id': id,
                'vehicleIdName': vehicleIdName,
                'vehicleNo': vehicleNo,
                'vehicleType': vehicleType,
                'vehicleCatg': vehicleCatg,
                'model': model,
                'sc': sc,
                'chassisNo': chassisNo,
                'engineNo': engineNo,
                'gvv': gvv,
                'ulw': ulw,
                'regOn': regOn,
                'roadTaxValid': roadTaxValid,
                'fcValid': fcValid,
                'insureValid': insureValid,
                'insureId': insureId,
                'permitValid': permitValid,
                'greenTaxValid': greenTaxValid,
                'emissionValid': emissionValid,
                'emissionTestCertNo': emissionTestCertNo,
                'diselCardNo': diselCardNo,
                'runningSlno': runningSlno,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success === true) {
                    alert(result.msg);
                    window.location.href = './manage.php';

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
}

function vehicleManageConfirmation(mode) {
    if (mode == 0) {
        var c = confirm('Are you sure want to remove?')
        if (c === true) {
            btnRemoveManageVehicle();
            window.location.reload();
            console.log('remove vehicle');
        } else if (c === false) {
            console.log('vehicle not removed. terminated');
        }
    } else if (mode == 1) {
        var c = confirm('Are you sure want to make active?')
        if (c === true) {
            btnMakeActiveManageVehicle();
            window.location.reload();
            console.log('make active vehicle');
        } else if (c === false) {
            console.log('make vehicle work terminated');
        }
    } else if (mode == 2) {
        var c = confirm("Are you sure want to delete permanantly?\nYou can't revert this action.")
        if (c === true) {
            btnDeleteManageVehicle();
            window.location.reload();
            console.log('delete vehicle');
        } else if (c === false) {
            console.log('delete vehicle work terminated');
        }
    }
}

function btnRemoveManageVehicle() {
    let id = $('#vehicleidvalue').text();
    let status = $('#vehicleStatusvalue').text();
    console.log(id);
    console.log(status);
    if (status.trim() == 'inactive') {
        alert('Vehicle already in inactive status.');
        return;
    } else {
        $.ajax({
            url: 'api/vehicle_apis/manage/vehicle/removeManageVehicle.php',
            method: 'post',
            data: {
                'vehicleId': id,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success == true) {
                    alert(result.msg);
                } else if (result.success == false) {
                    alert(result.error);
                }
            }
        });
    }
}

function btnMakeActiveManageVehicle() {
    let id = $('#vehicleidvalue').text();
    let status = $('#vehicleStatusvalue').text();
    console.log(id);
    console.log(status);
    if (status.trim() == 'active') {
        alert('Vehicle already in active status.');
        return;
    } else {
        $.ajax({
            url: 'api/vehicle_apis/manage/vehicle/makeActiveManageVehicle.php',
            method: 'post',
            data: {
                'vehicleId': id,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success == true) {
                    alert(result.msg);
                } else if (result.success == false) {
                    alert(result.error);
                }
            }
        });
    }
}

function btnDeleteManageVehicle() {
    let id = $('#vehicleidvalue').text();

    $.ajax({
        url: 'api/vehicle_apis/manage/vehicle/deleteVehicleManageVehicle.php',
        method: 'post',
        data: {
            'vehicleId': id,
        },
        dataType: 'json',
        success: function(result) {
            console.log(result);
            if (result.success == true) {
                alert(result.msg);
            } else if (result.success == false) {
                alert(result.error);
            }
        }
    });
}

function btnAddManageVehicleAdd() {
    var vehicleNo = $('#vcreateVehicleNo').val();
    var vehicleName = $('#vcreateVehicleName').val();
    var vehicleType = $('#vcreateVehicleType').val();
    var vehicleCatg = $('#vcreateVehicleCatg').val();
    var model = $('#vcreateModel').val();
    var sc = $('#vcreateSeats').val();
    var chassisNo = $('#vcreateChassisNo').val();
    var engineNo = $('#vcreateEngineNo').val();
    var gvv = $('#vcreateGvv').val();
    var ulw = $('#vcreateUlw').val();
    var regOn = $('#vcreateRegOn').val();
    var roadTaxValid = $('#vcreateRoadTaxValid').val();
    var fcValid = $('#vcreateFcValid').val();
    var insureValid = $('#vcreateInsureValid').val();
    var insureId = $('#vcreateInsureId').val();
    var permitValid = $('#vcreatePermitValid').val();
    var greenTaxValid = $('#vcreateGreenTaxValid').val();
    var emissionValid = $('#vcreateEmissionValid').val();
    var emissionTestCertNo = $('#vcreateEmissionTestCertNo').val();
    var dieselCardNo = $('#vcreateDieselCardNo').val();
    var runningSno = $('#vcreateRunningSno').val();

    if (vehicleNo.trim().length == '') {
        alert('Enter Vehicle Number');
        $('#vcreateVehicleNo').focus();
        return;
    }

    if (vehicleName.trim().length == '') {
        alert('Enter Vehicle Name');
        $('#vcreateVehicleName').focus();
        return;
    }

    if (vehicleType.trim().length == '') {
        alert('Enter Vehicle Type');
        $('#vcreateVehicleType').focus();
        return;
    }

    if (vehicleCatg == null || vehicleCatg == 0) {
        alert('Choose Vehicle Category');
        return;
    }

    if (model.trim().length == '') {
        alert('Enter Vehicle Model');
        $('#vcreateModel').focus();
        return;
    }
    if (model.trim().length != 4) {
        alert('Enter Valid Model Year');
        $('#vcreateModel').focus();
        return;
    }

    if (sc.trim().length == '') {
        alert('Enter Vehicle Total Seats');
        $('#vcreateSeats').focus();
        return;
    }

    if (chassisNo.trim().length == '') {
        alert('Enter Vehicle Chassis Number');
        $('#vcreateChassisNo').focus();
        return;
    }

    if (engineNo.trim().length == '') {
        alert('Enter Vehicle Engine Number');
        $('#vcreateEngineNo').focus();
        return;
    }

    if (regOn == '') {
        regOn = '1111-11-11'
    }
    if (roadTaxValid == '') {
        roadTaxValid = '1111-11-11'
    }
    if (fcValid == '') {
        fcValid = '1111-11-11'
    }
    if (insureValid == '') {
        insureValid = '1111-11-11'
    }
    if (permitValid == '') {
        permitValid = '1111-11-11'
    }
    if (greenTaxValid == '') {
        greenTaxValid = '1111-11-11'
    }
    if (emissionValid == '') {
        emissionValid = '1111-11-11'
    }

    // console.log(vehicleNo);
    // console.log(vehicleName);
    // console.log(vehicleType);
    // console.log(vehicleCatg);
    // console.log(model);
    // console.log(sc);
    // console.log(chassisNo);
    // console.log(engineNo);
    // console.log(gvv);
    // console.log(ulw);
    // console.log(regOn);
    // console.log(roadTaxValid);
    // console.log(fcValid);
    // console.log(insureValid);
    // console.log(insureId);
    // console.log(permitValid);
    // console.log(greenTaxValid);
    // console.log(emissionValid);
    // console.log(emissionTestCertNo);
    // console.log(dieselCardNo);
    // console.log(runningSno);
    $.ajax({
        url: 'api/vehicle_apis/manage/vehicle/addVehicleManageVehicle.php',
        method: 'post',
        data: {
            'vehicleNo': vehicleNo,
            'vehicleName': vehicleName,
            'vehicleType': vehicleType,
            'vehicleCatg': vehicleCatg,
            'model': model,
            'sc': sc,
            'chassisNo': chassisNo,
            'engineNo': engineNo,
            'gvv': gvv,
            'ulw': ulw,
            'regOn': regOn,
            'roadTaxValid': roadTaxValid,
            'fcValid': fcValid,
            'insureValid': insureValid,
            'insureId': insureId,
            'permitValid': permitValid,
            'greenTaxValid': greenTaxValid,
            'emissionValid': emissionValid,
            'emissionTestCertNo': emissionTestCertNo,
            'dieselCardNo': dieselCardNo,
            'runningSno': runningSno,
        },
        dataType: 'json',
        success: function(result) {
            console.log(result);
            if (result.success === true) {
                alert(result.msg);
                window.location.href = './manage.php';
            } else if (result.success == false) {
                alert(result.error);
            }
        }
    });

    console.log('closed');
}