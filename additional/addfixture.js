var form = $("#new-fixture");

// Add a submit event listener to the form
form.on("submit", sendPost);

// Set to null to check if a request is currently active
var request = null;

/**
 * Event handler
 * @param e Submit event object
 */
function sendPost(e) {
    // stop the normal form submit refresh/redirect from happening
    e.preventDefault();

    if(request !== null) {
        // the post is already on it's way
        return;
    }

    console.log(form.serialize());

    // assign request var a value to keep track of the current request
    request = $.post("submitaction.php", form.serialize())
        .done(function(data) {
            console.log(data);
            var result = confirm("Fixture added. Press OK to view the upcoming fixtures, or press cancel to add another.");
            if (result == true) {
                window.location.href = "./fixtures.php";
            } else {
                console.info("cancelled");
            }
        })
        .fail(function(error) {
            alert(error.responseText);
        })
        .always(function() {
            request = null;
        });
}