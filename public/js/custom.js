$('.showcase').hover(function () {
    $(this).children().first().css('opacity','0.9');
    $(this).children().first().siblings('article').css('opacity','1');
}).mouseleave(function () {
    $(this).children().first().css('opacity','0');
    $(this).children().first().siblings('article').css('opacity','0');
});

var dialog = document.querySelector('dialog');

$('[data-toggle = dialog]').click(function (e) {
    e.preventDefault();
    $.ajax($(this).attr('href')).done(function (html) {
        $('#app').append(html);

        var dialog = document.querySelector('dialog');

        dialog.showModal();
        dialog.querySelector('.close').addEventListener('click', function () {
            dialog.close();
        });
    });
});

// var dialog = document.querySelector('dialog');
// if (!dialog.showModal) {
//     dialogPolyfill.registerDialog(dialog);
// }
//

