// manage driver choose drop down driver list loader

window.onload = onload();

function onload() {

    // $('#manageDriverDetailsPanel').hide();
    // $('#manageVehicleDetailsPanel').hide();
}

$('#manageBusDropDown').on('change', function () {
    console.log(this.value);
    $.ajax({
        url: 'api/vehicle_apis/manage/vehicle/getVehicleDetail.php',
        method: 'post',
        data: {
            'vehicleIdName': this.value
        },
        dataType: 'json',
        success: function (result) {
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

