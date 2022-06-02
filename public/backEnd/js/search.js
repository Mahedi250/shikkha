$("#livesearch").hide();

function showResult(str) {
    var url = $('#url').val();
    if (str.length == 0) {
        document.getElementById("livesearch").innerHTML = "";
        $("#livesearch").hide();
        return;
    }


    $.ajax({
                method: 'POST',
                url: url + '/' + 'search',
                data: { search: str },
                success: function(data, textStatus, xhr) {
                        console.log(data);

                        $("#livesearch").show();
                        if (data.length != 0) {
                            document.getElementById("livesearch").innerHTML = "";

                            if (xhr.status == 201) {

                                data.forEach(value => {
                                            var card = `Name: ${value.first_name}<br>Gurdian Name: ${value.gurdian_name}<br>Class: ${value.class_name}<br>Section: ${value.section_name} <br> Roll: ${value.roll_no}<br>Due: ${value.due}TK <br><a class="primary-btn medium fix-gr-bg" href="${url + '/' + 'fees-collect-student-wise' + '/' + `${value.id}`}"> Pay Now </a>`;                                          
                                            $("#livesearch").append(card);
                                            $(".primary-btn.medium.fix-gr-bg").attr("style","color: black; margin-bottom: 10px;width: 115px;height: 50px; margin-left: 66%;");
                                            $("#livesearch").attr("style","padding-left: 15px; text-align: left;    font-size: 16px; line-height: 30px;");
                                            var element = $("#livesearch");
                                            var textToReplace = element.html();
                                            var newText = textToReplace.replace("null", "0");
                                            element.html(newText); 
                    });
                    return;
                }



                data.forEach(value => {
                    var str = value.name;
                    $("#livesearch").append(`<a href="${url + '/' + value.route}">${str}</a>`);
                });
            }
            else {
                document.getElementById("livesearch").innerHTML = "";
                $("#livesearch").append("<a id='lol'> Not found </a>");
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }

    });

}
$(document).on("click", function (e) {
    if (!$(e.target).closest('#serching').length) {
        $("#livesearch").hide();
    }
});