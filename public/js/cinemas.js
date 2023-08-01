const optionFilter = $('#option-filter');
const deleteIcon = optionFilter.find('.fa-sort-down');

optionFilter.on('click', () => {
    optionFilter.toggleClass('active');
    deleteIcon.toggleClass('fa-sort-down pb-2 pt-2 fa-sort-up');
    $('#options-container').toggle();
    if (deleteIcon.hasClass('fa-sort-up')) {
        $('#options-container').css('display', 'flex');
    }
});