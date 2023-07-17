$(document).ready(function() {

    const moreItems = (items, quantity) => {

        for(i = 0; i < quantity; i++) {
            $(items[i]).show();
        }

    }

    const lessItems = (items, quantity) => {

        const itemsQuantity = items.length - quantity;
        
        const filteredItems = itemsQuantity > 5 ? itemsQuantity : 5;

        items.hide();

        moreItems(items, filteredItems);

    }

    $('.main-admin-table .action-buttons i').click(function() {

        const table = $(this).parent().siblings('table');
        
        const hiddenElements = table.find('tr:hidden');
    
        if ($(this).data('action') == 'more') {
    
            moreItems(hiddenElements, 4);
    
            const newHiddenElements = table.find('tr:hidden');
    
            const showElements = table.find('tr:visible');
    
            if (showElements.length > 5) {
    
                $(this).parent().find('i.disabled').removeClass('disabled');
    
            }
    
            if (!newHiddenElements.length) {
    
                $(this).addClass('disabled');
    
            }
    
        } else {
    
            lessItems(table.find('tr:visible'), 4);
    
            const newHiddenElements = table.find('tr:hidden');
    
            const showElements = table.find('tr:visible');
    
            if (newHiddenElements.length) {
    
                $(this).parent().find('i.disabled').removeClass('disabled');
    
            }
    
            if (showElements.length == 5) {
    
                $(this).addClass('disabled');
                
            }
    
        }
    
    });

});