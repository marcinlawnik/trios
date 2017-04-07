//Make magic happen
//Function to load new trio
//This function fills out the trio screen
//Extracted to avoid repetition
function loadTrio(trio, flip) {
    if (flip) {
        $(".panel").addClass("flip");
        setTimeout(function() {
            $(".panel").removeClass("flip");
        }, 600);
    }

    var blank = "<span class='blank'></span>";
    setTimeout(function() {
        $("#sentences li").html(function() {
            return trio[this.id].replace("$@$", blank);
        });
        $("#trio-id").html(trio.id);
    }, flip ? 300 : 0);

    var sentencesArr = [trio.sentence1, trio.sentence2, trio.sentence3];
    var sentences = encodeURIComponent(sentencesArr.join("\r\n"));
    location.hash = "#" + trio.id;
}

function updateStats(stats) {
    $("#trios-solved").text(stats.solved);
    $("#trios-attempted").text(stats.attempted);
}

function fillBlanks(text) {
    $("#sentences li .blank").text(text);
}

$(document).ready(function() {
    // 0 - white, check
    // 1 - red, try again
    // 2 - green, next trio
    var checkButtonState = 0;

    // 0 - red, i don't know
    // 1 - red, next trio
    var idkButtonState = 0;

    var hash = location.hash.slice(1);
    //AJAX magic
    //On first load fetch a random trio
    $.getJSON("/api/solve/"+hash, function(trio) {
        //Fill the page
        loadTrio(trio, false);
    }).fail(function() {
        alert("We're having some trouble fetching a new Trio for you. :< Please try again.");
    });

    //After user inputs answer and clicks check
    $("#check-button").on("click", function (e) {
        e.preventDefault();
        var trio_id = parseInt($("#trio-id").text());
        $(".panel").removeClass("wrong");

        //IF the button was already green, load next trio
        if (checkButtonState == 2) {
            //Make JSON request
            $.getJSON("/api/solve", function(trio) {
                //Fill the page
                loadTrio(trio, true);
            });
            $("#check-button")
                .removeClass("btn-success")
                .removeClass("btn-danger")
                .addClass("btn-primary")
                .html("Check");
            $("#idk-button").prop("disabled", false);
            //Clear the text input
            $("#answer").val("");
            checkButtonState = 0;
            return;
        }

        //Get answer
        var answer = $("#answer").val();
        //Send POST check request to /api/solve/{trio}
        $.post("/api/solve/" + trio_id, {
            answer: answer,
            _token: $("meta[name='csrf-token']").attr("content")
        }).done(function (ret) {
            if(ret.answer.isCorrect == true) {
                //IF answer is correct, change button to green and change text to "Next trio"
                $("#check-button")
                    .removeClass("btn-danger")
                    .removeClass("btn-primary")
                    .addClass("btn-success")
                    .html("Correct, next trio→");
                $("#idk-button").prop("disabled", true);

                //Fill out the sentences
                fillBlanks(ret.answer.attemptedAnswer);
                checkButtonState = 2;
            } else {
                //ELSE if answer is not correct, change button to red and change text to "try again"
                $(".panel").addClass("wrong");
                $("#check-button")
                    .removeClass("btn-primary")
                    .addClass("btn-danger")
                    .html("Try again");
                checkButtonState = 1;
            }
        });

        if(ret.stats !== undefined) {
            updateStats(ret.stats);
        }

    });

    //ON I don't know click or green buton click, save the click and load new random trio
    $("#idk-button").click(function (e) {
        e.preventDefault();
        var trio_id = $("#trio-id").text();
        $(".panel").removeClass("wrong");

        if(idkButtonState == 0) {
            //jest napis I don't know
            //zapisujemy click na I don't know
            $.post("/api/solve/" + trio_id, {
                answer: 'IDK@@',
                _token: $("meta[name='csrf-token']").attr("content")
            });
            //wyświetlamy poprawne odp
            //JSON request
            $.getJSON( "/api/solve/" + trio_id + "/answer", function(answer) {
                //Fill out the sentences
                fillBlanks(answer.correctAnswer);
            });
            //blokujemy input i button
            $("#answer").prop("disabled", true).val("");
            $("#check-button").prop("disabled", true);
            //zmieniamy button na next trio
            $("#idk-button").text("Next trio.");
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
            $("#answer").prop("disabled", false).val("");
            $("#check-button").prop("disabled", false);
            //load new trio
            //Make JSON request
            $.getJSON("/api/solve", function(trio) {
                //Fill the page
                loadTrio(trio, true);
            });
            //reset idk button state
            $("#idk-button").text("I don't know");
            idkButtonState = 0;
        }

        //update stats
        //TODO FIXME make post request before updating stats

        if(ret.stats !== undefined) {
            updateStats(ret.stats);
        }
    });

    $("#report-button").on("click", function (e) {
        var trio_id = $("#trio-id").text(),
            description = $("#report-description").val();

        $.post("{{ action('ReportController@create') }}", {
                trio_id: trio_id,
                description: description
            }).done(function() {
                var alert = $('<div class="alert alert-success" role="alert">Your report has been submitted. Thanks for your help!</div>');
                $("#report-description").val('');
                $(alert).hide().prependTo(".modal-body").fadeIn("slow").delay(3000).fadeOut("slow");
        });
    })
});
