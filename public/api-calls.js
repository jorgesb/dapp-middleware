var apiUrl = 'http://localhost:8000/rest/v1/consent/tracking/';
var addEndpoint = 'add';
var getOptActionsByUrnUrl = 'urn/';
var getOptActionsByOptIdUrl = 'opt/';

function addOptAction()
{
    $.ajax({
        method: "POST",
        url: apiUrl + addEndpoint,
        crossDomain: true,
        beforeSend: function (request) {
            request.setRequestHeader("Access-Control-Allow-Origin", "*");
        },
        data: {
            urn: $('#urn').val(),
            optId: $('#optId').val(),
            action: $('#action').val(),
            optText: $('#optText').val()
        }
    })
        .done(function (msg) {
            console.log("addOptAction - Data Saved: " + msg);
            $('#output').html("Data Saved: " + msg);
            clearForm();
        });
}

function search()
{
    const filter = $('#filter').val();

    if (filter == 'optActionId') {
        getOptAction();
    } else if (filter == 'urn') {
        getOptActionsByUrn();
    } else {
        getOptActionsByOptId();
    }
}

function getOptAction()
{
    console.log('Getting opt action by id:' + apiUrl + $('#requestId').val());
    $.ajax({
        method: "GET",
        url: apiUrl + $('#requestId').val(),
    })
        .done(function (msg) {
            $('#output').html(JSON.stringify(msg));
            showSearchResults(msg);
        });
}

function getOptActionsByUrn()
{
    console.log('Getting opt action by urn:' + $('#requestId').val());
    $.ajax({
        method: "GET",
        url: apiUrl + getOptActionsByUrnUrl + $('#requestId').val(),
    })
        .done(function (msg) {
            $('#output').html(JSON.stringify(msg));
            showSearchResults(msg);
        });
}

function getOptActionsByOptId()
{
    console.log('Getting opt action by opt id:' + apiUrl + $('#requestId').val());
    $.ajax({
        method: "GET",
        url: apiUrl + getOptActionsByOptIdUrl + $('#requestId').val(),
    })
        .done(function (msg) {
            $('#output').html(JSON.stringify(msg));
            showSearchResults(msg);
        });
}

function showSearchResults(result)
{
    if ($.isEmptyObject(result)) {
        $('#search-results').hide();
        $('#no-results').show();

        return false;
    } else {
        $('#search-results').show();
        $('#no-results').hide();
    }

    // Clear table
    $("#search-results").find("tr:gt(0)").remove();

    console.log('showSearchResults...');
    console.dir(result);

    $.each(result, function(key, values) {
        console.log('Processing key:' + key);
        $('#search-results tbody').append('<tr><th scope="row">'+key+'</th>' +
            '<td>'+ values[0] +'</td>' +
            '<td>'+ values[1] +'</td>' +
            '<td>'+ values[2] +'</td>' +
            '<td>'+ values[4] +'</td>' +
            '<td>'+ values[3] +'</td>' +
            ' </tr>');
    });
}

function clearForm() {
    $('#opt-form').find(':input').val('');
}


