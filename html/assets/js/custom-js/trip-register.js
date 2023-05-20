//trip-register tab

function confirmTripRegisterSubmit() {
    let c = confirm('Do you want to submit your request along with these detais?');
    console.log(c);
    if (c === true) {
        btnSubmitTripRegister();
    }
    // btnSubmitTripRegister();
}

var tripType = null;
$('#formTripType input').on('change', function() {
    tripType = $('input[name=tripRegTripType]:checked', '#formTripType').val().trim();
});

var tripMode = null;
$('#formTripMode input').on('change', function() {
    tripMode = $('input[name=tripRegTripMode]:checked', '#formTripMode').val().trim();
});

function btnSubmitTripRegister() {

    var onwardReqDate = $('#tripRegOnwardReqDate').val().trim();
    var returnReqDate = $('#tripRegReturnReqDate').val().trim();
    var onwardStartPlace = $('#tripRegOnwardStartPlace').val().trim();
    var returnStartPlace = $('#tripRegReturnStartPlace').val().trim();
    var onwardStartTime = $('#tripRegOnwardStartTime').val().trim();
    var returnStartTime = $('#tripRegReturnStartTime').val().trim();
    var onwardEndPlace = $('#tripRegOnwardEndPlace').val().trim();
    var returnEndPlace = $('#tripRegReturnEndPlace').val().trim();
    var onwardEndTime = $('#tripRegOnwardEndTime').val().trim();
    var returnEndTime = $('#tripRegReturnEndTime').val().trim();
    var onwardPersonsCount = $('#tripRegOnwardPersonsCount').val().trim();
    var returnPersonsCount = $('#tripRegReturnPersonsCount').val().trim();
    var visitPurpose = $('#tripRegVisitPurpose').val().trim();
    var guestAddress = $('#tripRegGuestAddress').val().trim();
    var indentName = $('#tripRegIndentName').val().trim();
    var indentDesign = $('#tripRegIndentDesign').val().trim();
    var indentDept = $('#tripRegIndentDept').val();
    var indentIntercom = $('#tripRegIndentIntercom').val().trim();
    var indentMobile = $('#tripRegIndentMobile').val().trim();
    var indentActivityId = $('#tripRegIndentActivityId').val().trim();

    console.clear();
    console.log(tripType);
    console.log(tripMode);
    console.log(onwardReqDate);
    console.log(returnReqDate);
    console.log(onwardStartPlace);
    console.log(returnStartPlace);
    console.log(onwardStartTime);
    console.log(returnStartTime);
    console.log(onwardEndPlace);
    console.log(returnEndPlace);
    console.log(onwardEndTime);
    console.log(returnEndTime);
    console.log(onwardPersonsCount);
    console.log(returnPersonsCount);
    console.log(visitPurpose);
    console.log(guestAddress);
    console.log(indentName);
    console.log(indentDesign);
    console.log(indentDept);
    console.log(indentIntercom);
    console.log(indentMobile);
    console.log(indentActivityId);

    // if ((tripType != null && tripMode != null)) {
    // var onwardReqDate = $('#tripRegOnwardReqDate').val().trim();
    // var returnReqDate = $('#tripRegReturnReqDate').val().trim();
    // var onwardStartPlace = $('#tripRegOnwardStartPlace').val().trim();
    // var returnStartPlace = $('#tripRegReturnStartPlace').val().trim();
    // var onwardStartTime = $('#tripRegOnwardStartTime').val().trim();
    // var returnStartTime = $('#tripRegReturnStartTime').val().trim();
    // var onwardEndPlace = $('#tripRegOnwardEndPlace').val().trim();
    // var returnEndPlace = $('#tripRegReturnEndPlace').val().trim();
    // var onwardEndTime = $('#tripRegOnwardEndTime').val().trim();
    // var returnEndTime = $('#tripRegReturnEndTime').val().trim();
    // var onwardPersonsCount = $('#tripRegOnwardPersonsCount').val().trim();
    // var returnPersonsCount = $('#tripRegReturnPersonsCount').val().trim();
    // var visitPurpose = $('#tripRegVisitPurpose').val().trim();
    // var guestAddress = $('#tripRegGuestAddress').val().trim();
    // var indentName = $('#tripRegIndentName').val().trim();
    // var indentDesign = $('#tripRegIndentDesign').val().trim();
    // var indentDept = $('#tripRegIndentDept').val();
    // var indentIntercom = $('#tripRegIndentIntercom').val().trim();
    // var indentMobile = $('#tripRegIndentMobile').val().trim();
    // var indentActivityId = $('#tripRegIndentActivityId').val().trim();

    $.ajax({
        url: 'api/vehicle_apis/trip-register/register.php',
        method: 'post',
        data: {
            // 'tripType': 'project',
            // 'tripMode': 'onward',
            // 'onwardReqDate': '27-08-2021',
            // 'returnReqDate': '27-08-2021',
            // 'onwardStartPlace': 'sathy',
            // 'returnStartPlace': 'sathy',
            // 'onwardStartTime': '10:00',
            // 'returnStartTime': '10:00',
            // 'onwardEndPlace': 'sathy',
            // 'returnEndPlace': 'sathy',
            // 'onwardEndTime': '10:00',
            // 'returnEndTime': '10:00',
            // 'onwardPersonsCount': 2,
            // 'returnPersonsCount': 2,
            // 'visitPurpose': 'purpose',
            // 'guestAddress': 'guest address',
            // 'indentName': 'ragav',
            // 'indentDesign': 'professor',
            // 'indentDept': 2,
            // 'indentIntercom': 5421,
            // 'indentMobile': 9876543210,
            // 'indentActivityId': 6598
            tripType,
            tripMode,
            onwardReqDate,
            returnReqDate,
            onwardStartPlace,
            returnStartPlace,
            onwardStartTime,
            returnStartTime,
            onwardEndPlace,
            returnEndPlace,
            onwardEndTime,
            returnEndTime,
            onwardPersonsCount,
            returnPersonsCount,
            visitPurpose,
            guestAddress,
            indentName,
            indentDesign,
            indentDept,
            indentIntercom,
            indentMobile,
            indentActivityId
        },
        dataType: 'json',
        success: function(result) {
            console.log(result);
            if (result.success === true) {
                alert(result.msg);
                window.location.reload();
            } else if (result.success === false) {
                alert(result.error);
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
    // } else {
    //     alert('Choose trip type & trip mode');
    //     return;
    // }
}

function goViewBookedTrip(id) {
    window.location.href = './trip-view-booked.php?id=' + window.btoa(id);
}

function goTripVehicleAllot(id) {
    window.location.href = './trip-vehicle-allot.php?id=' + window.btoa(id);
}

function btnAllotVehiceApprove(id) {
    console.log('approve');

    var c = confirm('Are you sure want to approve this request ? ');

    var vehicleCatgId = $('#tripAllotVehicleCatg').val();
    var vehicleId = $('#tripAllotVehicleListDropDown').val();
    var driverId = $('#tripAllotDriverList').val();

    if (c === true) {
        $.ajax({
            url: 'api/vehicle_apis/trip-register/viewTripActionApprove.php',
            method: 'post',
            data: {
                id,
                vehicleId,
                driverId
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success === true) {
                    alert(result.msg);
                    window.location.href = './trip.php';
                } else if (result.success === false) {
                    alert(result.error);
                    window.location.reload();
                }
            }
        });
    }
}

function btnTripViewDecline(id) {
    console.log('decline');

    var c = confirm('Are you sure want to decline this request ? ');

    if (c === true) {
        $.ajax({
            url: 'api/vehicle_apis/trip-register/viewTripActionDecline.php',
            method: 'post',
            data: {
                id,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success === true) {
                    alert(result.msg);
                    window.location.href = './trip.php';
                } else if (result.success === false) {
                    alert(result.error);
                    window.location.reload();
                }
            }
        });
    }
}

function btnTripViewRemove(id) {
    console.log('remove');

    var c = confirm('Are you sure want to remove this request ? ');

    if (c === true) {
        $.ajax({
            url: 'api/vehicle_apis/trip-register/viewTripActionRemove.php',
            method: 'post',
            data: {
                id,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success === true) {
                    alert(result.msg);
                    window.location.href = './trip.php';
                } else if (result.success === false) {
                    alert(result.error);
                    window.location.reload();
                }
            }
        });
    }
}


$('#tripAllotVehicleCatg').on('change', function() {
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
                $('#tripAllotVehicleListDropDown').empty();
                $('#tripAllotVehicleListDropDown').append(`<option value="0" selected disabled>
                                       Choose vehicle
                                  </option>`)
                data.map((e, index) => {
                    $('#tripAllotVehicleListDropDown').append(`<option value="${e.id}">
                                       ${e.vehicle_no} - ${e.vehicle_id}
                                  </option>`)
                });
            }
        }
    });
});

// kilo meter updates
function kilometerUpdates(reqId, driven, startFrom, endTo) {
    $.ajax({
        url: 'api/vehicle_apis/trip-register/kilometerUpdates.php',
        method: 'post',
        data: { reqId, driven, startFrom, endTo },
        dataType: 'json',
        success: function(result) {
            console.log(result);
        }
    });
}