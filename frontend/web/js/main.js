$( document ).ready(function(){
    console.log('ready!');
    $('#addComment').on('click', function(){
        $('.commentAdd').toggleClass('hidden');
    });
});