$(document).ready(function(){
    $("#dd").click(function(){
        $("#dd").removeAttr('style').html('You have not submitted an answer for any of the assignments,' +
            ' or if you have completed at least one assignment, you have not received a score yet. Please be patient!')
    });
});
