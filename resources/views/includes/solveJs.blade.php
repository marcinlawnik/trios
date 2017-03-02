<script>
    //Make magic happen
    //Function to load new trio
    //This function fills out the trio screen
    //Extracted to avoid repetition
    function loadTrio(trio) {
        $("#sentence1").html(trio.sentence1.replace("$@$", "_____"));
        $("#sentence2").html(trio.sentence2.replace("$@$", "_____"));
        $("#sentence3").html(trio.sentence3.replace("$@$", "_____"));
        $("#trio-id").html(trio.id);
        $(".report").attr('href', $(".report").data('href')
            .replace('_trioID_', trio.id)
            .replace('_Sentences_', encodeURIComponent(trio.sentence1 + "\r\n" + trio.sentence2 + "\r\n" + trio.sentence3)));
    }

    $( document ).ready(function() {

        // 0 - white, check
        // 1 - red, try again
        // 2 - green, next trio
        var checkButtonState = 0;
        // 0 - red, i don't know
        // 1 - red, next trio
        var idkButtonState = 0;

        //AJAX magic
        //On first load fetch a random trio
        var jqxhr = $.getJSON( "/api/solve", function( trio ) {
            //Fill the page
            loadTrio(trio);
        })
            .fail(function() {
                alert("We're having some trouble fetching a new Trio for you. :< Please try again.");
            });
        //After user inputs answer and clicks check
        $("#check-button").click(function (e) {
            e.preventDefault();

            //IF the button was already green, load next trio
            if (checkButtonState == 2) {
                //Make JSON request
                var jqxhr = $.getJSON( "/api/solve", function( trio ) {
                    //Fill the page
                    loadTrio(trio);
                });
                $("#check-button")
                    .removeClass("btn-success")
                    .removeClass("btn-danger")
                    .addClass("btn-primary")
                    .html("Check");
                //Clear the text input
                $("#answer").val('');
                checkButtonState = 0;
                return;
            }

            //Get answer
            var answer = $("#answer").val();
            //Send POST check request to /api/solve/{trio}
            $.post( "/api/solve/" + $("#trio-id").text(), {
                "answer" : answer,
                _token: $('meta[name="csrf-token"]').attr('content')
            })
                .done(function ( data ) {
                    var ret = JSON.parse(data);
                    if(ret.answer.isCorrect == true) {
                        //IF answer is correct, change button to green and change text to "Next trio"
                        $("#check-button")
                            .removeClass("btn-danger")
                            .removeClass("btn-primary")
                            .addClass("btn-success")
                            .html("Correct, next trio→");
                        //Fill out the sentences
                        $("#sentence1").text(function () {
                            return $(this).text().replace("_____", "_"+ret.answer.attemptedAnswer+"_");
                        });
                        $("#sentence2").text(function () {
                            return $(this).text().replace("_____", "_"+ret.answer.attemptedAnswer+"_");
                        });
                        $("#sentence3").text(function () {
                            return $(this).text().replace("_____", "_"+ret.answer.attemptedAnswer+"_");
                        });
                        checkButtonState = 2;
                    } else {
                        //ELSE if answer is not correct, change button to red and change text to "try again"
                        $("#check-button")
                            .removeClass("btn-primary")
                            .addClass("btn-danger")
                            .html("Try again");
                        checkButtonState = 1;
                    }
                });
        });

        //ON I don't know click or green buton click, load new random trio
        $("#idk-button").click(function (e) {
            e.preventDefault();

            if(idkButtonState == 0) {
                //jest napis I don't know
                //wyświetlamy poprawne odp
                //JSON request
                var jqxhr = $.getJSON( "/api/solve/"+$("#trio-id").text()+"/answer", function( answer ) {
                    //Fill out the sentences
                    $("#sentence1").text(function () {
                        return $(this).text().replace("_____", "_"+answer.correctAnswer+"_");
                    });
                    $("#sentence2").text(function () {
                        return $(this).text().replace("_____", "_"+answer.correctAnswer+"_");
                    });
                    $("#sentence3").text(function () {
                        return $(this).text().replace("_____", "_"+answer.correctAnswer+"_");
                    });
                });
                //blokujemy input i button
                $("#answer").prop('disabled', true).val('');
                $("#check-button").prop('disabled', true);
                //zmieniamy button na next trio
                $("#idk-button").text("Next trio.")
                idkButtonState = 1;
            } else if (idkButtonState == 1) {
                // 1 - red, next trio
                //Reset check button state
                $("#check-button")
                    .removeClass("btn-danger")
                    .addClass("btn-primary")
                    .html("Check");
                checkButtonState = 0;
                //Clear and unlock the text input and check button
                $("#answer").prop('disabled', false).val('');
                $("#check-button").prop('disabled', false);
                //load new trio
                //Make JSON request
                var jqxhr = $.getJSON( "/api/solve", function( trio ) {
                    //Fill the page
                    loadTrio(trio);
                });
                //reset idk button state
                $("#idk-button").text("I don't know.");
                idkButtonState = 0;
            }

        });
    });
</script>
