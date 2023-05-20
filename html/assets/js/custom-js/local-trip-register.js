//local-trip-register tab

function confirmLocalTripRegisterSubmit() {
    let c = confirm('Do you want to submit your request along with these detais?');
    console.log(c);
    if (c === true) {
        btnSubmitLocalTripRegister();
    }
    // btnSubmitLocalTripRegister();
}

var tripType = null;
$('#formTripType input').on('change', function() {
    tripType = $('input[name=tripRegTripType]:checked', '#formTripType').val().trim();
});


function btnSubmitLocalTripRegister() {

    var ReqDate = $('#tripRegOnwardReqDate').val().trim();
    var Place = $('#tripRegOnwardStartPlace').val().trim();
    var StartTime = $('#tripRegOnwardStartTime').val().trim();
    var EndTime = $('#tripRegReturnEndTime').val().trim();
    var onwardPersonsCount = $('#tripRegOnwardPersonsCount').val().trim();
    var returnPersonsCount = $('#tripRegReturnPersonsCount').val().trim();
    var visitPurpose = $('#tripRegVisitPurpose').val().trim();
    var guestAddress = $('#tripRegGuestAddress').val().trim();
    var indentName = $('#tripRegIndentName').val().trim();
    var indentDesign = $('#tripRegIndentDesign').val().trim();
    var indentDept = $('#tripRegIndentDept').val();
    var indentIntercom = $('#tripRegIndentIntercom').val().trim();
    var indentMobile = $('#tripRegIndentMobile').val().trim();
    var indentTaskNo = $('#tripRegIndentTaskNo').val().trim();

    console.clear();
    console.log(tripType);
    console.log(ReqDate);
    console.log(Place);
    console.log(StartTime);
    console.log(EndTime);
    console.log(onwardPersonsCount);
    console.log(returnPersonsCount);
    console.log(visitPurpose);
    console.log(guestAddress);
    console.log(indentName);
    console.log(indentDesign);
    console.log(indentDept);
    console.log(indentIntercom);
    console.log(indentMobile);
    console.log(indentTaskNo);

    // if ((tripType != null && tripMode != null)) {
    // var ReqDate = $('#tripRegOnwardReqDate').val().trim();
    // var Place = $('#tripRegOnwardStartPlace').val().trim();
    // var StartTime = $('#tripRegOnwardStartTime').val().trim();
    // var EndTime = $('#tripRegOnwardEndTime').val().trim();
    // var onwardPersonsCount = $('#tripRegOnwardPersonsCount').val().trim();
    // var returnPersonsCount = $('#tripRegReturnPersonsCount').val().trim();
    // var visitPurpose = $('#tripRegVisitPurpose').val().trim();
    // var guestAddress = $('#tripRegGuestAddress').val().trim();
    // var indentName = $('#tripRegIndentName').val().trim();
    // var indentDesign = $('#tripRegIndentDesign').val().trim();
    // var indentDept = $('#tripRegIndentDept').val();
    // var indentIntercom = $('#tripRegIndentIntercom').val().trim();
    // var indentMobile = $('#tripRegIndentMobile').val().trim();
    // var indentTaskNo = $('#tripRegIndentTaskNo').val().trim();

    $.ajax({
        url: 'api/vehicle_apis/local-trip-register/register.php',
        method: 'post',
        data: {
            // 'tripType': 'project',
            // 'ReqDate': '27-08-2021',
            // 'Place': 'sathy',
            // 'EndTime': '10:00',
            // 'onwardPersonsCount': 2,
            // 'returnPersonsCount': 2,
            // 'visitPurpose': 'purpose',
            // 'guestAddress': 'guest address',
            // 'indentName': 'ragav',
            // 'indentDesign': 'professor',
            // 'indentDept': 2,
            // 'indentIntercom': 5421,
            // 'indentMobile': 9876543210,
            // 'indentTaskNo': 6598
            tripType,
            ReqDate,
            Place,
            StartTime,
            EndTime,
            onwardPersonsCount,
            returnPersonsCount,
            visitPurpose,
            guestAddress,
            indentName,
            indentDesign,
            indentDept,
            indentIntercom,
            indentMobile,
            indentTaskNo
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

function goViewBookedLocalTrip(id) {
    window.location.href = './local-trip-view-booked.php?id=' + window.btoa(id);
}

function goLocalTripVehicleAllot(id) {
    window.location.href = './local-trip-vehicle-allot.php?id=' + window.btoa(id);
}

function btnAllotLocalVehiceApprove(id) {
    console.log('approve');

    var c = confirm('Are you sure want to approve this request ? ');

    var vehicleCatgId = $('#tripAllotVehicleCatgLocal').val();
    var vehicleId = $('#tripAllotVehicleDropDownLocal').val();
    var driverId = $('#tripAllotDriverList').val();

    if (c === true) {
        $.ajax({
            url: 'api/vehicle_apis/local-trip-register/viewTripActionApprove.php',
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
                    window.location.href = './local-trip.php';
                } else if (result.success === false) {
                    alert(result.error);
                    window.location.reload();
                }
            }
        });
    }
}

function btnLocalTripViewDecline(id) {
    console.log('decline');

    var c = confirm('Are you sure want to decline this request ? ');

    if (c === true) {
        $.ajax({
            url: 'api/vehicle_apis/local-trip-register/viewTripActionDecline.php',
            method: 'post',
            data: {
                id,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success === true) {
                    alert(result.msg);
                    window.location.href = './local-trip.php';
                } else if (result.success === false) {
                    alert(result.error);
                    window.location.reload();
                }
            }
        });
    }
}

function btnLocalTripViewRemove(id) {
    console.log('remove');

    var c = confirm('Are you sure want to remove this request ? ');

    if (c === true) {
        $.ajax({
            url: 'api/vehicle_apis/local-trip-register/viewTripActionRemove.php',
            method: 'post',
            data: {
                id,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success === true) {
                    alert(result.msg);
                    window.location.href = './local-trip.php';
                } else if (result.success === false) {
                    alert(result.error);
                    window.location.reload();
                }
            }
        });
    }
}

$('#tripAllotVehicleCatgLocal').on('change', function() {
    console.log(this.value);
    $.ajax({
        url: 'api/vehicle_apis/local-trip-register/getVehicle.php',
        method: 'post',
        data: {
            'catgId': this.value
        },
        dataType: 'json',
        success: function(result) {
            console.log(result);
            if (result.success === true) {
                var data = result.data;
                $('#tripAllotVehicleDropDownLocal').empty();
                $('#tripAllotVehicleDropDownLocal').append(`<option value="0" selected disabled>
                                       Choose vehicle </option>`)
                data.map((e, index) => {
                    $('#tripAllotVehicleDropDownLocal').append(`<option value="${e.id}">
                                       ${e.vehicle_no} - ${e.vehicle_id}
                                  </option>`)
                });
            }
        }
    });
});

// kilo meter updates
function LocalTripkilometerUpdates(reqId, driven, startFrom, endTo) {
    $.ajax({
        url: 'api/vehicle_apis/local-trip-register/kilometerUpdates.php',
        method: 'post',
        data: { reqId, driven, startFrom, endTo },
        dataType: 'json',
        success: function(result) {
            console.log(result);
        }
    });
}